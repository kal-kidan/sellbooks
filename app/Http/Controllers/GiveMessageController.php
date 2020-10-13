<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Message;
class GiveMessageController extends Controller
{
  public function __construct()
    {
    $this->middleware('check_login');
    }
  public function give(){
     $id=Auth::user()->id;
     if (!isset($_GET['id'])) {
      return redirect('/login');
      exit;
     }
     $ids=$_GET['id']; 
     $messages=Message::where([['sender',$id],['receiver',$ids]])->orWhere([['receiver',$id],['sender',$ids]])->orderBy('id','desc')->get()->take(10);
     return response()->json($messages);
  }

}
