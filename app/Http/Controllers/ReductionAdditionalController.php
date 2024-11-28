<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Location;
use App\Models\Payroll;
use App\Models\Reduction;
use App\Models\ReductionAdditional;
use App\Models\ReductionEmployee;
use Illuminate\Http\Request;

class ReductionAdditionalController extends Controller
{
    public function store(Request $req)
   {
      // dd($req->employeeId);
      $employee = Employee::find($req->employeeId);
      $payroll = Payroll::find($employee->payroll_id);
      $red = Reduction::find($req->reduction);

      // dd($employee->biodata->fullName());

      $salary = $payroll->total;
      // $bebanPerusahaan = ($req->company * $salary) / 100;
      // $bebanKaryawan = ($req->employee * $salary) / 100;
      $locations = Location::get();

      foreach ($locations as $loc) {
         if ($loc->code == $employee->contract->loc) {
            $location = $loc->id;
         }
      }

      if ($payroll->total <= $red->min_salary) {
         // dd('kurang dari minimum gaju');
         $salary = $red->min_salary;
         $realSalary = $payroll->total;

         $bebanPerusahaan = (1 * $salary) / 100;
         $bebanKaryawan = (1 * $realSalary) / 100;
         $bebanKaryawanReal = (1 * $salary) / 100;
         $selisih = $bebanKaryawanReal - $bebanKaryawan;
         $bebanPerusahaanReal = $bebanPerusahaan + $selisih;
         $bebanKaryawanReal = (1 * $salary) / 100;
         $selisih = $bebanKaryawanReal - $bebanKaryawan;
         $bebanPerusahaanReal = $bebanPerusahaan + $selisih;
      } else {
         $salary = $payroll->total;
         $bebanPerusahaan = (1 * $salary) / 100;
         $bebanKaryawan = (1 * $salary) / 100;
         $bebanKaryawanReal = 0;
         $bebanPerusahaanReal = $bebanPerusahaan;
         $bebanKaryawanReal = 0;
         $bebanPerusahaanReal = $bebanPerusahaan;
      }

      ReductionEmployee::create([
         'reduction_id' => $red->id,
         'employee_id' => $employee->id,
         'location_id' => $location,
         'status' => 1,
         'type' => 'Additional',
         'employee_value' => $bebanKaryawan,
         'employee_value_real' => $bebanKaryawanReal,
         'company_value' => $bebanPerusahaan,
         'company_value_real' => $bebanPerusahaanReal,
         'description' => $req->desc
      ]);

      return redirect()->back()->with('success', 'BPSJ Additional successfully added');
   }
}
