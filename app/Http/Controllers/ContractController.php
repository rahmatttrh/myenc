<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Employee;
use App\Models\User;
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

      // dd($req->designation);
      $employee->update([
         'manager_id' => $req->manager,
         'direct_leader_id' => $req->leader,
         'department_id' => $req->department,
         'position_id' => $req->position,
         'designation_id' => $req->designation
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
         'start' => $req->start,
         'end' => $req->end,
         'desc' => $req->desc,
         'cuti' => $req->cuti
      ]);
      // });

      $user = User::where('username', $employee->nik)->first();
      $user->roles()->detach();
      if($req->designation == 3) {
         $user->assignRole('Leader');
      } elseif($req->designation == 4) {
         $user->assignRole('Supervisor');
      } elseif($req->designation == 6) {
         $user->assignRole('Manager');
      } else {
         $user->assignRole('Karyawan');
      }

      return redirect()->route('employee.detail', [enkripRambo($req->employee), enkripRambo('contract')])->with('success', 'Contract successfully updated');
      // } catch (\Exception $e) {
      //    // Jika ada kesalahan, transaksi akan di-rollback
      //    return redirect()->back()->with('error', 'Failed to update contract. Please try again.');
      // }
   }
}
