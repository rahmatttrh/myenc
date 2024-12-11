<?php

namespace App\Imports;

use App\Http\Controllers\TransactionController;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Payroll;
use App\Models\Reduction;
use App\Models\ReductionEmployee;
use App\Models\Transaction;
// use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PayrollsImport implements ToCollection,  WithHeadingRow
{
   /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   public function collection(Collection $rows)
   {
      // dd('ok');

      foreach ($rows as $key => $row) {


         if ($row->filter()->isNotEmpty()) {
            $employee = Employee::where('nik', $row['nik'])->first();

            if ($employee) {
               $locations = Location::get();
               $locId = null;
               foreach ($locations as $loc) {
                  if ($employee->contract->loc == $loc->code) {
                     $locId = $loc->id;
                  }
               }
               $currentPayroll = Payroll::find($employee->payroll_id);
               $total = $row['gaji_pokok'] + $row['tunjangan_jabatan'] + $row['tunjangan_operasional'] + $row['tunjangan_kinerja'] + $row['tunjangan_fungsional'] + $row['insentif'];

               if ($currentPayroll) {
                  $currentPayroll->update([
                     'location_id' => $locId,
                     'pokok' => $row['gaji_pokok'],
                     'tunj_jabatan' => $row['tunjangan_jabatan'],
                     'tunj_ops' => $row['tunjangan_operasional'],
                     'tunj_kinerja' => $row['tunjangan_kinerja'],
                     'tunj_fungsional' => $row['tunjangan_fungsional'],
                     'insentif' => $row['insentif'],
                     'total' => $total,
                     // 'doc' => $doc
                  ]);
               } else {
                  $payroll = Payroll::create([
                     'location_id' => $locId,
                     'pokok' => $row['gaji_pokok'],
                     'tunj_jabatan' => $row['tunjangan_jabatan'],
                     'tunj_ops' => $row['tunjangan_operasional'],
                     'tunj_kinerja' => $row['tunjangan_kinerja'],
                     'tunj_fungsional' => $row['tunjangan_fungsional'],
                     'insentif' => $row['insentif'],
                     'total' => $total,
                     // 'doc' => $doc
                  ]);

                  $employee->update([
                     'payroll_id' => $payroll->id
                  ]);
               }

               $reductions = Reduction::where('unit_id', $employee->unit_id)->get();
               $locations = Location::get();

               foreach ($locations as $loc) {
                  if ($loc->code == $employee->contract->loc) {
                     $location = $loc->id;
                  }
               }

               foreach ($reductions as $red) {
                  $currentRed = ReductionEmployee::where('reduction_id', $red->id)->where('employee_id', $employee->id)->first();

                  if ($payroll->total <= $red->min_salary) {
                     $salary = $red->min_salary;
                     $realSalary = $payroll->total;

                     $bebanPerusahaan = ($red->company * $salary) / 100;
                     $bebanKaryawan = ($red->employee * $realSalary) / 100;
                     $bebanKaryawanReal = ($red->employee * $salary) / 100;
                     $selisih = $bebanKaryawanReal - $bebanKaryawan;
                     $bebanPerusahaanReal = $bebanPerusahaan + $selisih;
                  } else {
                     $salary = $payroll->total;
                     $bebanPerusahaan = ($red->company * $salary) / 100;
                     $bebanKaryawan = ($red->employee * $salary) / 100;
                     $bebanKaryawanReal = 0;
                     $bebanPerusahaanReal = $bebanPerusahaan;
                  }

                  if (!$currentRed) {
                     ReductionEmployee::create([
                        'reduction_id' => $red->id,
                        'location_id' => $location,
                        'employee_id' => $employee->id,
                        'status' => 1,
                        'type' => 'Default',
                        'employee_value' => $bebanKaryawan,
                        'employee_value_real' => $bebanKaryawanReal,
                        'company_value' => $bebanPerusahaan,
                        'company_value_real' => $bebanPerusahaanReal,

                     ]);
                  } else {
                     $currentRed->update([
                        'reduction_id' => $red->id,
                        'location_id' => $location,
                        'employee_id' => $employee->id,
                        'status' => 1,
                        'type' => 'Default',
                        'employee_value' => $bebanKaryawan,
                        'employee_value_real' => $bebanKaryawanReal,
                        'company_value' => $bebanPerusahaan,
                        'company_value_real' => $bebanPerusahaanReal,
                     ]);
                  }
               }

               $transactionCon = new TransactionController;
               $transactions = Transaction::where('status', '!=', 3)->where('employee_id', $employee->id)->get();

               foreach ($transactions as $tran) {
                  $transactionCon->calculateTotalTransaction($tran, $tran->cut_from, $tran->cut_to);
               }
            }
         }
      }
   }
}
