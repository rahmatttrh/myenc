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

      $rate = $req->hours * $rateOvertime;
      // dd(formatRupiah(round($rate)));
      $date = Carbon::create($req->date);
      // dd($date->format('F'));
      // dd(formatRupiah(round($rateOvertime)));
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

      $transaction->update([
            'total' => $transaction->total +  $overtime->rate
      ]);



      return redirect()->back()->with('success', 'Overtime Data successfully added');

   }

   public function delete($id){
      $overtime = Overtime::find(dekripRambo($id));

      $overtime->delete();

      return redirect()->back()->with('success', 'Overtime Data successfully deleted');
   }
}
