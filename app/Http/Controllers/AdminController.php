<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Service;
use App\Models\Image;
use App\Models\ItemHasTags;
use App\Models\Tag;
use seregazhuk\PinterestBot\Factories\PinterestBot;
use App\Support\Collection;
use Stichoza\GoogleTranslate\GoogleTranslate;

class AdminController extends Controller
{
    public function openUnconfirmedAnnouncementList(){
        $announcements = Item::Where(['aprooved' => 0, 'hide' => 0])->get();
        $services = Service::Where(['aprooved' => 0, 'hide' => 0])->get();
        $images = Image::all();
        return view('unconfirmedAnnouncementList', compact('announcements', 'services', 'images'));
    }
    public function openUnconfirmedAnnouncementInformation($id){
        $item = Item::find($id);
        $image = Image::All();
        $name = $item->user->name;

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

        return view('UnconfirmedAnnouncementInformation', compact('item', 'image', 'pins', 'pins2', 'pins3'))->with('name', $name)->with('tagid', $tagid)->with('tagid2', $tagid2)->with('tagid3', $tagid3);
    }
    //accept decline item announcement
    public function acceptAnnouncement($id){
        $item = Item::find($id);
        $item->aprooved = 1;
        $item->save();

        return redirect()->route('unconfirmedann')->with('status', 'Skelbimas sėkmingai priimtas');
    }
    public function declineItem($id){
        $item = Item::find($id);
        $item->hide = 1;
        $item->save();

        return redirect()->route('unconfirmedann')->with('status', 'Skelbimas sėkmingai ištrintas');
    }
    //open service announcement
    public function openUnconfirmedServiceInformation($id){
        $service = Service::find($id);

        $name = $service->user->name;

        return view('UnconfirmedAnnouncementServiceInformation', compact('service'))->with('name', $name);
    }
    //accept decline service announcement
    public function acceptService($id){
        $service = Service::find($id);
        $service->aprooved = 1;
        $service->save();

        return redirect()->route('unconfirmedann')->with('status', 'Skelbimas sėkmingai priimtas');
    }
    public function declineService($id){
        $service = Service::find($id);
        $service->hide = 1;
        $service->save();
        return redirect()->route('unconfirmedann')->with('status', 'Skelbimas sėkmingai ištrintas');
    }

    //Pinterest tags
    public function opentaglist(){
        $tags = Tag::all();
        $cats = Category::all();

        return view('tagsList', compact('tags', 'cats'));
    }
    public function showedittag($id){
        $tag = Tag::find($id);

        //PinterestAPI and keywords
        $bot = PinterestBot::create();

        //First keyword
        $pins = $bot->pins->search($tag->name)->take(30)->toArray();
        $per_page = 3;
        $pins = (new Collection($pins))->paginate($per_page);


        return view('tagsEdit', compact('tag', 'pins'));
    }
    public function edittag(Request $request, $id){

        $this->validate($request, [
            'namelt' => 'required',
            'name' => 'required',

        ]);
        $tag = Tag::findOrFail($id);
        $name = $request->input('name');
        $namelt = $request->input('namelt');
        $tag->name = $name;
        $tag->namelt = $namelt;


        $tag->save();
        return redirect()->route('opentag', $id)->with('status','Skelbimo informacija atnaujinta');

    }
    public function createtag(Request $request){

        $request->validate([
            'newtag' => 'required',
            'kategorija' => 'required',
        ]);
        $newtag = $request->input('newtag');
        $tr = new GoogleTranslate('en');
        $tagenglish = $tr->translate($newtag);

        $createtag = new Tag;
        $createtag->name = $tagenglish;
        $createtag->namelt = $newtag;
        $createtag->categorys_id = $request->get('kategorija');

        $createtag->save();

        return redirect()->route('taglist');
    }

}
