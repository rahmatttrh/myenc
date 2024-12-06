<?php

namespace App\Http\Controllers;

use App\Imports\PayrollsImport;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Log;
use App\Models\Payroll;
use App\Models\Reduction;
use App\Models\ReductionAdditional;
use App\Models\ReductionEmployee;
use App\Models\Transaction;
use App\Models\Unit;
use App\Models\UnitTransaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PayrollController extends Controller
{

   public function index()
   {
      $employees = Employee::where('status', 1)->get();
      $transactionCon = new TransactionController;
      $transactions = Transaction::where('status', '!=', 3)->get();
      foreach ($transactions as $tran) {
         $transactionCon->calculateTotalTransaction($tran, $tran->cut_from, $tran->cut_to);
      }

      // $units = Unit::get();

      // foreach($employees as $emp){
      //    $payroll = Payroll::find($emp->payroll_id);
      //    if ($payroll) {
      //       $reductions = Reduction::where('unit_id', $emp->unit_id)->get();
      //       $locations = Location::get();

      //       foreach ($locations as $loc) {
      //          if ($loc->code == $emp->contract->loc) {
      //             $location = $loc->id;
      //          }
      //       }

      //       foreach ($reductions as $red) {
      //          $currentRed = ReductionEmployee::where('reduction_id', $red->id)->where('employee_id', $emp->id)->first();

      //          if ($payroll->total <= $red->min_salary) {
      //             $salary = $red->min_salary;
      //             $realSalary = $payroll->total;

      //             $bebanPerusahaan = ($red->company * $salary) / 100;
      //             $bebanKaryawan = ($red->employee * $realSalary) / 100;
      //             $bebanKaryawanReal = ($red->employee * $salary) / 100;
      //             $selisih = $bebanKaryawanReal - $bebanKaryawan;
      //             $bebanPerusahaanReal = $bebanPerusahaan + $selisih;
      //          } else {
      //             $salary = $payroll->total;
      //             $bebanPerusahaan = ($red->company * $salary) / 100;
      //             $bebanKaryawan = ($red->employee * $salary) / 100;
      //             $bebanKaryawanReal = 0;
      //             $bebanPerusahaanReal = $bebanPerusahaan;
      //          }

      //          if (!$currentRed) {
      //             ReductionEmployee::create([
      //                'reduction_id' => $red->id,
      //                'location_id' => $location,
      //                'employee_id' => $emp->id,
      //                'status' => 1,
      //                   'type' => 'Default',
      //                'employee_value' => $bebanKaryawan,
      //                'employee_value_real' => $bebanKaryawanReal,
      //                'company_value' => $bebanPerusahaan,
      //                'company_value_real' => $bebanPerusahaanReal,

      //             ]);
      //          } else {
      //             $currentRed->update([
      //                'reduction_id' => $red->id,
      //                'location_id' => $location,
      //                'employee_id' => $emp->id,
      //                'status' => 1,
      //                   'type' => 'Default',
      //                'employee_value' => $bebanKaryawan,
      //                'employee_value_real' => $bebanKaryawanReal,
      //                'company_value' => $bebanPerusahaan,
      //                'company_value_real' => $bebanPerusahaanReal,
      //             ]);
      //          }
      //       }
      //    }



      // }

      $units = Unit::get();
      $activeUnit = Unit::get()->first();
      return view('pages.payroll.setup.gaji', [
         'employees' => $employees,
         'units' => $units,
         'activeUnit' => $activeUnit
      ])->with('i');
   }

   public function indexUnit($id)
   {
      $activeUnit = Unit::find(dekripRambo($id));
      $employees = Employee::where('status', 1)->where('unit_id', $activeUnit->id)->get();
      // $units = Unit::get();

      $units = Unit::get();
      $transactionCon = new TransactionController;
      $transactions = Transaction::where('status', '!=', 3)->get();
      foreach ($transactions as $tran) {
         $transactionCon->calculateTotalTransaction($tran, $tran->cut_from, $tran->cut_to);
      }

      return view('pages.payroll.setup.gaji', [
         'employees' => $employees,
         'units' => $units,
         'activeUnit' => $activeUnit
      ])->with('i');
   }

   public function import()
   {
      $employees = Employee::where('status', 1)->get();
      $units = Unit::get();
      return view('pages.payroll.setup.import', [
         'employees' => $employees,
         'units' => $units
      ])->with('i');
   }

   public function importStore(Request $req)
   {

      $req->validate([
         'excel' => 'required'
      ]);
      $file = $req->file('excel');
      $fileName = $file->getClientOriginalName();
      $file->move('PayrollData', $fileName);

      try {
         // Excel::import(new CargoItemImport($parent->id), $req->file('file-cargo'));
         Excel::import(new PayrollsImport, public_path('/PayrollData/' . $fileName));
      } catch (Exception $e) {
         return redirect()->back()->with('danger', 'Import Failed ' . $e->getMessage());
      }


      return redirect()->route('payroll')->with('success', 'Payroll Data successfully imported');
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
      $payroll = Payroll::find($employee->payroll_id);
      // dd('ok');
      $reductions = Reduction::where('unit_id', $employee->unit_id)->get();
      // dd($reductions);

      $redAdditionals = ReductionAdditional::where('employee_id', $employee->id)->get();
      // dd($redAdditionals->sum('employee_value'));

      $locations = Location::get();

      foreach ($locations as $loc) {
         if ($loc->code == $employee->contract->loc) {
            $location = $loc->id;
         }
      }

      // foreach ($reductions as $red) {
      //    if ($payroll->total > $red->max_salary) {
      //       dd($red->name);
      //    }
      // }


      foreach ($reductions as $red) {
         $currentRed = ReductionEmployee::where('reduction_id', $red->id)->where('employee_id', $employee->id)->first();
         // dd($red->max_salary);
         if ($payroll) {
            if ($payroll->total <= $red->min_salary) {
               // dd('kurang dari minimum gaji');
               $salary = $red->min_salary;
               $realSalary = $payroll->total;

               $bebanPerusahaan = ($red->company * $salary) / 100;
               $bebanKaryawan = ($red->employee * $realSalary) / 100;
               $bebanKaryawanReal = ($red->employee * $salary) / 100;
               $selisih = $bebanKaryawanReal - $bebanKaryawan;
               $bebanPerusahaanReal = $bebanPerusahaan + $selisih;
               // $bebanKaryawanReal = ($red->reduction->employee * $salary) / 100;
               // $selisih = $bebanKaryawanReal - $bebanKaryawan;
               // $bebanPerusahaanReal = $bebanPerusahaan + $selisih;

            } else if ($payroll->total >= $red->min_salary) {
               if ($payroll->total > $red->max_salary) {
                  // dd('ok');
                  if ($red->max_salary != 0) {
                     $salary = $payroll->total;
                     $bebanPerusahaan = ($red->company * $red->max_salary) / 100;
                     $bebanKaryawan = ($red->employee * $red->max_salary) / 100;
                     $bebanKaryawanReal = 0;
                     $bebanPerusahaanReal = $bebanPerusahaan;
                  } else {
                     $salary = $payroll->total;
                     $bebanPerusahaan = ($red->company * $salary) / 100;
                     $bebanKaryawan = ($red->employee * $salary) / 100;
                     $bebanKaryawanReal = 0;
                     $bebanPerusahaanReal = $bebanPerusahaan;
                  }
               } else {
                  $salary = $payroll->total;
                  $bebanPerusahaan = ($red->company * $salary) / 100;
                  $bebanKaryawan = ($red->employee * $salary) / 100;
                  $bebanKaryawanReal = 0;
                  $bebanPerusahaanReal = $bebanPerusahaan;
               }
            }



            if (!$currentRed) {
               ReductionEmployee::create([
                  'reduction_id' => $red->id,
                  'type' => 'Default',
                  'location_id' => $location,
                  'employee_id' => $employee->id,
                  'status' => 1,
                  'employee_value' => $bebanKaryawan,
                  'employee_value_real' => $bebanKaryawanReal,
                  'company_value' => $bebanPerusahaan,
                  'company_value_real' => $bebanPerusahaanReal,

               ]);
            } else {
               $currentRed->update([
                  'reduction_id' => $red->id,
                  'type' => 'Default',
                  'location_id' => $location,
                  'employee_id' => $employee->id,
                  'status' => 1,
                  'employee_value' => $bebanKaryawan,
                  'employee_value_real' => $bebanKaryawanReal,
                  'company_value' => $bebanPerusahaan,
                  'company_value_real' => $bebanPerusahaanReal,
               ]);
            }
         }
      }

      $redEmployees = ReductionEmployee::where('employee_id', $employee->id)->get();

      // dd($redEmployees);

      return view('pages.payroll.detail', [
         'employee' => $employee,
         'reductions' => $reductions,
         'redEmployees' => $redEmployees,
         'redAdditionals' => $redAdditionals
      ]);
   }


   public function update(Request $req)
   {
      $employee = Employee::find($req->employee);
      // dd('ok');
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
            'location_id' => $locId,
            'pokok' => $req->pokok,
            'tunj_jabatan' => $req->tunj_jabatan,
            'tunj_ops' => $req->tunj_ops,
            'tunj_kinerja' => $req->tunj_kinerja,
            'tunj_fungsional' => $req->tunj_fungsional,
            'insentif' => $req->insentif,
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

      $transactionCon = new TransactionController;
      $transactions = Transaction::where('status', '!=', 3)->where('employee_id', $employee->id)->get();

      foreach ($transactions as $tran) {
         $transactionCon->calculateTotalTransaction($tran, $tran->cut_from, $tran->cut_to);
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



   public function payslipUpdate(Request $req)
   {
      $employee = Employee::find($req->employeeId);
      $payroll = Payroll::find($employee->payroll_id);



      $payroll->update([
         'payslip_status' => $req->status
      ]);
      // dd($employee->nik);  
      return redirect()->back()->with('success', "Payslip Status updated");
   }

   public function payslipShow(Request $req)
   {
      $transaction = Transaction::find($req->transactionId);

      $transaction->update([
         'payslip_status' => 'show'
      ]);
      // dd($employee->nik);  
      return redirect()->back()->with('success', "Payslip Status updated");
   }

   public function payslipHide(Request $req)
   {
      $transaction = Transaction::find($req->transactionId);

      $transaction->update([
         'payslip_status' => 'hide'
      ]);
      // dd($employee->nik);  
      return redirect()->back()->with('success', "Payslip Status updated");
   }

   public function exportPdf($id)
   {
      $transaction = Transaction::find(dekripRambo($id));

      return view('pages.payroll.transaction.pdf', [
         'transaction' => $transaction
      ]);
   }
}
