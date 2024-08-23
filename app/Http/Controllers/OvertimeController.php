<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Overtime;
use App\Models\Payroll;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OvertimeController extends Controller
{
   public function index(){
      $overtimes = Overtime::get();
      $employees = Employee::get();
      return view('pages.payroll.overtime',[
         'overtimes' => $overtimes,
         'employees' => $employees
      ])->with('i');
   }

   public function store(Request $req){
      // dd('ok');

      $employee = Employee::find($req->employee);
      $transaction = Transaction::find($req->transaction);
      $spkl_type = $employee->unit->spkl_type;
      $payroll = Payroll::find($employee->payroll_id);

      
      if ($spkl_type == 1) {
         $rateOvertime = $payroll->pokok / 173;
      } else if($spkl_type == 2){
         $rateOvertime = $payroll->total / 173;
      }

      if ($req->hours_type == 1) {
         $rate = $req->hours * $rateOvertime;
      } else {
         $multiHours = $req->hours - 1;
         $totalHours = $multiHours * 2 + 1.5;
         $rate = $totalHours * $rateOvertime;
      }

      // dd($totalHours);
      

      $date = Carbon::create($req->date);

      $overtime = Overtime::create([
         'employee_id' => $employee->id,
         'month' => $date->format('F'),
         'year' => $date->format('Y'),
         'date' => $req->date,
         'hours_type' => $req->hours_type,
         'hours' => $req->hours,
         'rate' => round($rate)
      ]);

      // $overtimes = Overtime::where('month', $transaction->month)->get();
      // $totalOvertime = $overtimes->sum('rate');

      if ($transaction) {
         $transaction->update([
            'total' => $transaction->total +  $overtime->rate
         ]);
      }
      



      return redirect()->back()->with('success', 'Overtime Data successfully added');

   }

   public function delete($id){
      $overtime = Overtime::find(dekripRambo($id));

      $overtime->delete();

      return redirect()->back()->with('success', 'Overtime Data successfully deleted');
   }
}
