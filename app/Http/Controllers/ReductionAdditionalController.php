<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use App\Models\ReductionAdditional;
use Illuminate\Http\Request;

class ReductionAdditionalController extends Controller
{
    public function store(Request $req)
   {
      // dd($req->employeeId);
      $req->validate([
        'desc' => 'required'
      ]);
      $employee = Employee::find($req->employeeId);
    //   dd($employee->payroll_id);
    
      $payroll = Payroll::find($employee->payroll_id);
        if (!$payroll) {
            return redirect()->back()->with('danger', 'Failed, Data Payrol belum di set.');
        }
      // dd($employee->biodata->fullName());

      $salary = $payroll->total;
    //   $bebanPerusahaan = ($req->company * $salary) / 100;
      $bebanKaryawan = (1 * $salary) / 100;


      ReductionAdditional::create([
         'employee_id' => $employee->id,
         'description' => $req->desc,
         'employee' => 1,
        //  'company' => $req->company,
         'employee_value' => $bebanKaryawan,
        //  'company_value' => $bebanPerusahaan
      ]);

      return redirect()->back()->with('success', 'BPSJ Additional successfully added');
   }
}
