<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shooting extends Model
{
  protected $fillable = [
      'name', 'email', 'phone', 'city', 'place', 'event', 'date', 'status'
  ];
}
