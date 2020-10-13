<?php
if (Auth()->guest()) {
  echo "<div class='card p-3'>";
  echo "Not Found ....";
  echo "</div>";
   exit;
}
?>
@extends('layouts.header')
@section('head')
    <link href="/css/jquery-editable-select.css" rel="stylesheet">
@endsection
@section('content')
<div class="container">
  <div class="alert alert-success m-3 p-1" style="<?php if (!session()->has('message')) {
    echo "display:none";
  } ?>">
    <?php echo session('message') ?? '' ?>
  </div>
  <h1>Update Your Personal Information</h1>
  <form class="" action="/updatename" method="post">
    @csrf
    <div class="form-group">
      <label for="inputname">Name</label>
      <input type="text" name="name" class="form-control" id="inputname" placeholder="change your name...">
       <small class="text-danger">{{$errors->first('name')}}</small>
    </div>
      <button type="submit" class="btn btn-primary">Save</button>
  </form><br>

  <form class="" action="/updatephonenumber" method="post">
    @csrf
    <div class="form-group">
      <label for="inputphone">Phone Number</label>
      <input type="text" name="phonenumber" class="form-control" id="inputphone" placeholder="change your phonenumber...">
      <small class="text-danger">{{$errors->first('phonenumber')}}</small>
    </div>
      <button type="submit" class="btn btn-primary">Save</button>
  </form><br>

    <div class="form-row">
      <form class="form-group col-md-6" action="/updateaddress" method="post">
        @csrf
        <label for="inputaddress">Address</label>
        <input type="text" name="address" placeholder="update your address..." class="form-control" id="inputaddress" >
        <small class="text-danger">{{$errors->first('address')}}</small>
        <br><button type="submit" class="btn btn-primary">Save</button>
      </form>
      <form class="form-group col-md-6" action="/updatecity" method="post">
        @csrf
        <label for="inputCity">City</label>
        <input type="text" name="city" class="form-control" placeholder="update your city..." id="inputCity" >
        <small class="text-danger">{{$errors->first('city')}}</small>
        <br><button type="submit" class="btn btn-primary">Save</button>
      </form>

    </div>
    <h1>Change Password</h1>
      <form  class="form-row" method="post" action="/changepassword">
        @csrf
        <div class="form-group col-md-6">
          <input type="password" name="password" class="form-control"  id="password"  placeholder="new password">
          <small class="text-danger">{{$errors->first('password')}}</small>
          <br><button type="submit" class="btn btn-primary">Save</button>
        </div>
        <div class="form-group col-md-6">
          <input type="password" name="confirmpassword" class="form-control"  id="confirmpassword" placeholder="confirm password">
        </div>
      </form>
      <h1>Change Profile</h1>
    <form class="form-group" action="/uploadprofile" method="post" enctype="multipart/form-data">
        @csrf
       <input type="file" name="profileimage" value="">
       <small class="text-danger">{{$errors->first('profileimage')}}</small>
       <br><br><button type="submit" class="btn btn-primary">Upload</button>
    </form>

    <!-- favorite -->
    <div class="">
      <h1>My Favorite</h1>
       <form class="form-group" action="/addfavorite" method="post">
            @csrf
         <label for="booktitle">Book Title</label> <br>
         <input type="text" name="booktitle" value="" class="form-control" placeholder="Add favorite book title"> <br>
         <small class="text-danger">{{$errors->first('booktitle')}} <br></small>
          <label for="categorys">Category</label> <br>
         <select  id="categorys" name="category" class="ui-select form-control">
           <option>Fiction</option>
           <option>Tragedy</option>
           <option>Drama</option>
           <option>Action and Adventure</option>
           <option>Romance</option>
           <option>Mystery</option>
           <option>Horror</option>
           <option>Education</option>
           <option>Self help</option>
           <option>Guide</option>
         </select><br>
         <small class="text-danger">{{$errors->first('category')}} <br></small>
         <label for="bookauthor">Book Author</label> <br>
         <input type="text" name="bookauthor" value="" class="form-control" placeholder="Book Author">
         <br>
         <small class="text-danger">{{$errors->first('bookauthor')}} <br></small>
         <button type="submit" class="btn btn-primary">Add</button>
       </form>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
$(function(){

$('#categorys').editableSelect();

});
</script>
@endsection
