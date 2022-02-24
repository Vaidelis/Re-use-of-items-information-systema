<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Service;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Auth;
use Session;

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

        return view('itemInformation', compact('item', 'image'))->with('name', $name);
    }
    public function itemdelete($id){
        $item = Item::find($id);
        $images = Image::where(['post_id' => $id]);

        $item->delete();
        $images->delete();
        return redirect()->route('personalAnn')->with('status', 'Skelbimas sėkmingai ištrintas');
    }
    public function serviceInfo($id){
        $service = Service::find($id);
        $name = $service->user->name;

        return view('serviceInformation', compact('service'))->with('name', $name);
    }
    public function servicedelete($id){
        $service = Service::find($id);
        $service->delete();
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
        return view('itemAnnouncementAdd');
    }
    public function itemstore(Request $request)
    {
        $item = new Item;
        $item->name = $request->get('name');
        $item->price = $request->get('price');
        $item->address = $request->get('address');
        $item->information = $request->get('info');

        $item->user_id = Auth::user()->id;
        $item->save();
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
}
