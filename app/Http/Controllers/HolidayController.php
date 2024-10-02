<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
   public function index(){
      $holidays = Holiday::orderBy('date', 'desc')->get();
      return view('pages.payroll.holiday', [
         'holidays' => $holidays
      ]);
   }

   public function store(Request $req){
      Holiday::create([
         'date' => $req->date,
         'type' => $req->type,
         'desc' => $req->desc
      ]);

      return redirect()->back()->with('success', 'Libur Nasional successfully added');
   }

   public function delete($id){
      $holiday = Holiday::find(dekripRambo($id));
      $holiday->delete();

      return redirect()->back()->with('success', 'Libur Nasional successfully deleted');
   }

}
