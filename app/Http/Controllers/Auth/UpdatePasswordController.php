<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use Carbon;
use App\User;

class UpdatePasswordController extends Controller
{
    /**
     * Update the password for the user.
     *
     * @param  Request  $request
     * @return Response
     */

    public function change_password(Request $request) {
      if($request->has('old_password') || $request->has('new_password')) {
        if($request->new_password != $request->check_password) {
          return redirect()->back()->with(['error' => 'Lozinke se ne poklapaju. Pokusajte ponovo.']);
        }
        $user = User::where('email', $request->email)->first();
        $check_password = Hash::check($request->old_password, $user->password);
        if(!$check_password) {
          return redirect()->back()->with(['error' => 'Neispravan stara lozinka. Pokusajte ponovo.']);
        } else {
          $user->password = Hash::make($request->new_password);
          $user->updated_at = Carbon::now();
          $update = $user->update();
          if($update) {
            return redirect()->back()->with(['success' => 'Uspesno ste promenili lozinku.']);
          }
        }
      }
   }
}
