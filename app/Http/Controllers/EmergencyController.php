<?php

namespace App\Http\Controllers;

use App\Models\Emergency;
use Illuminate\Http\Request;

class EmergencyController extends Controller
{
   public function update(Request $req)
   {
      $emergency = Emergency::find($req->emergency);
      $emergency->update([
         'name' => $req->name,
         'phone' => $req->phone,
         'email' => $req->email,
         'address' => $req->address
      ]);

      return redirect()->back()->with('success', 'Emergency Contact successfully updated');
   }
}
