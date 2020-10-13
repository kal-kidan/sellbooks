<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{
  use SoftDeletes;
  protected $date=['deleted_at'];
  protected $fillable=['user_id','booktitle','bookauthor','bookdetail','price','quantity','category'];

    public function images(){
      return $this->morphMany('App\Image','imageable');
    }
    public function user(){
    return $this->belongsTo('App\User');
    }
}
