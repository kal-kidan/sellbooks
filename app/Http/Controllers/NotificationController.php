<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Soldbook;
use Auth;
class NotificationController extends Controller
{
  public function __construct()
    {
    $this->middleware('check_login');
    }
  public function notification(){
    $users=[];
    $books=[];
    $response=[];
    $id=Auth::user()->id;
    $soldbooks=Soldbook::where([['owner','=',$id]])->orderBy('updated_at')->get();
    Soldbook::where([['owner','=',$id]])->update(['seen'=>1]);
    $i=0;
    foreach ($soldbooks as $soldbook) {
      $user=$soldbooks[$i]->users;
      $image=$user->images[0]->path;
      $book=$soldbooks[$i]->books;
      $response[$i]="{\"user\":$user,\"book\":$book,\"soldbook\":$soldbook,\"path\":\"$image\"}";
      $response[$i]=json_decode($response[$i]);
      $i++;
    }
    session()->put('alldetail',$response);
    return redirect('/notifications');
}
}
