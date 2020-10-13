<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Soldbook;
use Auth;
class IncomingNotificationController extends Controller

{
  // public function __construct()
  //   {
  //   $this->middleware('check_login');
  //   }
  public function notification(){
    $users=[];
    $books=[];
    $response=[];
    $id=Auth::user()->id;
    $soldbooks=Soldbook::where([['owner','=',$id],['seen','=',0]])->get();
    $i=0;
    foreach ($soldbooks as $soldbook) {
      $user=$soldbooks[$i]->users;
      $book=$soldbooks[$i]->books;
      $response[$i]="{\"user\":$user,\"book\":$book,\"soldbook\":$soldbook}";
      $i++;
    }

     return response()->json($response);
  }

}
/**
 *
 */
