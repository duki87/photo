<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;
use Carbon;
use App\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin-area';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendPasswordResetToken(Request $request) {
      $user = User::where('email', $request->email)-first();
      if ( !$user ) return redirect()->back()->withErrors(['error' => '404']);

      //create a new token to be sent to the user.
      DB::table('password_resets')->insert([
          'email' => $request->email,
          'token' => str_random(60), //change 60 to any length you want
          'created_at' => Carbon::now()
      ]);

      $tokenData = DB::table('password_resets')
      ->where('email', $request->email)->first();

     $token = $tokenData->token;
     $email = $request->email; // or $email = $tokenData->email;

     /**
      * Send email to the email above with a link to your password reset
      * something like url('password-reset/' . $token)
      * Sending email varies according to your Laravel version. Very easy to implement
      */
  }

  public function change_password(Request $request) {
    if($request->has('old_password') || $request->has('new_password')) {
      if($request->new_password != $request->check_password) {
        return redirect()->back()->with(['error' => 'Lozinke se ne poklapaju. Pokusajte ponovo.']);
      }
      if(empty($request->email)) {
        return redirect()->back()->with(['error' => 'Niste uneli e-mail. Pokusajte ponovo.']);
      } else {
        $user = User::where('email', $request->email)->first();
        if(!$user) return redirect()->back()->with(['error' => 'Neispravan e-mail.']);
        $user->password = Hash::make($request->new_password);
        $update = $user->update();
        if($update) return redirect()->back()->with(['success' => 'Uspesno ste promenili lozinku.']);
      }
    }
 }
}
