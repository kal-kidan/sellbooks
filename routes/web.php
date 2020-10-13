<?php

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
Route::get('/unseen','ReturnMessagesController@unseen_messages');

Route::get('/account', ['middleware'=>'check_login',function () {
    return view('account');
}])->name('account');
Route::get('/chat/{id}', ['middleware'=>'check_login',function ($id) {
    return view('showmessage')->with('id',$id);
}])->name('chat');
Route::get('/post',['middleware'=>'check_login',function (){
return view('post');
}])->name('post');
Route::post('/postbook','PostController@post');
Route::get('/myposts','PostController@mypost')->name('myposts');
Route::get('/myaccount',['middleware'=>'check_login',function(){
return view('myaccount');
}])->name('myaccount');

Route::get('/successmessage',function(){
return view('successmessage');
})->name('successmessage');


Route::get('/searchresult',['middleware'=>'search_middleware','middleware'=>'check_login',function(){
   return view('searchresult');
}])->name('searchresult');

Route::get('/message',['middleware'=>'message_middleware','middleware'=>'check_login',function(){
return view('messages');
}])->name('message');


Route::get('notification','IncomingNotificationController@notification');
Route::get('shownotification','NotificationController@notification');
Route::get('showmessages','ReturnMessagesController@messages');
Route::get('/notifications',['middleware'=>'notification_middleware','middleware'=>'check_login',function(){
return view('notification');
}])->name('notifications');
Route::get('eachmessage','GiveMessageController@give');

//update form routes
Route::post('/updatename','UpdateController@update_name');
Route::post('/updatephonenumber','UpdateController@update_phone_number');
Route::post('/updateaddress','UpdateController@update_address');
Route::post('/updatecity','UpdateController@update_city');
Route::post('/changepassword','UpdateController@change_password');
Route::post('/uploadprofile','UpdateController@upload_profile');
Route::post('/addfavorite','UpdateController@add_favorite');

 Route::post('/deletepost','DeleteController@delete_post');
 Route::post("/search",'SearchController@search');
 Route::post("/buynow",'BuyNow@buynow');
 Route::post("/sendmessage",'MessageController@send');
 Route::post("/send",'MessageController@sendmessage');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
