<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Unit;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
   public function index(){
      $employees = Employee::where('status', 1)->get();
      return view('pages.payroll.index', [
         'employees' => $employees
      ])->with('i');
   }

   public function detail($id){
      $employee= Employee::find(dekripRambo($id));

      return view('pages.payroll.detail', [
         'employee' => $employee
      ]);
   }

   public function update(Request $req){
      $employee = Employee::find($req->employee);

      $payroll = Payroll::find($employee->payroll_id);
      $total = $req->pokok + $req->tunj_jabatan + $req->tunj_ops + $req->tunj_kinerja + $req->tunj_fungsional + $req->insentif;
      if ($payroll) {
         
         $payroll->update([
            'pokok' => $req->pokok,
            'tunj_jabatan' => $req->tunj_jabatan,
            'tunj_ops' => $req->tunj_ops,
            'tunj_kinerja' => $req->tunj_kinerja,
            'tunj_fungsional' => $req->tunj_fungsional,
            'insentif' => $req->insentif, 
            'total' => $total
         ]);
      } else {
        $payroll = Payroll::create([
            'pokok' => $req->pokok,
            'tunj_jabatan' => $req->tunj_jabatan,
            'tunj_ops' => $req->tunj_ops,
            'tunj_kinerja' => $req->tunj_kinerja,
            'tunj_fungsional' => $req->tunj_fungsional,
            'insentif' => $req->insentif,
            'total' => $total
         ]);

         $employee->update([
            'payroll_id' => $payroll->id
         ]);
      }

      return redirect()->back()->with('success', 'Payroll successfully updated');
   }


   public function unit(){
      $units = Unit::get();
      $firstUnit = Unit::get()->first();
      return view('pages.payroll.unit.index', [
         'units' => $units,
         'firstUnit' => $firstUnit
      ])->with('i');
   }
}
