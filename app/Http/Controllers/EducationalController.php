<?php

namespace App\Http\Controllers;

use App\Models\Educational;
use App\Models\Employee;
use App\Models\Log;
use Illuminate\Http\Request;

class EducationalController extends Controller
{
   public function store(Request $req)
   {
      $req->validate([]);

      $employee = Employee::find($req->employee);

      Educational::create([
         'employee_id' => $req->employee,
         'degree' => $req->degree,
         'major' => $req->major,
         'name' => $req->name,
         'year' => $req->year
      ]);

      if (auth()->user()->hasRole('Administrator')) {
         $departmentId = null;
      } else {
         $userNow = Employee::find(auth()->user()->getEmployeeId());
         $departmentId = $userNow->department_id;
      }


      Log::create([
         'department_id' => $departmentId,
         'user_id' => auth()->user()->id,
         'action' => 'Add',
         'desc' => 'Educational ' . $employee->nik . ' ' . $employee->biodata->fullname()
      ]);

      return redirect()->route('employee.detail', [enkripRambo($req->employee), enkripRambo('personal')])->with('success', 'Educational background succesfully added');
   }

   public function update(Request $req)
   {
      $educational = Educational::find($req->edu);
      $educational->update([
         'degree' => $req->degree,
         'major' => $req->major,
         'name' => $req->name,
         'year' => $req->year
      ]);

      return redirect()->route('employee.detail', [enkripRambo($educational->employee_id), enkripRambo('personal')])->with('success', 'Educational background succesfully updated');
   }

   public function delete($id)
   {
      $dekripId = dekripRambo($id);
      $educational = Educational::find($dekripId);

      $educational->delete();
      return redirect()->route('employee.detail', [enkripRambo($educational->employee_id), enkripRambo('personal')])->with('success', 'Educational background succesfully deleted');
   }
}
