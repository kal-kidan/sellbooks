<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soldbook extends Model
{
    public function users(){
      return $this->belongsTo('App\user','buyer','id');
    }
    public function books(){
      return $this->belongsTo('App\Post','book_id','id');
    }
}
