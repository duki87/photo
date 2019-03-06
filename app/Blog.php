<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
  public function images() {
    return $this->hasMany('App\BlogImages', 'blog_id');
  }

  protected $fillable = [
      'title', 'text', 'cover_image', 'author', 'url'
  ];
}
