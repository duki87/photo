<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Shooting extends Model
{
  use Notifiable;
  protected $fillable = [
      'name', 'email', 'phone', 'city', 'place', 'event', 'date', 'status'
  ];
}
