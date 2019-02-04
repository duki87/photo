<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
  public function index() {
      return view('index')->with(['page_name' => 'index']);
  }

  public function gallery() {
      return view('gallery')->with(['page_name' => 'gallery']);
  }
}
