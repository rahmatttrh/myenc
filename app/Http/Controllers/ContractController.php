<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Employee;
use App\Models\Log;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractController extends Controller
{

   public function store(Request $req)
   {
      $req->validate([
         'nik' => 'required'
      ]);
      // dd('ok');
      $employee = Employee::find($req->employee);
      $currentContract = Contract::find($employee->contract_id);
      $currentContract->update([
         'status' => 0
      ]);

      $position = Position::find($req->position_add);
      $contract = Contract::create([
         'status' => 1,
         'employee_id' => $req->employee,
         'id_no' => $req->nik,
         'type' => $req->type_add,
         'shift_id' => $req->shift,
         'designation_id' => $position->designation_id,
         'unit_id' => $req->unit_add,
         'department_id' => $req->department_add,
         'sub_dept_id' => $req->subdept_add,
         'position_id' => $req->position_add,
         'salary' => $req->salary,
         'hourly_rate' => $req->hourly_rate,
         'payslip' => $req->payslip,
         'start' => $req->start,
         'end' => $req->end,
         'determination' => $req->determination,
         'desc' => $req->desc,
         'cuti' => $req->cuti,
         'loc' => $req->loc,
         'note' => $req->note
      ]);

      $employee->update([
         // 'unit_id' => $contract->unit_id,
         'nik' => $req->nik,
         'contract_id' => $contract->id,
         'unit_id' => $contract->unit_id,
         'department_id' => $contract->department_id,
         'sub_dept_id' => $contract->sub_dept_id,
         'designation_id' => $contract->designation_id,
         'position_id' => $contract->position_id,
         // 'manager_id' => $contract->manager_id,
         // 'direct_leader_id' => $contract->direct_leader_id,
      ]);

      if (auth()->user()->hasRole('Administrator')) {
         $departmentId = null;
      } else {
         $user = Employee::find(auth()->user()->getEmployeeId());
         $departmentId = $user->department_id;
      }
      Log::create([
         'department_id' => $departmentId,
         'user_id' => auth()->user()->id,
         'action' => 'Create',
         'desc' => 'Contract ' . $employee->nik . ' ' . $employee->biodata->fullname()
      ]);

      return redirect()->route('employee.detail', [enkripRambo($req->employee), enkripRambo('contract')])->with('success', 'Contract successfully added');
   }
   public function update(Request $req)
   {
      // dd('ok');
      $req->validate([
         'nik' => 'required'
      ]);

      // dd($req->subdept);

      $position = Position::find($req->position);
      // try {
      //    DB::transaction(function () use ($req) {
      $contract = Contract::find($req->contract);
      // dd($contract->id_no);

      $employee = Employee::where('nik', $contract->id_no)->first();
      // dd($employee);
      // dd($req->position);

      // dd($req->designation);
<<<<<<< HEAD
      $employee->update([
         // 'unit_id' => $req->unit,
         'nik' => $req->nik,
         'manager_id' => $req->manager,
         // 'direct_leader_id' => $req->leader,
         'designation_id' => $position->designation_id,
         'unit_id' => $req->unit,
         'department_id' => $req->department,
         'sub_dept_id' => $req->subdept,
         'position_id' => $position->id,
         
         
      ]);
=======
      
>>>>>>> a2c2ed7ea49f6ea25618c293f9ff12734244dd0e

      $contract->update([
         'status' => 1,
         'id_no' => $req->nik,
         'employee_id' => $employee->id,
         'type' => $req->type,
         'date' => $req->date,
         'shift_id' => $req->shift,
         'designation_id' => $position->designation_id,
         'unit_id' => $req->unit,
         'department_id' => $req->department,
         'sub_dept_id' => $req->subdept,
         'position_id' => $position->id,
         'salary' => $req->salary,
         'hourly_rate' => $req->hourly_rate,
         'payslip' => $req->payslip,
         
         'start' => $req->start,
         'end' => $req->end,
         'determination' => $req->determination,
         'desc' => $req->desc,
         'cuti' => $req->cuti,
         'loc' => $req->loc,
         'note' => $req->note
      ]);

      $employee->update([
         // 'unit_id' => $req->unit,
         'nik' => $req->nik,
         'manager_id' => $req->manager,
         'direct_leader_id' => $req->leader,
         'designation_id' => $position->designation_id,

         'unit_id' => $contract->unit_id,
         'department_id' => $contract->department_id,
         'sub_dept_id' => $contract->subdept_id,
         'position_id' => $position->id,
         
         
      ]);
      // });

      // $user = User::where('username', $employee->nik)->first();
      // $user->roles()->detach();
      // if ($req->designation == 3) {
      //    $user->assignRole('Leader');
      // } elseif ($req->designation == 4) {
      //    $user->assignRole('Supervisor');
      // } elseif ($req->designation == 6) {
      //    $user->assignRole('Manager');
      // } else {
      //    $user->assignRole('Karyawan');
      // }

      if (auth()->user()->hasRole('Administrator')) {
         $departmentId = null;
      } else {
         $user = Employee::find(auth()->user()->getEmployeeId());
         $departmentId = $user->department_id;
      }
      Log::create([
         'department_id' => $departmentId,
         'user_id' => auth()->user()->id,
         'action' => 'Update',
         'desc' => 'Contract ' . $employee->nik . ' ' . $employee->biodata->fullname()
      ]);

      return redirect()->route('employee.detail', [enkripRambo($req->employee), enkripRambo('contract')])->with('success', 'Contract successfully updated');
      // } catch (\Exception $e) {
      //    // Jika ada kesalahan, transaksi akan di-rollback
      //    return redirect()->back()->with('error', 'Failed to update contract. Please try again.');
      // }
   }
}
