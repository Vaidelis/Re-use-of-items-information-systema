<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BoughtItem;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Service;
use App\Models\ServiceHasTags;
use App\Models\Image;
use App\Models\ServicesRate;
use App\Models\Tag;
use App\Models\BoughtService;
use App\Models\RememberService;
use App\Models\RememberItem;
use App\Models\ItemHasTags;
use App\Models\ItemHasPins;
use App\Models\ItemHasService;
use Illuminate\Support\Facades\Storage;
use App\Support\Collection;
use Validator;
use Auth;
use Session;
use Cmgmyr\Messenger\Models\Thread;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Carbon\Carbon;

require 'C:\xampp\htdocs\Re-use-of-items-information-systema/vendor/autoload.php';

use seregazhuk\PinterestBot\Factories\PinterestBot;

class ItemController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function index()
    {
        //$announcements = Post::where(['User_idUser'=> Auth::User()->id])->orderBy('created_at', 'desc')->paginate(20);
        $announcements = Item::all();
        $services = Service::all();
        return view('personalAnnouncement', compact('announcements', 'services'));
    }
    //Item and services info and delete
    public function itemInfo($id){
        $item = Item::find($id);
        $image = Image::All();
        $name = $item->user->name;

        //too if item is bought or not
        $bought = BoughtItem::where(['items_announcement_id' => $id])->value('id');

        //If user click remember item
        $remember = RememberItem::where(['items_announcement_id' => $id, 'users_id' => Auth::user()->id])->value('id');

        //PinterestAPI and keywords
       $bot = PinterestBot::create();
        //$keywords = Tag::All(); //all tags

        //takes only selected keywords from announcement creation
        $test = ItemHasTags::where(['items_announcement_id' => $id])->get();

        //First keyword
        $pins = $bot->pins->search($test[0]->tags->name)->take(7)->toArray();
        $tagid = $test[0]->tags_id;
        $per_page = 1;
        $pins = (new Collection($pins))->paginate($per_page);
        //Second Keyword
        $pins2 = $bot->pins->search($test[1]->tags->name)->take(7)->toArray();
        $tagid2 = $test[1]->tags_id;
        $pins2 = (new Collection($pins2))->paginate($per_page);
        //Third keyword
        $pins3 = $bot->pins->search($test[2]->tags->name)->take(7)->toArray();
        $tagid3 = $test[2]->tags_id;
        $pins3 = (new Collection($pins3))->paginate($per_page);
        //Show possible reuse services
        $lenght = $test->count();

        for($count = 0; $count < $lenght; $count++) {
            $service = ServiceHasTags::where(['tags_id' => $test[$count]->tags_id])->get();
        }

        //show saved announcements
        $itemhasservice = ItemHasService::where(['items_announcement_id' => $id, 'user_id' => Auth::User()->id])->get();
        //show saved pins
        $itemhaspins = ItemHasPins::where(['items_announcement_id' => $id, 'user_id' => Auth::User()->id])->paginate(3);

        return view('itemInformation', compact('item', 'image', 'pins', 'pins2', 'pins3', 'remember', 'bought', 'service', 'itemhasservice', 'itemhaspins'))->with('name', $name)->with('tagid', $tagid)->with('tagid2', $tagid2)->with('tagid3', $tagid3);
    }
    public function itemdelete($id){
        $item = Item::find($id);
        $item->hide = 1;
        $item->save();

        return redirect()->route('personalAnn')->with('status', 'Skelbimas sėkmingai ištrintas');
    }
    public function serviceInfo($id){
        $service = Service::find($id);
        $remember = RememberService::where(['services_announcement_id' => $id, 'users_id' => Auth::user()->id])->value('id');

        $bought = BoughtService::where(['services_announcement_id' => $id, 'users_id' => Auth::user()->id])->value('id');

        $boughtcheck = BoughtService::where(['services_announcement_id' => $id, 'users_id' => Auth::user()->id])->pluck('name')->toArray();
        //dd($boughtcheck);
        for($i = 0; $i < count($boughtcheck); $i++) {
            if ($boughtcheck[$i] == null) {
                $bought = 1;
                break;
            }
            else{
                $bought = null;
            }
        }

        //dd($bought);
        $name = $service->user->name;

        return view('serviceInformation', compact('service', 'remember'))->with('name', $name)->with('bought', $bought);
    }
    public function servicedelete($id){
        $service = Service::find($id);
        $service->hide = 1;
        $service->save();
        return redirect()->route('personalAnn')->with('status', 'Skelbimas sėkmingai ištrintas');
    }
    //update announcements
    public function editItem($id){

        $item = Item::find($id);

        return view('itemEdit',compact('item')); //->with('messages','id');
    }
    public function updateItem(Request $request,$id){

        $this->validate($request, [
            'name' => 'required',
            'info' => 'required',
            'address' => 'required',
            'price' => 'required'

        ]);
        $item = Item::findOrFail($id);
        $itemname = $request->input('name');
        $address = $request->input('address');
        $info = $request->input('info');
        $price = $request->input('price');
        $item->name = $itemname;
        $item->address = $address;
        $item->information = $info;
        $item->price = $price;


        $item->save();
        return redirect()->route('itemshow', $id)->with('status','Testo informacija atnaujinta');
    }
    public function editservice($id){

        $service = Service::find($id);

        return view('serviceEdit',compact('service'));
    }
    public function updateservice(Request $request,$id){

        $this->validate($request, [
            'name' => 'required',
            'info' => 'required',
            'price' => 'required'

        ]);
        $service = Service::findOrFail($id);
        $name = $request->input('name');
        $info = $request->input('info');
        $price = $request->input('price');
        $service->name = $name;
        $service->information = $info;
        $service->price = $price;


        $service->save();
        return redirect()->route('serviceshow', $id)->with('status','Skelbimo informacija atnaujinta');
    }

    //create
    public function itemcreate()
    {
        $tags = Tag::all();
        return view('itemAnnouncementAdd', compact('tags'));
    }
    public function itemstore(Request $request)
    {
        $item = new Item;
        $item->name = $request->get('name');
        $item->price = $request->get('price');
        $item->address = $request->get('address');
        $item->information = $request->get('info');

        if($request->change == null){
            $item->change = 0;
        }
        else{
            $item->change = 1;
        }
        $item->user_id = Auth::user()->id;
        $item->save();
        //Save tags to database
          $rules = array(
              'tags.*' => 'required'
          );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json([
                'error' => $error->errors()->all()
            ]);
        }
        $tag = $request->tags;
        for ($count = 0; $count < count($tag); $count++) {
            //$testID[$count] = $item->id;
            $data = array(
                'tags_id' => $tag[$count],
                'items_announcement_id' => $item->id
            );
            $insert_data[] = $data;
        }

        //dd($testID);
        ItemHasTags::insert($insert_data);

