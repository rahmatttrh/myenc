<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Sp;
use App\Models\Spkl;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SpController extends Controller
{
   public function index(){
      $now = Carbon::now();

      // dd(auth()->user()->getEmployee()->id);

      if (auth()->user()->hasRole('Administrator')) {
         $employees = Employee::get();
         $sps = Sp::orderBy('created_at', 'desc')->get();
      } elseif(auth()->user()->hasRole('Manager')) {
         $employees = Employee::where('department_id', auth()->user()->getEmployee()->department_id)->where('designation_id', '<', 6)->get();

         $sps = Sp::where('department_id', auth()->user()->getEmployee()->department_id)->orderBy('created_at', 'desc')->get();
      } elseif(auth()->user()->hasRole('Supervisor')) {
         $employees = Employee::where('department_id', auth()->user()->getEmployee()->department_id)->where('designation_id', '<', 4)->get();

         $sps = Sp::where('department_id', auth()->user()->getEmployee()->department_id)->orderBy('created_at', 'desc')->get();
      }
      
      

      foreach($sps as $sp){
         if ($sp->date_to < $now) {
            // dd($sp->code);
            $sp->update([
               'status' => 0
            ]);
         }
      }

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

      $spEmployee = Sp::where('employee_id', $employee->id)->where('status', 1)->latest()->first();
      if ($spEmployee) {
         if ($spEmployee->level == 'I') {
            $level = 'II';
         } elseif($spEmployee->level == 'II'){
            $level = 'III';
         } else {
            $level = 'I';
         }
         
         
      } else {
         $level = 'I';
      }

      $from = Carbon::make($req->date_from);
      // dd($from->addMonths(6));
      
      Sp::create([
         'department_id' => $employee->department_id,
         'employee_id' => $req->employee,
         'by_id' => auth()->user()->getEmployee()->id,
         'status' => 1,
         'code' => $code,
         'level' => $req->level,
         'date_from' => $req->date_from,
         'date_to' => $from->addMonths(6),
         'desc' => $req->desc
      ]);

      return redirect()->back()->with('success', 'SP submited');
   }

   public function detail($id){
      $spkl = Spkl::get()->first();
      $sp = Sp::find(dekripRambo($id));
      return view('pages.sp.detail', [
         'spkl' => $spkl,
         'sp' => $sp
      ]);
   }

   public function delete($id){
      // dd('delete');
      $sp = Sp::find(dekripRambo($id));

      $sp->delete();

      return redirect()->route('sp')->with('success', 'SP deleted');
   }
}
