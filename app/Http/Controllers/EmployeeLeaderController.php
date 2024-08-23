<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeLeader;
use Illuminate\Http\Request;

class EmployeeLeaderController extends Controller
{
   public function store(Request $req){
      $req->validate([]);
      $employee = Employee::find($req->employee);

      EmployeeLeader::create([
         'unit_id' => $employee->unit_id,
         'department_id' => $employee->department_id,
         'sub_dept_id' => $employee->sub_dept_id,
         'employee_id' => $req->employee,
         'leader_id' => $req->leader
      ]);

      return redirect()->route('employee.detail', [enkripRambo($employee->id), enkripRambo('contract')])->with('success', 'Employee Leader successfully updated');
      // return redirect()->back()->with('success', 'Direct Leader successfully added');
   }

   public function delete($id){
      
      $empLeader = EmployeeLeader::find(dekripRambo($id));
      $employee = Employee::find($empLeader->employee_id);
      // dd($empLeader->employee_id);

      $empLeader->delete();
      return redirect()->route('employee.detail', [enkripRambo($employee->id), enkripRambo('contract')])->with('success', 'Employee Leader successfully updated');
   }
}
