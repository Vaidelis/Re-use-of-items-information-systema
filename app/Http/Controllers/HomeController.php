<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userInfo = User::where(['id' => Auth::User()->id])->first();
        $status = null;
        $status2 = null;
        return view('home', compact('userInfo'))->with('status',  $status)->with('status2',  $status2);
    }

    public function updatePass(Request $request){

        $password = $request->get('password');
        $password_confirmation= $request->get('password_confirmation');
        $id = Auth::user()->id;

        $userInfo = User::find($id);

        if( $password != $password_confirmation)
        {
            $status = "Slaptažodiai nesutampa";
            $status2 = null;
            return view('home', compact('userInfo'))->with('status',  $status)->with('status2',  $status2);
        }
        else{
            $hashedPass = Hash::make($password);

            User::where('id',$id)->update(['password' => $hashedPass]);

            $userInfo = User::find($id);
            $status2 = "Slaptažodis sėkmingai pakeistas";
            $status = null;
            return view('home', compact('userInfo'))->with('status2',  $status2)->with('status',  $status);
        }
    }
}
