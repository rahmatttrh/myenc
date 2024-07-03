<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Deactivate;
use App\Models\Employee;
use App\Models\Log;
use Illuminate\Http\Request;

class DeactivateController extends Controller
{
   public function deactivate(Request $req)
   {
      $employee = Employee::find($req->employee);
      $contract = Contract::find($employee->contract_id);
      $employee->update([
         'status' => 3
      ]);
      $contract->update([
         'status' => 0
      ]);

      Deactivate::create([
         'status' => 1,
         'employee_id' => $employee->id,
         'reason' => $req->reason,
         'date' => $req->date
      ]);

      Log::create([
         'user_id' => auth()->user()->id,
         'action' => 'Deactivate',
         'desc' =>  $employee->nik . ' ' . $employee->biodata->fullname()
      ]);

      return redirect()->back()->with('success', 'Employee succesfully deactivated');
   }
}
