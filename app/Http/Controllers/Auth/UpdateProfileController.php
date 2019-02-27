<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;

class UpdateProfileController extends Controller
{
    public function update_profile(Request $request) {
      $email = $request->email;
      $name = $request->name;
      $user = User::where('email', $request->old_email)->first();
      $user->email = $email;
      $user->name = $name;
      $user->updated_at = Carbon::now();
      $update = $user->update();
      if($update) {
        return redirect()->back()->with(['success' => 'Uspesno ste izmenili podatke o profilu.']);
      } else {
        return redirect()->back()->with(['error' => 'Nesto se iskundacilo. Pokusajte ponovo.']);
      }
    }
}
