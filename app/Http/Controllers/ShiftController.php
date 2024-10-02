<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
   public function index(){
      $shifts = Shift::get();
      // $locations = 
      return view('pages.shift.index', [
         'shifts' => $shifts
      ])->with('i');
   }

   public function store(Request $req){
      $req->validate([

      ]);

      Shift::create([
         'name' => $req->name,
         'in' => $req->in,
         'out' => $req->out
      ]);

      return redirect()->back()->with('success', 'Shift/Work Hours successfully added');
   }

   public function update(Request $req){
      $shift = Shift::find($req->shift);
      $shift->update([
         'name' => $req->name,
         'in' => $req->in,
         'out' => $req->out
      ]);

      return redirect()->back()->with('success', 'Shift/Work Hours successfully updated');
   }

   public function delete($id){
      $shift = Shift::find(dekripRambo($id));
      $contracts = Contract::where('shift_id', $shift->id)->get();

      if (count($contracts) > 0) {
         return redirect()->back()->with('danger', 'Shift/Work Hours delete fail, data memiliki relasi ke data lain');
      } else {
         $shift->delete();
         return redirect()->back()->with('success', 'Shift/Work Hours successfully deleted');
      }

   }
}
