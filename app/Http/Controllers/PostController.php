<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Image;
use App\User;
use Auth;
class PostController extends Controller
{

    public function __construct()
      {
      $this->middleware('check_login');
      }
    function post(Request $request){
      $id=Auth::user()->id;
      $this->validate($request, [
        'booktitle'=>'required|string|max:100',
        'bookauthor'=>'required|string|max:100',
        'bookdetail'=>'required|string|max:255',
        'price'=>'required|numeric|max:1000000',
        'quantity'=>'required|numeric|max:100',
        'category'=>'required|string|max:100',
        'bookimage'=>'required|image|max:2048'
      ]);
      $post=new Post;
      $booktitle=$request->input('booktitle');
      $bookauthor=$request->input('bookauthor');
      $bookdetail=$request->input('bookdetail');
      $price=$request->input('price');
      $quantity=$request->input('quantity');
      $category=$request->input('category');
      $bookimage=$request->file('bookimage');
      $post->user_id=$id;
      $post->booktitle=$booktitle;
      $post->bookauthor=$bookauthor;
      $post->bookdetail=$bookdetail;
      $post->price=$price;
      $post->quantity=$quantity;
      $post->category=$category;
      $post->save();
       $uploadedImage=time().$bookimage->getClientOriginalName() ;
       $bookimage->move('uploads', $uploadedImage);
       $path="uploads/".$uploadedImage;
       $postId=$post->id;
       $thePost = Post::find($postId);
       $thePost->images()->create(['path'=>$path]);
       return redirect('myposts')->with('message','you successfully posted!');
    }
    function mypost(){
      $id=Auth::user()->id;
      $images=[];
      $i=0;
      $id=Auth::user()->id;
      $posts=Post::where('user_id',$id)->orderBy('updated_at','desc')->get();
      foreach ($posts as $post) {
        $p=Post::find($post->id);
        $images[$i]=$p->images;
        $i++;
      } 
      return view("myposts")->with(['posts'=>$posts,'images'=>$images]);
    }

}
