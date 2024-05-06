<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Presence;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
   public function in(Request $req){
      // dd(auth()->user()->username);

      $employee = Employee::where('nik', auth()->user()->username)->first();

      Presence::create([
         'employee_id' => $employee->id,
         'in_loc' => $req->loc,
         'in_date' => $req->date,
         'in_time' => $req->time
         // 'in' => Carbon::now(),

      ]);

      return redirect()->back()->with('success', 'Kamu berhasil Tap In, selamat bekerja :)');
   }

   public function out(Request $req){
      $presence = Presence::find($req->presence);
      // dd($presence->in);
      // 20*15

      $shift = Shift::find($presence->employee->contract->shift_id);
      $shiftOut = strtotime($shift->out) + 60*60;
      $overtimeStart = date('H:i', $shiftOut);
      // dd($overtimeStart);
      if ($req->time > $overtimeStart) {
         dd('lemburrrr');
      } else {
         dd('tidak');
      }
      
      $presence->update([
         'out_loc' => $req->loc,
         'out_date' => $req->date,
         'out_time' => $req->time
      ]);




      // dd($presence->out);
      $out = Carbon::make($req->time);
      $totalDuration = $out->diffInSeconds($presence->in_time);
      // dd(gmdate('H:i', $totalDuration));

      $presence->update([
         'total' => gmdate('H:i', $totalDuration)
      ]);

      return redirect()->back()->with('success', 'Kamu berhasil Tap Out, hati-hati dijalan yaa :)');
   }
}
