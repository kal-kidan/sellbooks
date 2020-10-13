<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Favorite;
use App\Post;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id=Auth::user()->id;
        $posts=[];
        $post_ids=[];
        $i=0;
        $favorite=Favorite::where([['user_id',$id]])->get();
        foreach ($favorite as $f) {
        $post=Post::where([['booktitle',$f->book_title]])->orWhere([['bookauthor',$f->book_author]])->get();
         if (!empty($post)) {
           foreach ($post as $p) {
             if ($p->user_id!=$id) {
               $post_ids[$i]=$p->id;
               $posts[$i]=$p;
               $i++;
             }
           }
         }
        }

         //by category
        $i=count($posts);
        foreach ($favorite as $f) {
          $post=Post::where([['category',$f->book_category]])->get();
          if (!empty($post)) {
            foreach ($post as $p) {
              if ($p->user_id!=$id && !in_array($p->id,$post_ids)) {
                $posts[$i]=$p;
                $i++;
              }

            }

          }
             }
        session()->put('recommended_posts',$posts);

          return view('home');
    }
}
