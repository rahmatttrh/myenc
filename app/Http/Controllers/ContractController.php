<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractController extends Controller
{

   public function store(Request $req)
   {
      $req->validate([]);
      $employee = Employee::find($req->employee);
      $currentContract = Contract::find($employee->contract_id);
      $currentContract->update([
         'status' => 0
      ]);
      $contract = Contract::create([
         'status' => 1,
         'employee_id' => $req->employee,
         'id_no' => $req->id,
         'type' => $req->type_add,
         'unit_id' => $req->unit,
         'department_id' => $req->department,
         'designation_id' => $req->designation,
         'salary' => $req->salary,
         'hourly_rate' => $req->hourly_rate,
         'payslip' => $req->payslip,
         'shift_id' => $req->shift,
         'start' => $req->start,
         'end' => $req->end,
         'determination' => $req->determination,
         'desc' => $req->desc,
         'cuti' => $req->cuti,
         'position_id' => $req->position,
         'loc' => $req->loc
      ]);

      $employee->update([
         // 'unit_id' => $contract->unit_id,
         'contract_id' => $contract->id,
         'department_id' => $contract->department_id,
         'designation_id' => $contract->designation_id,
         'position_id' => $contract->position_id,
         'manager_id' => $contract->manager_id,
         'direct_leader_id' => $contract->direct_leader_id,
      ]);

      return redirect()->route('employee.detail', [enkripRambo($req->employee), enkripRambo('contract')])->with('success', 'Contract successfully added');
   }
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
         // 'unit_id' => $req->unit,
         'manager_id' => $req->manager,
         'direct_leader_id' => $req->leader,
         'department_id' => $req->department,
         'position_id' => $req->position,
         'designation_id' => $req->designation
      ]);

      $contract->update([
         'id_no' => $req->id,
         'type' => $req->type,
         'date' => $req->date,
         'unit_id' => $req->unit,
         'department_id' => $req->department,
         'designation_id' => $req->designation,
         'salary' => $req->salary,
         'hourly_rate' => $req->hourly_rate,
         'payslip' => $req->payslip,
         'shift_id' => $req->shift,
         'start' => $req->start,
         'end' => $req->end,
         'determination' => $req->determination,
         'desc' => $req->desc,
         'cuti' => $req->cuti,
         'position_id' => $req->position,
         'loc' => $req->loc
      ]);
      // });

      $user = User::where('username', $employee->nik)->first();
      $user->roles()->detach();
      if ($req->designation == 3) {
         $user->assignRole('Leader');
      } elseif ($req->designation == 4) {
         $user->assignRole('Supervisor');
      } elseif ($req->designation == 6) {
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
