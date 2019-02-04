<?php

namespace App\Http\Controllers;

use App\Shooting;
use Illuminate\Http\Request;

class ShootingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $shootings = Shooting::paginate(5);
        return view('admin.shootings', ['shootings' => $shootings]);
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
          return response()->json(['success'=>'SHOOT_ADD']);
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
