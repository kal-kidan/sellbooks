<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Image;
use App\Favorite;
use Auth;
class UpdateController extends Controller
{
    public function __construct()
       {

     }
    public function update_name(Request $request){
       $this->validate($request, [
       'name'=>'required|regex:/^[a-zA-Z\s]*$/|max:255'
       ]);
       $id=Auth::user()->id;
       $user=User::find($id);
       $user->name=$request->input('name');
       $user->save();
       return redirect('/account')->with('message','you updated your name');
    }
    public function update_phone_number(Request $request){
      $this->validate($request, [
        'phonenumber'=>'required|regex:/^(\+2519)[0-9]{8}$/|max:255'
      ]);
      $id=Auth::user()->id;
      $user=User::find($id);
      $user->phonenumber=$request->input('phonenumber');
      $user->save();
      return redirect('/account')->with('message','you updated your phone number');
    }
    public function update_address(Request $request){
      $this->validate($request, [
      'address'=>'required|string|max:255'
      ]);
      $id=Auth::user()->id;
      $user=User::find($id);
      $user->address=$request->input('address');
      $user->save();
      return redirect('/account')->with('message','you updated your address');
    }
    public function update_city(Request $request){
      $this->validate($request, [
        'city'=>'required|string|max:255'
      ]);
      $id=Auth::user()->id;
      $user=User::find($id);
      $user->city=$request->input('city');
      $user->save();
      return redirect('/account')->with('message','you updated your city');
    }
    public function change_password(Request $request){
      $this->validate($request, [
       'password'=>'required|string|min:8|same:confirmpassword'
      ]);
      $id=Auth::user()->id;
      $user=User::find($id);
      $user->password=Hash::make($request->input('password'));
      $user->save();
      return redirect('/account')->with('message','you changed your password');
    }
    public function upload_profile(Request $request){
      $this->validate($request, [
       'profileimage'=>'required|image|max:2024'
      ]);
      $id=Auth::user()->id;
      $file=$request->file('profileimage');
      $imagename=time().$file->getClientOriginalName();
      $path="/uploads/".$imagename;
      $user=User::find($id);
      $image=Image::where('imageable_id',$id)->where('imageable_type','App\User')->first();
      // echo $image;
      // exit;
      if (!$image) {
        $user->images()->create(['path'=>$path]);
          $file->move('uploads',$imagename);
          return redirect('/account')->with('message','you updated your profile');
      }
      else {
       $deletedOne=Image::where('imageable_id',$id)->get()[0]->path;
        if (file_exists($deletedOne)) {
           unlink($deletedOne);
         }
       $updatedImage=Image::where('imageable_id',$id)->where('imageable_type','App\User')->update(['path'=>$path]);
        $file->move('uploads',$imagename);
        return redirect('/account')->with('message','you updated your profile');
      }

    }
    public function add_favorite(Request $request){
            $this->validate($request, [
              'booktitle'=>'required|string|max:100',
              'category'=>'required|string|max:100',
              'bookauthor'=>'required|string|max:100'
          ]);
          $id=Auth::user()->id;
          $booktitle=$request->input('booktitle');
          $category=$request->input('category');
          $bookauthor=$request->input('bookauthor');
          Favorite::create(['user_id'=>$id,'book_title'=>$booktitle,'book_category'=>$category,'book_author'=>$bookauthor]);
          return redirect('/account')->with('message','you added one book to you favorite');
    }
}
