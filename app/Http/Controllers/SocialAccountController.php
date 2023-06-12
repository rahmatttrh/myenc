<?php

namespace App\Http\Controllers;

use App\Models\SocialAccount;
use Illuminate\Http\Request;

class SocialAccountController extends Controller
{
   public function store(Request $req)
   {
      $req->validate([
         'social' => 'required',
         'username' => 'required',
         'link' => 'required'
      ]);

      SocialAccount::create([
         'employee_id' => $req->employee,
         'social_id' => $req->social,
         'username' => $req->username,
         'link' => $req->link
      ]);

      return redirect()->back()->with('success', 'Social Account successfully added');
   }

   public function update(Request $req)
   {
      $socialAccount = SocialAccount::find($req->account);
      $socialAccount->update([
         'social_id' => $req->social,
         'username' => $req->username,
         'link' => $req->link
      ]);

      return redirect()->back()->with('success', 'Social Account successfully updated');
   }

   public function delete($id)
   {
      $dekripId = dekripRambo($id);
      $socialAccount = SocialAccount::find($dekripId);

      $socialAccount->delete();

      return redirect()->back()->with('success', 'Social Account successfully deleted');
   }
}
