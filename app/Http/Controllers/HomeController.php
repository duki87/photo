<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('admin.index')->with(['page_name' => 'index']);
    }

    public function profile() {
        $id = Auth::user()->id;
        $admin = User::where(['id' => $id])->first();
        return view('admin.profile')->with(['page_name' => 'profile', 'admin' => $admin]);
    }

}
