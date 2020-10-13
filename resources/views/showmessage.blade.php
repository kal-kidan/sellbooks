<?php
 use App\Message;
 $sender=Auth::user()->id;
 $receiver=$id;
 $messages= Message::where([['sender',$receiver],['receiver',$sender]])->orderBy('id','desc')->get()->take(1);
 // echo $messages;
 // exit;
 if (!empty($messages) && count($messages)>0) {  
   $message_id= $messages[0]->id ;
   $last_message=Message::find($message_id);
   $last_message->seen=1;
   $last_message->save();

 }


 ?>
@extends('layouts.header')
@section('head')
@endsection
@section('content')
<div class="w3-card p-4 col col-lg-6 col-md-7 ml-3 mr-3" >
  <div class="" id="content" style="height:300px;overflow-y:scroll;">

  </div>
  <form class="" action="/sendmessage" method="post">
    @csrf
    <textarea name="message" style="width:95%;margin:2%" class="w3-round" ></textarea>
    <button type="submit" class="btn btn-primary" style="float:right">Send</button>
     <input type="hidden" name="sender" id="sender" value="{{Auth::user()->id}}">
     <input type="hidden" name="receiver" id="receiver" value="{{$id}}">
  </form>
</div>
<input type="hidden" name="change" id="change" value="-1">
@section('script')
<script type="text/javascript">
  function showmessage(){
    var id=document.getElementById("receiver").value;
    var xmlhttp=new XMLHttpRequest();

       xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState == 4 && xmlhttp.status==200) {
            var messages=JSON.parse(xmlhttp.responseText);
            messages.sort(function(a,b){
              if (a.id>b.id) {
                 return 1;
              }
              else if (a.id<b.id)  {
                 return -1;
              }
              else {
                return 0;
              }
            });
            if (document.getElementById("change").value==-1) {
                   document.getElementById("change").value=messages[messages.length-1].message;
                   for (let i = 0; i < messages.length; i++) {
                       var message=document.createElement("div");
                       var date=document.createElement("span");
                       var message_container=document.createElement("div");
                       date.style.fontSize="9px";
                       date.innerHTML=messages[i].updated_at;
                       if (messages[i].sender==id) {
                           message.className="w3-teal p-2 m-2 w3-round-xlarge";
                       }
                       else {
                           message.className="alert alert-success p-2 m-2 w3-round-xlarge";
                       }

                       var text=document.createTextNode(messages[i].message);
                       message.appendChild(text);
                       var content=document.getElementById("content");
                       message_container.appendChild(message);
                       message_container.appendChild(date);
                       content.appendChild(message_container);
                   }

             }
            else {
              var change=document.getElementById("change").value;
              var last_message=messages[messages.length-1].message;
              var len=messages.length;
              if (change!=last_message) {
                var message=document.createElement("div");
                if (messages[len-1].sender==id) {
                    message.className="w3-teal p-2 m-2 w3-round-xlarge";
                }
                else {
                    message.className="alert alert-success p-2 m-2 w3-round-xlarge";
                }
                var message_container=document.createElement("div");
                var text=document.createTextNode(messages[len-1].message);
                var date=document.createElement("span");
                date.style.fontSize="9px";
                date.innerHTML=messages[len-1].updated_at;
                var content=document.getElementById("content"); ;
                message_container.appendChild(text);
                message_container.appendChild(message);
                message_container.appendChild(date);
                content.appendChild(message_container);
                document.getElementById("change").value=messages[len-1].message;
              }
            }
           }
         }

      xmlhttp.open('GET','/eachmessage?id='+id,true);
      xmlhttp.send();
  }
 // showmessage();
 setInterval(showmessage,1000);
</script>
@endsection
@endsection
