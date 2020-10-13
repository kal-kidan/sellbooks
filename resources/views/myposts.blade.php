@extends('layouts.header')
@section('content')
 <div class="w3-modal " id="delete-modal"  >
    <div class="w3-modal-content p-3 ">
      <i class="fa fa-times text-danger " id="close-modal" style="float:right;cursor:pointer"></i>
       <p>Are sure you want to delete it?</p>
       <div class="">
           <button type="button" class="btn btn-primary" id="delete-yes">Yes</button>
           <button type="button" class="btn btn-primary" id="delete-no" >NO</button>
       </div>
    </div>
 </div>
<div class="alert alert-success text-white m-3 p-3" style="<?php if (!session()->has('message')) {
  echo "display:none";
} ?>">
  <?php echo session('message') ?? '' ?>
</div>

  @foreach($posts as $post)
  <div class="card m-3">
  <div class="row p-1">
    <div  class="col-lg-4 col-md-5">
      <h3 style="text-transform:uppercase" class="text-primary ml-3">{{$post->booktitle}}</h3>
      <img src="<?php echo $images[$loop->index][0]->path   ?>" alt="" style="width:100%" class="col col-sm-12">
    </div>


    <div class="col col-sm-12 col-lg-5 col-md-5">
      <br><br>
    Author: {{$post->bookauthor}} <br>   Category: {{$post->category}} <hr> {{$post->bookdetail}}  <br> Price : {{ $post->price}} <br> Quantity: {{ $post->quantity}}
    </div>
  </div>
  <?php $id=$post->id ?>
    <i class="fa fa-trash m-2 text-danger delete-icons" data-postid="{{$post->id}}"
      style="cursor:pointer"  onclick='deletePost("{{$post->id}}")'></i>
  </div>
  @endforeach
  <form class="" action="/deletepost" method="post" id="delete-form">
    @csrf
     <input type="hidden" name="deleted_post" value="" id="post-hidden-id">
  </form>

@endsection
@section('script')
<script type="text/javascript">
function deletePost(id){
  document.getElementById("post-hidden-id").value=id;
  document.getElementById("delete-modal").style.display="block";
}

   $(document).ready(function(){
     $("#delete-yes").click(function(){
        $("#delete-form").submit();
     });
     $("#close-modal").click(function(){
        $("#delete-modal").hide();
     });
     $("#delete-no").click(function(){
        $("#delete-modal").hide();
     });

   });

</script>
@endsection
