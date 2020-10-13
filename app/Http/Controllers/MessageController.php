<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
class MessageController extends Controller
{
    public function send(Request $request){
       $this->validate($request,[
         'message'=>'required|string|max:255'
       ]);
       $messge_table=new Message;
       $message=htmlspecialchars($request->input('message'));
       $sender=$request->input('sender');
       $receiver=$request->input('receiver');
       $messge_table->sender=$sender;
       $messge_table->receiver=$receiver;
       $messge_table->message=$message;
       $messge_table->save();
       return redirect('/showmessages');
    }
    public function sendmessage(Request $request){
      $this->validate($request,[
        'message'=>'required|string|max:255'
      ]);
      $messge_table=new Message;
      $message=htmlspecialchars($request->input('message'));
      $sender=$request->input('sender');
      $receiver=$request->input('receiver');
      $messge_table->sender=$sender;
      $messge_table->receiver=$receiver;
      $messge_table->message=$message;
      $messge_table->save();
      session()->forget('messages');
      return redirect('/eachmessage?id='.$sender);
    }
}
