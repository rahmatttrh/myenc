<?php

namespace App\Http\Controllers;

use App\Models\Deactivate;
use App\Models\Employee;
use Illuminate\Http\Request;

class DeactivateController extends Controller
{
   public function deactivate(Request $req)
   {
      $employee = Employee::find($req->employee);

      $employee->update([
         'status' => 3
      ]);

      Deactivate::create([
         'status' => 1,
         'employee_id' => $employee->id,
         'reason' => $req->reason,
         'date' => $req->date
      ]);

      return redirect()->back()->with('success', 'Employee succesfully deactivated');
   }
}
