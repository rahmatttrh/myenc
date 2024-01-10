<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractController extends Controller
{
   public function update(Request $req)
   {
      // dd('ok');
      $req->validate([]);

      // try {
      //    DB::transaction(function () use ($req) {
      $contract = Contract::find($req->contract);
      $employee = Employee::where('nik', $contract->id_no)->first();
      // dd($req->position);
      $employee->update([
         'position_id' => $req->position
      ]);

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
      // });

      return redirect()->route('employee.detail', [enkripRambo($req->employee), enkripRambo('contract')])->with('success', 'Contract successfully updated');
      // } catch (\Exception $e) {
      //    // Jika ada kesalahan, transaksi akan di-rollback
      //    return redirect()->back()->with('error', 'Failed to update contract. Please try again.');
      // }
   }
}
