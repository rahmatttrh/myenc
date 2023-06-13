<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
   public function update(Request $req)
   {
      // dd('ok');
      $req->validate([]);

      $contract = Contract::find($req->contract);
      // dd($req->contract);
      $contract->update([
         'id_no' => $req->id,
         'date' => $req->date,
         'department_id' => $req->department,
         'designation_id' => $req->designation,
         'salary' => $req->salary,
         'hourly_rate' => $req->hourly_rate,
         'payslip' => $req->payslip,
         'shift_id' => $req->shift,
         'end' => $req->end,
         'desc' => $req->desc
      ]);

      return redirect()->route('employee.detail', [enkripRambo($req->employee), enkripRambo('contract')])->with('success', 'Contract successfully updated');
   }
}
