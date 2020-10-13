<?php
use App\Post;
$searchResults=session('searchResults');
$post=[];
$images=[];
$users=[];
$display="display:none";

if (!empty($searchResults) || $searchResults!=null) {
  $i=0;
  foreach ($searchResults as $id) {
   $posts[$i]=Post::find($id);
   $images[$i]=$posts[$i]->images[0]->path;
   $users[$i]=$posts[$i]->user;
   $i++;
  }
}
else {
   $display="display:block";
}

 ?>
 @extends('layouts.header')
 @section('content')
 <div class='card p-3 m-3' style="{{$display}}">
  NO Search Result Found..
 </div>
 @foreach($searchResults as $id)
  <?php $modalId="message_box".$loop->index ?>
 <div class="card m-2">
   <div class="row p-2">
       <div class="col-sm-12 col-lg-3 col-md-3">
          <img src="{{$images[$loop->index]}}" alt="" width="200px" height="210px"> <br>
          <h3 style="text-transform:uppercase" >{{$posts[$loop->index]->booktitle}}</h3>
       </div>
       <div class="col-sm-12 col-lg-7 col-md-7">
          <h4>Book Author: {{$posts[$loop->index]->bookauthor}}</h4>
          <small>Category: {{$posts[$loop->index]->category}}</small><br>
          <small>Price: {{$posts[$loop->index]->price}}</small>
          <hr>
          <p>{{$posts[$loop->index]->bookdetail}}</p>
          @if($users[$loop->index]->id!=Auth::user()->id)
          <form class="" action="/buynow" method="post">
            @csrf

          <button type="submit" class="btn btn-primary">Buy Now</button>
          <button type="button" class="btn btn-primary" onclick="showMessageForm({{$modalId}})">Contact Owner</button>
          <input type="hidden" name="bookid" value="{{$posts[$loop->index]->id}}">
          <input type="hidden" name="owner" value="{{$users[$loop->index]->id}}">
          <input type="hidden" name="buyer" value="{{Auth::user()->id}}">
          </form>

          @else
          <a href="/myposts" class="btn btn-primary">See Post</a>
          @endif

       </div>
   </div>

 </div>

 <!-- send message -->

   <div class="w3-modal message-box" id="{{$modalId}}" >
      <span class="fa fa-times text-danger w3-large" onclick="hideModal({{$modalId}})"
      style="float:right;cursor:pointer"> </span>
      <div class="w3-modal-content p-3">
         <div class="card p-2 m-2">
           <img src="{{$users[$loop->index]->images[0]->path}}" class="w3-circle" width="50px" height="50px">
          <span class="text-primary">{{$users[$loop->index]->name}}</span>
          <small>Phone Number: {{$users[$loop->index]->phonenumber}}</small>
          <small>Address: {{$users[$loop->index]->address}}</small>
          <small>City:{{$users[$loop->index]->city}}</small><br>
          <form class="" action="/sendmessage" method="post">
            @csrf
             <input type="hidden" name="bookid" value="{{$posts[$loop->index]->id}}">
             <input type="hidden" name="receiver" value="{{$users[$loop->index]->id}}">
             <input type="hidden" name="sender" value="{{Auth::user()->id}}">
             <textarea name="message" class="w3-round " style="width:100%;outline:none"></textarea>
             <button type="submit" class="btn btn-primary">Send</button>
          </form>
         </div>

      </div>
   </div>
 @endforeach
 @section('script')
    <script type="text/javascript">
      function showMessageForm(obj){
        var id=obj.id;
        document.getElementById(id).style.display="block";
      }
      function hideModal(obj){
      var id=obj.id;
      document.getElementById(id).style.display='none';
      }
    </script>
 @endsection
@endsection
