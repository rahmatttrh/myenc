<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Log;
use App\Models\Payroll;
use App\Models\Transaction;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PayrollController extends Controller
{
   public function index()
   {
      $employees = Employee::where('status', 1)->get();
      $units = Unit::get();
      return view('pages.payroll.setup.gaji', [
         'employees' => $employees,
         'units' => $units
      ])->with('i');
   }

   public function unit()
   {
      $units = Unit::get();
      $firstUnit = Unit::get()->first();
      return view('pages.payroll.setup.unit', [
         'units' => $units,
         'firstUnit' => $firstUnit
      ])->with('i');
   }

   public function setup()
   {
      $employees = Employee::where('status', 1)->get();
      $units = Unit::get();
      $firstUnit = Unit::get()->first();
      return view('pages.payroll.setup', [
         'employees' => $employees,
         'units' => $units,
         'firstUnit' => $firstUnit
      ])->with('i');
   }

   public function detail($id)
   {
      $employee = Employee::find(dekripRambo($id));

      return view('pages.payroll.detail', [
         'employee' => $employee
      ]);
   }

   public function update(Request $req)
   {
      $employee = Employee::find($req->employee);

      $payroll = Payroll::find($employee->payroll_id);
      $total = $req->pokok + $req->tunj_jabatan + $req->tunj_ops + $req->tunj_kinerja + $req->tunj_fungsional + $req->insentif;
      $locations = Location::get();
      $locId = null;
      foreach ($locations as $loc) {
         if ($employee->contract->loc == $loc->code) {
            $locId = $loc->id;
         }
      }

      // dd($locId);

      if ($payroll) {

         if (request('doc')) {
            if ($payroll->doc) {
               Storage::delete($payroll->doc);
            }

            $doc = request()->file('doc')->store('doc/payroll');
         } elseif ($payroll->doc) {
            $doc = $payroll->doc;
         } else {
            $doc = null;
         }

         $payroll->update([
            'location_id' => $locId,
            'pokok' => $req->pokok,
            'tunj_jabatan' => $req->tunj_jabatan,
            'tunj_ops' => $req->tunj_ops,
            'tunj_kinerja' => $req->tunj_kinerja,
            'tunj_fungsional' => $req->tunj_fungsional,
            'insentif' => $req->insentif,
            'total' => $total,
            'doc' => $doc
         ]);
      } else {

         if (request('doc')) {
            
            
            $doc = request()->file('doc')->store('doc/payroll');
         } else {
            $doc = null;
         }

         $payroll = Payroll::create([
            'location_id' => $locId,
            'pokok' => $req->pokok,
            'tunj_jabatan' => $req->tunj_jabatan,
            'tunj_ops' => $req->tunj_ops,
            'tunj_kinerja' => $req->tunj_kinerja,
            'tunj_fungsional' => $req->tunj_fungsional,
            'insentif' => $req->insentif,
            'total' => $total,
            'doc' => $doc
         ]);

         $employee->update([
            'payroll_id' => $payroll->id
         ]);
      }

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
         'desc' => 'Payroll ' . $employee->nik . ' ' . $employee->biodata->fullname()
      ]);

      return redirect()->back()->with('success', 'Payroll successfully updated');
   }




   public function unitUpdatePph(Request $req)
   {
      $unit = Unit::find($req->unit);
      $unit->update([
         // 'pph' => $req->pph,
         'spkl_type' => $req->spkl_type,
         'hour_type' => $req->hour_type
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
         'action' => 'Update',
         'desc' => 'Setup Default ' . $unit->name
      ]);

      return redirect()->back()->with('success', 'Setup Unit Payroll successfully updated');
   }


   public function report()
   {
      $units = Unit::get();
      $locations = Location::get();
      $transactions = Transaction::get();
      return view('pages.payroll.report', [
         'units' => $units,
         'locations' => $locations,
         'transactions' => $transactions,
         'location' => null,
         'month' => null,
         'year' => null
      ]);
   }

   public function getReport(Request $req)
   {
      // if ($req->unit) {
      //    if ($req->location) {
      //       $transactions = Transaction::where('unit_id', $req->unit)->where('location_id', $req->location)->where('month', $req->month)->where('year', $req->year)->get();
      //    } else {
      //       $transactions = Transaction::where('unit_id', $req->unit)->where('month', $req->month)->where('year', $req->year)->get();
      //    }

      // } else {
      //    $transactions = Transaction::where('location_id', $req->location)->where('month', $req->month)->where('year', $req->year)->get();
      // }
      $transactions = Transaction::where('location_id', $req->location)->where('month', $req->month)->where('year', $req->year)->get();
      $units = Unit::get();
      $locations = Location::get();

      return view('pages.payroll.report', [
         'transactions' => $transactions,
         'locations' => $locations,
         'units' => $units,
         'location' => $req->location,
         'month' => $req->month,
         'year' => $req->year
      ]);
   }
}
