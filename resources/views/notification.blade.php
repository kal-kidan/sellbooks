@extends('layouts.header')
@section('head')
@endsection
@section('content')

@if(!session()->get('alldetail'))
<div class="card p-4 m-3">you have no notifications</div>
@else
   @foreach(session()->get('alldetail') as $details)
     <!-- modal message box -->
   <?php $modalId="message_box".$loop->index  ?>
   <div class="w3-modal message-box" id="{{$modalId}}" >
      <span class="fa fa-times text-danger w3-large" onclick="hideModal({{$modalId}})"
      style="float:right;cursor:pointer"> </span>
      <div class="w3-modal-content p-3">
         <div class="card p-2 m-2">
           <img src="{{$details->path}}" class="w3-circle" width="50px" height="50px">
          <span class="text-primary">{{$details->user->name}}</span>
          <small>Phone Number: {{$details->user->phonenumber}}</small>
          <small>Address: {{$details->user->address}}</small>
          <small>City:{{$details->user->city}}</small><br>
          <form class="" action="/sendmessage" method="post">
            @csrf
             <input type="hidden" name="receiver" value="{{$details->user->id}}">
             <input type="hidden" name="sender" value="{{Auth::user()->id}}">
             <textarea name="message" class="w3-round " style="width:100%;outline:none"></textarea>
             <button type="submit" class="btn btn-primary">Send</button>
          </form>
         </div>

      </div>
   </div>

      <div class="w3-card p-3 m-3">
        <i>{{$details->user->name}}</i>  wants to buy your book
        <span class="text-primary"> {{$details->book->booktitle}}</span>
        <span class="w3-hover-opacity" style="color:blue;cursor:pointer" onclick="showMessageForm({{$modalId }})">contact</span>

      </div>
    @endforeach

@endif

@endsection
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
