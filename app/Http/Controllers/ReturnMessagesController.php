<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Message;
use App\User;
use Auth;
class ReturnMessagesController extends Controller
{
  public function __construct()
    {
    $this->middleware('check_login');
    }
    public function return_messge(){
      $user_ids=[];
      $id=Auth::user()->id;
      $messages=Message::where([['sender',$id]])->orWhere([['receiver',$id]])->orderBy('created_at')->get();
      $i=0;
      $user_info=[];
      foreach ($messages as $message) {
          $id_sender=$message->sender;
          $id_receiver=$message->receiver;
         if (!in_array($id_sender,$user_ids)) {
           if ($id!=$id_sender) {
             $user_ids[$i]=$id_sender;
             $i++;
           }
         }
         if (!in_array($id_receiver,$user_ids)) {
           if ($id!=$id_receiver) {
             $user_ids[$i]=$id_receiver;
             $i++;
           }
         }
      }
      $j=0;
      foreach ($user_ids as $ids) {
        $user=User::find($ids);
        $path=User::find($ids)->images[0]->path ;
        $last_message=Message::where([['sender',$id],['receiver',$ids]])->orWhere([['receiver',$id],['sender',$ids]])->orderBy('created_at','desc')->get()->take(1);
        $user->last_message=$last_message[0]->message;
        $user->seen=$last_message[0]->seen;
        $user->sender=$last_message[0]->sender;
        $user->path=$path;
        $user_info[$j]=$user;
        $j++;
      }
      return $user_info;
    }
  public function messages(){
    $user_info=$this->return_messge();
    session()->put('users',$user_info);
    return redirect('/message')->with('send','true');
  }
  public function unseen_messages(){
    $id=Auth::user()->id;
    $user_info=$this->return_messge();
    $unseen_count=0;
    foreach ($user_info as $value) {
      if ($value->seen==0 && $value->sender!=$id) {
        $unseen_count++;
      }
    }
    return response()->json($unseen_count);
  }

}
