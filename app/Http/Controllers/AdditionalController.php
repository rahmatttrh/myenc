<?php

namespace App\Http\Controllers;

use App\Models\Additional;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdditionalController extends Controller
{
   public function index()
   {
      $additionals = Additional::get();
      $employees = Employee::get();
      return view('pages.payroll.additional', [
         'additionals' => $additionals,
         'employees' => $employees
      ])->with('i');
   }

   public function store(Request $req)
   {
      $req->validate([]);

      $date = Carbon::create($req->date);
      $month = $date->format('F');
      $year = $date->format('Y');
      $employee = Employee::find($req->employee);

      if (request('doc')) {
         $doc = request()->file('doc')->store('doc/overtime');
      } else {
         $doc = null;
      }

      $locations = Location::get();

      foreach ($locations as $loc) {
         if ($loc->code == $employee->contract->loc) {
            $location = $loc->id;
         }
      }



      Additional::create([
         'employee_id' => $req->employee,
         'type' => $req->type,
         'month' => $month,
         'year' => $year,
         'date' => $req->date,
         'value' => $req->value,
         'desc' => $req->desc,
         'doc' => $doc,
         'location_id' => $location
      ]);

      $transaction = Transaction::where('employee_id', $employee->id)->where('month', $month)->where('year', $year)->first();
      $from = $transaction->cut_from;
      $to = $transaction->cut_to;
      if ($transaction) {
         $trans = new TransactionController;
         $trans->calculateTotalTransaction($transaction, $from, $to);
      }

      return redirect()->back()->with('success', 'Payroll Additional successfully added');
   }

   public function delete($id)
   {
      $additional = Additional::find(dekripRambo($id));
      $transaction = Transaction::where('employee_id', $additional->employee_id)->where('month', $additional->month)->where('year', $additional->year)->first();
      $from = $transaction->cut_from;
      $to = $transaction->cut_to;
      if ($transaction) {
         $trans = new TransactionController;
         $trans->calculateTotalTransaction($transaction, $from, $to);
      }

      $additional->delete();
      return redirect()->back()->with('success', 'Additional Data successfully deleted');
   }
}
