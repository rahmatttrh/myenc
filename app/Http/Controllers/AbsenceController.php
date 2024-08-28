<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Employee;
use App\Models\Payroll;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
   public function index()
   {
      $employees = Employee::get();
      return view('pages.payroll.absence', [
         'employees' => $employees
      ])->with('i');
   }

   public function store(Request $req)
   {
      $employee = Employee::find($req->employee);
      $payroll = Payroll::find($employee->payroll_id);
      // Cek jika karyawan tsb blm di set payroll
      if (!$payroll) {
         return redirect()->back()->with('danger', $employee->nik . ' ' . $employee->biodata->fullName() . ' belum ada data Gaji Karyawan');
      }

      if ($) {
         # code...
      }

      
      
      
      
      
      
      
      
      $date = Carbon::create($req->date);
      if (request('doc')) {
         $doc = request()->file('doc')->store('doc/overtime');
      } else {
         $doc = null;
      }

      Absence::create([
         'type' => $req->type,
         'employee_id' => $req->employee,
         'month' => $date->format('F'),
         'year' => $date->format('Y'),
         'date' => $req->date,
         'desc' => $req->desc,
         'doc' => $doc
      ]);

      return redirect()->back()->with('success', 'Data Absence successfully added');
   }
}
