<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
   
    public function search(Request $request){
      $searched_text=htmlspecialchars(trim($request->input("searchText")));
      $this->validate($request,[
        "searchText"=>"required|string"
      ]);

      $searchResults=[];
      $book_titles=Post::where('booktitle','like','%'.$searched_text.'%')->get();
      $book_authors=Post::where('bookauthor','like','%'.$searched_text.'%')->get();
      $categorys=Post::where('category','like','%'.$searched_text.'%')->get();
      $descriptions=Post::where('bookdetail','like','%'.$searched_text.'%')->get();
      $i=count($searchResults);
      foreach ($book_titles as  $value) {
        if (!in_array($value->id, $searchResults)) {
          $searchResults[$i] = $value->id ;
        }
        $i++;
      }

      $i=count($searchResults);
      foreach ($book_authors as  $value) {
        if (!in_array($value->id, $searchResults)) {
          $searchResults[$i] = $value->id ;
        }
        $i++;
      }

      $i=count($searchResults);
      foreach ($categorys as  $value) {
        if (!in_array($value->id, $searchResults)) {
          $searchResults[$i] = $value->id ;
        }
        $i++;
      }

      $i=count($searchResults);
      foreach ($descriptions as  $value) {
        if (!in_array($value->id, $searchResults)) {
          $searchResults[$i] = $value->id ;
        }
        $i++;
      }
      session()->put('searchResults',$searchResults);
      return redirect('/searchresult');

    }
}
