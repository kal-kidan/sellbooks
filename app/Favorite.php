<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable=['user_id','book_title','book_category','book_author'];
}
