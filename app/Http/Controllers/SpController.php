<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Sp;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SpController extends Controller
{
   public function index(){
      $employees = Employee::get();
      $sps = Sp::get();
      return view('pages.sp.index', [
         'employees' => $employees,
         'sps' => $sps
      ])->with('i');
   }

   public function store(Request $req){

      $date = Carbon::now();
      $employee = Employee::find($req->employee);

      $sp = Sp::orderBy("created_at", "desc")->first();
      if (isset($sp)) {
         $code = "SP/" . $employee->department->id . '/' . $date->format('dmy') . '/' . ($sp->id + 1);
      } else {
         $code = "SP/"  . $employee->department->id . '/' . $date->format('dmy') . '/' . 1;
      }
      
      Sp::create([
         'employee_id' => $req->employee,
         'code' => $code,
         'date_from' => $req->date_from,
         'date_to' => $req->date_to,
         'desc' => $req->desc
      ]);

      return redirect()->back()->with('success', 'SP submited');
   }
}
