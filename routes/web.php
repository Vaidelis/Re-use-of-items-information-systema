<?php

use App\Models\Image;
use App\Models\Item;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $announcements = Item::orderBy('created_at', 'desc')->take(3)->get();
    $services = Service::orderBy('created_at', 'desc')->take(3)->get();

    $images = Image::all();

    return view('welcome', compact('announcements', 'services', 'images'));
});
//----Personal announcements show, delete, create, edit
Route::get('/personalAnnouncement', 'App\Http\Controllers\ItemController@index')->name('personalAnn');

Route::get('/itemAnnouncement/itemInformation/{id}', 'App\Http\Controllers\ItemController@itemInfo')->name('itemshow');
Route::get('/serviceAnnouncement/serviceInformation/{id}', 'App\Http\Controllers\ItemController@serviceInfo')->name('serviceshow');
//delete
Route::get('/personalAnnouncement/itemInformation/delete/{id}', 'App\Http\Controllers\ItemController@itemdelete')->name('itemdestroy');
Route::get('/personalAnnouncement/serviceInformation/delete/{id}', 'App\Http\Controllers\ItemController@servicedelete')->name('servicedestroy');
//Route::delete('/personalAnnouncement/serviceInformation/delete/{id}', 'App\Http\Controllers\ItemController@servicedelete')->name('servicedestroy');
//Announcements edit
Route::get('/personalAnnouncement/itemInformation/{id}/itemEdit', 'App\Http\Controllers\ItemController@edititem')->name('itemedit');
Route::match(['put','patch'],'{id}/itemEdit', 'App\Http\Controllers\ItemController@updateitem')->name('itemupdate');

Route::get('/personalAnnouncement/serviceInformation/{id}/serviceEdit', 'App\Http\Controllers\ItemController@editservice')->name('serviceedit');
Route::match(['put','patch'],'{id}/serviceEdit', 'App\Http\Controllers\ItemController@updateservice')->name('serviceupdate');

//Announcement create
Route::get('/personalAnnouncement/itemcreate', 'App\Http\Controllers\ItemController@itemcreate')->name('createitem');
Route::post('/personalAnnouncement/itemcreate/store', 'App\Http\Controllers\ItemController@itemstore')->name('storeitem');

Route::get('/personalAnnouncement/servicecreate', 'App\Http\Controllers\ItemController@servicecreate')->name('createservice');
Route::post('/personalAnnouncement/servicecreate/store', 'App\Http\Controllers\ItemController@servicestore')->name('storeservice');
//---------------------------------------------------
//-------Announcements(Item)
Route::get('/itemAnnouncementList', 'App\Http\Controllers\ItemController@showitems')->name('itemannounc');
Route::get('/itemAnnouncementList/itemInformation/save/{id}', 'App\Http\Controllers\ItemController@rememberItem')->name('rememberitem');
Route::delete('/rememberAnnouncemenets/itemInformation/delete/{id}', 'App\Http\Controllers\ItemController@forgetItem')->name('itemforget');

Route::get('/itemAnnouncementList/itemInformation/buy/{id}/{userid}', 'App\Http\Controllers\ItemController@buyItem')->name('itembuy'); //buy

//-------Announcements(Services)
Route::get('/serviceAnnouncementList', 'App\Http\Controllers\ItemController@showservices')->name('serviceannounc');
Route::get('/serviceAnnouncementList/serviceInformation/save/{id}', 'App\Http\Controllers\ItemController@rememberService')->name('rememberservice');
Route::delete('/rememberAnnouncemenets/serviceInformation/delete/{id}', 'App\Http\Controllers\ItemController@forgetService')->name('serviceforget');
Route::get('/serviceAnnouncementList/serviceInformation/buy/{id}/{userid}', 'App\Http\Controllers\ItemController@buyservice')->name('servicebuy'); //buy
//remember/bought announcements
Route::get('/rememberAnnouncemenets', 'App\Http\Controllers\ItemController@showRememberAnnoun')->name('rememberAnn');
Route::get('/boughtItems', 'App\Http\Controllers\ItemController@showBoughtItems')->name('boughtitemshow');

//User profile(change password)
Route::post('/home', 'App\Http\Controllers\HomeController@updatePass')->name('UpdatePassword');

//User portfolio
Route::get('/portfolio/{id}', 'App\Http\Controllers\ItemController@showPortfolio')->name('portfolioshow');
Route::get('/portfolio/{id}/upload/{id2}', 'App\Http\Controllers\ItemController@showPortfolioUpload')->name('portfoliouploadshow');
Route::post('/portfolio/{id}/upload/{id2}/store', 'App\Http\Controllers\ItemController@portofliostore')->name('storeportfolio');

Route::post('/portfolio/{id}/y', 'App\Http\Controllers\ItemController@rateService')->name('servicerate');


//Messages
Route::get('/messageList', 'App\Http\Controllers\MessageController@index')->name('openmessagelist');
Route::get('/messageList/{thread}', 'App\Http\Controllers\MessageController@show')->name('showmessage');
Route::get('/messageCreate{id}', 'App\Http\Controllers\MessageController@create')->name('createmessage');
Route::post('/messageList', 'App\Http\Controllers\MessageController@store')->name('storemessage');
Route::delete('/messageList/{thread}', 'App\Http\Controllers\MessageController@destroy')->name('destroymessage');
Route::put('/messageList/{thread}', 'App\Http\Controllers\MessageController@update')->name('updatemessage');

//remember service and pins in item announcement
Route::get('/itemAnnouncement/itemInformation/{id}/service/{servid}', 'App\Http\Controllers\ItemController@saveService')->name('saveserviceinitem');
Route::get('/itemAnnouncement/itemInformation/{id}/pin/{pin}/tagid/{tagid}', 'App\Http\Controllers\ItemController@savePins')->name('savepininitem');
Route::delete('/itemAnnouncement/itemInformation/{id}/forgetservice/{someid}', 'App\Http\Controllers\ItemController@forgetItemService')->name('itemnoservice');

//Search
Route::get('/itemAnnouncement/searchcat', 'App\Http\Controllers\ItemController@searchbycats')->name('sreachbycat');
Route::get('/serviceAnnouncement/searchcat', 'App\Http\Controllers\ItemController@searchbycatsservice')->name('sreachbycatservice');
Route::get('/search/searchbyitemsservices', 'App\Http\Controllers\ItemController@searchbycatsandservices')->name('searchitemsservices');

Route::get('/search', 'App\Http\Controllers\ItemController@searchkey')->name('keywordsearch');


//----Auth
Auth::routes();
//Login google
Route::get('auth/google', 'App\Http\Controllers\SocialController@redirect');
Route::get('auth/google/callback', 'App\Http\Controllers\SocialController@callback');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
