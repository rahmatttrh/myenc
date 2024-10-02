<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
   public function index(){
      return view('auth.passwords.email');
   }

   public function update(Request $req){
      $req->validate([
         'password' => 'required|confirmed'
      ]);

      // dd('ok');
      $user = User::find(auth()->user()->id);
      // dd($user->name);
      $user->update([
         'password' => Hash::make($req->password)
      ]);

      return redirect()->to('/')->with('Password successfully updated');

   }
}
