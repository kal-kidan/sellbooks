<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class DeleteController extends Controller
{

   public function delete_post(Request $request){
       $post_id=$request->input('deleted_post');
       $user_id=Post::find($post_id)->user_id;
       Post::find($post_id)->delete();
     return redirect("/myposts");
   }
}
