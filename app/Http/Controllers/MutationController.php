<?php

namespace App\Http\Controllers;

use App\Models\Aggreement;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Log;
use App\Models\Mutation;
use Illuminate\Http\Request;

class MutationController extends Controller
{
   public function store(Request $req)
   {
      $employee = Employee::find($req->employee);
      $contract = Contract::find($req->contract);

      $oldAggreement = Aggreement::create([
         'shift_id' => $contract->shift_id,
         'unit_id' => $contract->unit_id,
         'department_id' => $contract->department_id,
         'sub_dept_id' => $contract->sub_dept_id,
         'designation_id' => $contract->designation_id,
         'position_id' => $contract->position_id,
         'salary' => $contract->salary,
         'hourly_rate' => $contract->hourly_rate,
         'payslip' => $contract->payslip,
         'desc' => $contract->desc,
         'cuti' => $contract->cuti,
         'loc' => $contract->loc,
         'manager_id' => $employee->manager_id,
         'direct_leader_id' => $employee->direct_leader_id,
      ]);

      $newAggreement = Aggreement::create([
         'unit_id' => $req->unit_mutation,
         'department_id' => $req->department_mutation,
         'sub_dept_id' => $req->subdept_mutation,
         'designation_id' => $req->designation,
         'position_id' => $req->position_mutation,
         'salary' => $req->salary,
         'hourly_rate' => $req->hourly_rate,
         'payslip' => $req->payslip,
         'shift_id' => $req->shift,
         'desc' => $req->desc,
         'cuti' => $req->cuti,
         'loc' => $req->loc,
         'manager_id' => $req->manager_mutation,
         'direct_leader_id' => $req->leader_mutation,
      ]);

      Mutation::create([
         'date' => $req->date,
         'employee_id' => $employee->id,
         'before_id' => $oldAggreement->id,
         'become_id' => $newAggreement->id,
         'desc' => $req->reason
      ]);

      $contract->update([
         'shift_id' => $req->shift,
         'unit_id' => $req->unit_mutation,
         'department_id' => $req->department_mutation,
         'sub_dept_id' => $req->subdept_mutation,
         'designation_id' => $req->designation,
         'position_id' => $req->position_mutation,
         'salary' => $req->salary,
         'hourly_rate' => $req->hourly_rate,
         'payslip' => $req->payslip,
         
         'desc' => $req->desc,
         'cuti' => $req->cuti,
         
         'loc' => $req->loc
      ]);

      $employee->update([
         // 'unit_id' => $contract->unit_id,
         'contract_id' => $contract->id,
         'department_id' => $contract->department_id,
         'designation_id' => $contract->designation_id,
         'position_id' => $contract->position_id,
         'manager_id' => $req->manager_mutation,
         'direct_leader_id' => $req->leader_mutation,
      ]);

      $user = Employee::find(auth()->user()->getEmployeeId());
      Log::create([
         'department_id' => $user->department_id,
         'user_id' => auth()->user()->id,
         'action' => 'Add',
         'desc' => 'Mutation ' . $employee->nik . ' ' . $employee->biodata->fullname()
      ]);

      return redirect()->route('employee.detail', [enkripRambo($req->employee), enkripRambo('contract')])->with('success', 'Mutation successfully added');
   }
}
