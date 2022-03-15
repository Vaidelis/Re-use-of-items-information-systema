<?php

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
    return view('welcome');
});
//----Personal announcements show, delete, create, edit
Route::get('/personalAnnouncement', 'App\Http\Controllers\ItemController@index')->name('personalAnn');

Route::get('/personalAnnouncement/itemInformation/{id}', 'App\Http\Controllers\ItemController@itemInfo')->name('itemshow');
Route::get('/personalAnnouncement/serviceInformation/{id}', 'App\Http\Controllers\ItemController@serviceInfo')->name('serviceshow');
//delete
Route::delete('/personalAnnouncement/itemInformation/delete/{id}', 'App\Http\Controllers\ItemController@itemdelete')->name('itemdestroy');
Route::delete('/personalAnnouncement/serviceInformation/delete/{id}', 'App\Http\Controllers\ItemController@servicedelete')->name('servicedestroy');
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
//-------Announcements(Services)
Route::get('/serviceAnnouncementList', 'App\Http\Controllers\ItemController@showservices')->name('serviceannounc');
Route::get('/serviceAnnouncementList/serviceInformation/save/{id}', 'App\Http\Controllers\ItemController@rememberService')->name('rememberservice');


//User profile(change password)
Route::post('/home', 'App\Http\Controllers\HomeController@updatePass')->name('UpdatePassword');

//Messages
Route::get('/messageList', 'App\Http\Controllers\MessageController@index')->name('openmessagelist');
Route::get('/messageList/{thread}', 'App\Http\Controllers\MessageController@show')->name('showmessage');
Route::get('/messageCreate', 'App\Http\Controllers\MessageController@create')->name('createmessage');
Route::post('/messageList', 'App\Http\Controllers\MessageController@store')->name('storemessage');
Route::delete('/messageList/{thread}', 'App\Http\Controllers\MessageController@destroy')->name('destroymessage');
Route::put('/messageList/{thread}', 'App\Http\Controllers\MessageController@update')->name('updatemessage');



//----Auth
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
