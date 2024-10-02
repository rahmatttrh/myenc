<?php

namespace App\Http\Controllers;

use App\Models\Emergency;
use Illuminate\Http\Request;

class EmergencyController extends Controller
{
   public function store(Request $req)
   {
      // dd('ok');
      Emergency::create([
         'employee_id' => $req->employee,
         'name' => $req->name,
         'phone' => $req->phone,
         'email' => $req->email,
         'hubungan' => $req->hubungan,
         'address' => $req->address
      ]);
      return redirect()->back()->with('success', 'Data updated');
   }

   public function update(Request $req)
   {
      $emergency = Emergency::find($req->emergency);
      $emergency->update([
         'name' => $req->name,
         'phone' => $req->phone,
         'email' => $req->email,
         'hubungan' => $req->hubungan,
         'address' => $req->address
      ]);

      return redirect()->back()->with('success', 'Emergency Contact successfully updated');
   }

   public function delete($id)
   {
      $dekripId = dekripRambo($id);
      $emergency = Emergency::find($dekripId);
      $emergency->delete();
      return redirect()->back()->with('success', 'Emergency Contact successfully deleted');
   }
}