//FOTKE---------------------------------------------
        $request->validate([
            'images' => 'required',
        ]);

        if ($request->hasfile('images')) {
            $images = $request->file('images');

            foreach($images as $image) {
                $posts_id2 = $item->id;
                //dd($posts_id2);
                $name = $image->getClientOriginalName();
                $path = $image->storeAs('uploads', $name,'public');
                //dd($path);
                Storage::disk('public')->put($name, '/storage/'.$path);
                Image::create([
                    'post_id' => $posts_id2,
                    'name' => $name,
                    'user_id' => Auth::User()->id,
                    'path' => '/storage/'.$path
                ]);
            }
        }
        //-------------------------------------------------
        return redirect()->route('personalAnn');

    }
    public function servicecreate()
    {
        return view('serviceAnnouncementAdd');
    }
    public function servicestore(Request $request)
    {
        $service = new service;
        $service->name = $request->get('name');
        $service->price = $request->get('price');
        $service->information = $request->get('info');

        $service->user_id = Auth::user()->id;
        $service->save();

        //Save tags to database
        $rules = array(
            'tags.*' => 'required'
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json([
                'error' => $error->errors()->all()
            ]);
        }
        $tag = $request->tags;
        for ($count = 0; $count < count($tag); $count++) {
            //$testID[$count] = $item->id;
            $data = array(
                'tags_id' => $tag[$count],
                'services_announcement_id' => $service->id
            );
            $insert_data[] = $data;
        }

        ServiceHasTags::insert($insert_data);

        return redirect()->route('personalAnn');

    }
    public function showItems()
    {
        //$announcements = Post::where(['User_idUser'=> Auth::User()->id])->orderBy('created_at', 'desc')->paginate(20);
        $announcements = Item::all();
        return view('itemAnnouncementList', compact('announcements'));
    }
    public function showServices()
    {
        //$announcements = Post::where(['User_idUser'=> Auth::User()->id])->orderBy('created_at', 'desc')->paginate(20);
        $services = Service::all();
        return view('serviceAnnouncementList', compact( 'services'));
    }

    //remember/forget services
    public function rememberService($id)
    {
        $remember = new RememberService();
        $remember->services_announcement_id = $id;
        $remember->users_id = Auth::User()->id;

        $remember->save();
        return redirect()->route('serviceshow', $id);
    }

    public function rememberItem($id)
    {
        $remember = new RememberItem();
        $remember->items_announcement_id = $id;
        $remember->users_id = Auth::User()->id;

        $remember->save();
        return redirect()->route('itemshow', $id);
    }
    public function showRememberAnnoun()
    {
        $rememberItem = RememberItem::where(['users_id' => Auth::User()->id])->get();
        $rememberService = RememberService::where(['users_id' => Auth::User()->id])->get();
        return view('rememberAnnouncement', compact('rememberItem', 'rememberService'));
    }
    public function forgetService($id){
        $forgetservice = RememberService::where(['services_announcement_id' => $id]);
        $forgetservice->delete();
        return redirect()->route('rememberAnn');
    }
    public function forgetItem($id){
        $forgetitem = RememberItem::where(['items_announcement_id' => $id]);
        $forgetitem->delete();
        return redirect()->route('rememberAnn');
    }

    //------Buy items and services
    public function buyItem($id, $user_id){
        $buy = new BoughtItem();
        $buy->items_announcement_id = $id;
        $buy->users_id = Auth::User()->id;

        //send system message
        $thread = Thread::create([
            'subject' => 'Daikto nupirkimas',
        ]);

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => 'Sveiki, aš įsigijau jūsų daiktą, atsakykite į šį laišką, susitarsime siuntimo/pasiemimo sąlygas',
        ]);

        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'last_read' => new Carbon,
        ]);

        // Recipients
        $thread->addParticipant($user_id);

        $buy->save();

        return redirect()->route('itemshow', $id);
    }
    public function showBoughtItems()
    {
        //$announcements = Post::where(['User_idUser'=> Auth::User()->id])->orderBy('created_at', 'desc')->paginate(20);
        $announcements = BoughtItem::where(['users_id' => Auth::User()->id])->get();
        return view('boughtItems', compact('announcements'));
    }

    public function buyService($id, $user_id){
        $buy = new BoughtService();
        $buy->services_announcement_id = $id;
        $buy->users_id = Auth::User()->id;

        //send system message
        $thread = Thread::create([
            'subject' => 'Paslaugos įsigyjimas',
        ]);

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => 'Sveiki, aš įsigijau jūsų paslaugą, atsakykite į šį laišką, susitarsime perdarymo sąlygas',
        ]);

        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'last_read' => new Carbon,
        ]);

        // Recipients
        $thread->addParticipant($user_id);

        $buy->save();

        return redirect()->route('serviceshow', $id);
    }
    public function showPortfolio($id){
        $owner = Service::where(['user_id' => $id])->pluck('id')->toArray();
        $port = BoughtService::whereIn('services_announcement_id', $owner)->get();

        $comments = ServicesRate::where(['users_id' => $id])->get();

        $boughtcheck = BoughtService::whereIn('services_announcement_id', $owner)->where('users_id', Auth::user()->id)->pluck('name')->toArray();
        //dd($boughtcheck);
        $notdone = 'yi';
        for($i = 0; $i < count($boughtcheck); $i++) {
            if ($boughtcheck[$i] == null) {
                $notdone = 1;
                break;
            }
            else{
                $notdone = null;
            }
        }
        $exist = ServicesRate::where(['buyername' => Auth::User()->name, 'users_id' => $id])->value('buyername');
        //dd($exist);

        return view('portfolio', compact('port', 'comments'))->with('id', $id)->with('notdone', $notdone)->with('exist', $exist);
    }
    public function showPortfolioUpload($id, $id2){
        return view('portfolioUpload')->with('id', $id)->with('id2', $id2);
    }

    public function portofliostore(Request $request, $id, $id2)
    {
        $boughtservice = BoughtService::findOrFail($id2);
        $name = $request->input('postname');
        $boughtservice->postname = $name;

//FOTKE---------------------------------------------
        $request->validate([
            'image' => 'required',
            'image2' => 'required',
        ]);

        if ($request->hasfile('image')) {
            $image = $request->file('image');


                $name = $image->getClientOriginalName();
                $path = $image->storeAs('uploads', $name,'public');

                Storage::disk('public')->put($name, '/storage/'.$path);
                $boughtservice->name = $name;
                $boughtservice->path = '/storage/'.$path;

        }
        if ($request->hasfile('image2')) {
            $image2 = $request->file('image2');


            $name2 = $image2->getClientOriginalName();
            $path2 = $image2->storeAs('uploads', $name2,'public');

            Storage::disk('public')->put($name2, '/storage/'.$path2);
            $boughtservice->name2 = $name2;
            $boughtservice->path2 = '/storage/'.$path2;
            $boughtservice->save();

        }
        //-------------------------------------------------
        return redirect()->route('portfolioshow', $id);

    }
    public function rateService(Request $request, $id){
        $comment = $request->input('comment');
        $stars = $request->get('stars');
        $rate = new ServicesRate();
        $rate->comment = $comment;
        $rate->buyername = Auth::User()->name;
        $rate->rate = $stars;
        $rate->users_id = $id;

        $rate->save();
        return redirect()->route('portfolioshow', $id);
    }

    //Save pin and services in announcement
    public function saveService($id, $servid){
        $itemhserv = new ItemHasService();
        $itemhserv->user_id = Auth::User()->id;
        $itemhserv->items_announcement_id = $id;
        $itemhserv->services_announcement_id = $servid;

        $itemhserv->save();
        return redirect()->route('itemshow', $id);
    }

    public function savePins($id, $pin, $tagid){
        $itemhpin = new ItemHasPins();
        $itemhpin->user_id = Auth::User()->id;
        $itemhpin->items_announcement_id = $id;
        $itemhpin->pinpicture = $pin;

        $tag = Tag::find($tagid);
        $tag->like = $tag->like + 1;

        $tag->save();
        $itemhpin->save();
        return redirect()->route('itemshow', $id);
    }
    public function forgetItemService($id, $someid){
        $noservice = ItemHasService::find($someid);
        $noservice->delete();

        return redirect()->route('itemshow', $id);
    }

}
