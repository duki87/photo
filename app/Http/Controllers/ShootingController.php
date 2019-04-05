<?php

namespace App\Http\Controllers;

use App\Shooting;
use Notification;
use Illuminate\Http\Request;
use App\Notifications\ShootingNotification;

class ShootingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $shootings = Shooting::orderBy('id', 'desc')->paginate(5);
        return view('admin.shootings', ['shootings' => $shootings, 'page_name' => 'shootings']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $shooting = new Shooting;
        $shooting->name = $request->name;
        $shooting->email = $request->email;
        $shooting->phone = $request->phone;
        $shooting->city = $request->city;
        $shooting->place = $request->place;
        $shooting->event = $request->event;
        $shooting->date = $request->date;

        if($shooting->save()) {
          Notification::route('mail', 'dusanmarinkovic@hotmail.com')->notify(new ShootingNotification($request->name, $request->email, $request->phone, $request->city, $request->place, $request->event, $request->date));
          return response()->json(['success'=>'SHOOT_ADD']);
        }
    }

    public static function number_of_requests() {
      $shootings = Shooting::where(['status' => 1])->count();
      if($shootings > 0) {
        echo '<span class="badge badge-danger">'.$shootings.'</span>';
      } else {
        echo '';
      }
    }


    public function change_status($id) {
      $shooting = Shooting::where(['id' => $id])->first();
      if($shooting['status'] == 1) {
        Shooting::where(['id' => $id])->update(['status' => 0]);
        return redirect()->back()->with(['shooting_message' => 'Oznaceno kao procitano']);
      } else {
        Shooting::where(['id' => $id])->update(['status' => 1]);
        return redirect()->back()->with(['shooting_message' => 'Oznaceno kao neprocitano']);
      }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shooting  $shooting
     * @return \Illuminate\Http\Response
     */
    public function show(Shooting $shooting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shooting  $shooting
     * @return \Illuminate\Http\Response
     */
    public function edit(Shooting $shooting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shooting  $shooting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shooting $shooting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shooting  $shooting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shooting $shooting)
    {
        //
    }
}
