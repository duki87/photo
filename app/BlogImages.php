<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogImages extends Model
{
  protected $fillable = [
      'blog_id', 'image'
  ];
}
