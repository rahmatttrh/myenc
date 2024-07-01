<?php

namespace App\Http\Controllers;

use App\Models\Aggreement;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Mutation;
use Illuminate\Http\Request;

class MutationController extends Controller
{
   public function store(Request $req)
   {
      $employee = Employee::find($req->employee);
      $contract = Contract::find($req->contract);

      $oldAggreement = Aggreement::create([
         'unit_id' => $contract->unit_id,
         'department_id' => $contract->department_id,
         'designation_id' => $contract->designation_id,
         'salary' => $contract->salary,
         'hourly_rate' => $contract->hourly_rate,
         'payslip' => $contract->payslip,
         'shift_id' => $contract->shift_id,
         'desc' => $contract->desc,
         'cuti' => $contract->cuti,
         'position_id' => $contract->position_id,
         'loc' => $contract->loc,
         'manager_id' => $employee->manager_id,
         'direct_leader_id' => $employee->direct_leader_id,
      ]);

      $newAggreement = Aggreement::create([
         'unit_id' => $req->unit,
         'department_id' => $req->department,
         'designation_id' => $req->designation,
         'salary' => $req->salary,
         'hourly_rate' => $req->hourly_rate,
         'payslip' => $req->payslip,
         'shift_id' => $req->shift,
         'desc' => $req->desc,
         'cuti' => $req->cuti,
         'position_id' => $req->position,
         'loc' => $req->loc,
         'manager_id' => $req->manager,
         'direct_leader_id' => $req->leader,
      ]);

      Mutation::create([
         'date' => $req->date,
         'employee_id' => $employee->id,
         'before_id' => $oldAggreement->id,
         'become_id' => $newAggreement->id,
         'desc' => $req->reason
      ]);

      $contract->update([
         'unit_id' => $req->unit,
         'department_id' => $req->department,
         'designation_id' => $req->designation,
         'salary' => $req->salary,
         'hourly_rate' => $req->hourly_rate,
         'payslip' => $req->payslip,
         'shift_id' => $req->shift,
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
         'manager_id' => $req->manager,
         'direct_leader_id' => $req->leader,
      ]);

      return redirect()->route('employee.detail', [enkripRambo($req->employee), enkripRambo('contract')])->with('success', 'Mutation successfully added');
   }
}
