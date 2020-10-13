@extends('layouts.header')
@section('head')
    <link rel="stylesheet" href="/css/register-style.css">
    <link href="/css/jquery-editable-select.css" rel="stylesheet">
@endsection
@section('content')
<div class="form-wrapper">
  <h1 class="text-primary text-center">Post Book For Sell</h1>
  <form action="/postbook" method="post" enctype="multipart/form-data">
    @csrf
    <label for="booktitle"> Book Title</label>
    <input type="text" id="booktitle" class="post-input" name="booktitle" placeholder="Book Title..">
        <small class="errors">{{$errors->first('booktitle')}}</small>

    <br><label for="bookauthor"> Book Author</label>
    <input type="text" id="bookauthor" class="post-input" name="bookauthor" placeholder="Book Author..">
            <small class="errors">{{$errors->first('bookauthor')}}</small>

      <br>  <label for="bookdetail">Book Detail</label>
    <textarea  id="bookdetail" name="bookdetail" placeholder="Book Detail.."></textarea>
        <small class="errors">{{$errors->first('bookdetail')}}</small>

        <br><label for="address">Price</label>
    <input type="text" id="price" name="price" class="post-input" placeholder="price ..">
       <small class="errors">{{$errors->first('price')}}</small>

    <br> <label for="quantity">Quantity</label>
    <input type="text" id="quantity" name="quantity" class="post-input" placeholder="quantity ..">
      <small class="errors">{{$errors->first('quantity')}}</small>

      <br> <label for="categorys">Category</label>
      <select  id="categorys" class="ui-select" name="category">
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
      </select>

      <br> <label for="bookimage">Book Image</label><br>
      <input type="file" id="bookimage" class="post-input" name="bookimage" placeholder="book image .."> <br>
        <small class="errors">{{$errors->first('bookimage')}}</small>
    <input type="submit" value="Submit" class="btn btn-primary">
  </form>
</div>

@endsection
@section('script')
<script type="text/javascript">

$(function(){

$('#categorys').editableSelect();

});


</script>
@endsection
