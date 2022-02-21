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
}
