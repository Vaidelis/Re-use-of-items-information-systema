<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Service;

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
        $name = $item->user->name;

        return view('itemInformation', compact('item'))->with('name', $name);
    }
    public function itemdelete($id){
        $item = Item::find($id);
        $item->delete();
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

}
