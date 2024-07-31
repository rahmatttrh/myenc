<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
   /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

   use AuthenticatesUsers;

   /**
    * Where to redirect users after login.
    *
    * @var string
    */
   protected $redirectTo = RouteServiceProvider::HOME;

   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
      $this->middleware('guest')->except('logout');
   }

   protected function authenticated($user)
   {
      if (auth()->user()->hasRole('Administrator')) {
         
      } else {
         Log::create([
            // 'department_id' => $departmentId,
            'user_id' => auth()->user()->id,
            'action' => 'Login',
            'desc' => formatDateTimeB(NOW())
         ]);
      }
      
   }

   protected function logout()
   {
      // if (auth()->user()->hasRole('Administrator')) {
         
      // } else {
      //    Log::create([
      //       // 'department_id' => $departmentId,
      //       'user_id' => auth()->user()->id,
      //       'action' => 'Logout',
      //       'desc' => formatDateTimeB(NOW())
      //    ]);
         
      // }

      $this->guard()->logout();
         return redirect('/');
      
   }

   public function username()
   {
      $login = request()->input('username');
      $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
      request()->merge([$field => $login]);
      return $field;
   }
}
