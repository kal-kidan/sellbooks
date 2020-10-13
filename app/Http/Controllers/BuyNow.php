<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Soldbook;
class BuyNow extends Controller
{
 
  public function buynow(Request $request){
     $soldbook=new Soldbook;
     $bookid=$request->input('bookid');
     $owner=$request->input('owner');
     $buyer=$request->input('buyer');
     $soldbook->book_id=$bookid;
     $soldbook->owner=$owner;
     $soldbook->buyer=$buyer;
     $soldbook->save();
     return redirect('/successmessage');
  }
}
 ?>
