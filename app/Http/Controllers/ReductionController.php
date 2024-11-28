<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Log;
use App\Models\Reduction;
use App\Models\Unit;
use Illuminate\Http\Request;

class ReductionController extends Controller
{
   public function store(Request $req)
   {
      // dd('ok');
      $reduction = Reduction::where('name', $req->desc)->where('unit_id', $req->unit)->first();
      if ($reduction != null) {
         return redirect()->back()->with('danger', 'Reduction Type sudah ada');
      }

      $unit = Unit::find($req->unit);

      $req->validate([
         'company' => 'required',
         'employee' => 'required'
      ]);

      Reduction::create([
         'unit_id' => $req->unit,
         'name' => $req->desc,
         'min_salary' => $req->min_salary,
         'max_salary' => $req->max_salary,
         'company' => $req->company,
         'employee' => $req->employee
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
         'action' => 'Add',
         'desc' => 'Reduction ' . $unit->name
      ]);

      return redirect()->back()->with('success', 'Reduction Unit successfully added');
   }

   public function update(Request $req)
   {
      $unitReduction = Reduction::find($req->reduction);
      $unitReduction->update([
         'min_salary' => preg_replace('/[Rp. ]/','',$req->min_salary) ,
         'max_salary' => preg_replace('/[Rp. ]/','',$req->max_salary),
         'company' => $req->company,
         'employee' => $req->employee
      ]);

      return redirect()->back()->with('success', 'Data successfully updated');
   }

   public function delete($id)
   {
      $reduction = Reduction::find(dekripRambo($id));
      // dd($reduction->name);
      $reduction->delete();
      return redirect()->back()->with('success', 'Reduction Unit successfully deleted');
   }
}
