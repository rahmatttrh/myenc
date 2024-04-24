<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
   public function in(Request $req){
      // dd(auth()->user()->username);

      $employee = Employee::where('nik', auth()->user()->username)->first();

      Presence::create([
         'employee_id' => $employee->id,
         'loc' => $req->loc,
         'date' => Carbon::now(),
         'in' => Carbon::now(),

      ]);

      return redirect()->back()->with('success', 'Kamu berhasil Tap In, selamat bekerja :)');
   }

   public function out(Request $req){
      $presence = Presence::find($req->presence);
      // dd($presence->in);
      
      $presence->update([
         'out' => Carbon::now()
      ]);

      $totalDuration = $presence->out->diffInSeconds($presence->in);
      // dd(gmdate('H:i', $totalDuration));

      $presence->update([
         'total' => gmdate('H:i', $totalDuration)
      ]);

      return redirect()->back()->with('success', 'Kamu berhasil Tap Out, hati-hati dijalan yaa :)');
   }
}
