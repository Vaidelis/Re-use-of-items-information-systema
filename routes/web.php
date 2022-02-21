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
//Item delete
Route::delete('/personalAnnouncement/itemInformation/delete/{id}', 'App\Http\Controllers\ItemController@itemdelete')->name('itemdestroy');
//Service delete
Route::delete('/personalAnnouncement/serviceInformation/delete/{id}', 'App\Http\Controllers\ItemController@servicedelete')->name('servicedestroy');





//----Auth
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
