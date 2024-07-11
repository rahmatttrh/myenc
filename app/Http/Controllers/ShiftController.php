<?php

namespace App\Http\Controllers;

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
}
