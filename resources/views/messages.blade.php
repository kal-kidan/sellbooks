@extends('layouts.header')
@section('head')
@endsection
@section('content')
@if(session()->has('users'))
   @foreach(session('users') as $user)
   <?php $modalId="message-box".$user->id;$content="content".$user->id ?>
   <div class="card p-1 m-2 row" style="cursor:pointer" onclick="messages('{{$user->id}}')">
     <div class="">
       <img src="{{$user->path}}" class="w3-circle" width="40px" height="40px" >
       <span class="ml-1 text-primary">{{$user->name}}</span>
       <span  style="font-size:13px;
       <?php if($user->seen==0 && $user->sender!=Auth::user()->id){echo 'font-weight:bold';} else {echo 'font-weight:normal';} ?>">
         {{$user->last_message}}  </span>
     </div>
   </div>
   @endforeach
   @endif
@endsection
@section('script')
<script type="text/javascript">
  function messages(id){
        window.location="/chat/"+id;
  }
  function hideModal(id){
      document.getElementById(id).style.display='none';
  }
</script>
@endsection
