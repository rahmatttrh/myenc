<?php

namespace App\Imports;

use App\Http\Controllers\TransactionController;
use App\Models\Absence;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Payroll;
use App\Models\Transaction;
use Carbon\Carbon;
// use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AbsencesImport implements ToCollection,  WithHeadingRow
{
   public function collection(Collection $rows)
   {
      // dd('ok');
      
      foreach ($rows as $key => $row) {
         

         if($row->filter()->isNotEmpty()){
            $employee = Employee::where('nik', $row['id'])->first();
            $payroll = Payroll::find($employee->payroll_id);
            if ($payroll) {
                if ($row['type'] != null) {
                    if ($row['type'] == 'Alpha') {
                       $type = 1;
                         $value =  1 * 1 / 30 * $payroll->total;
                    } elseif($row['type'] == 'Terlambat'){
                       $type = 2;
                       $value = null;
                    } elseif($row['type'] == 'ATL') {
                       $type = 3;
                       $value = null;
                    }
     
                    $date = Carbon::create($row['tanggal']);
     
                    $locations = Location::get();
     
                    foreach ($locations as $loc) {
                       if ($loc->code == $employee->contract->loc) {
                          $location = $loc->id;
                       }
                    }
     
                    $currentAbsence = Absence::where('employee_id', $employee->id)->where('date', $date)->first();
                    if (!$currentAbsence) {
                        Absence::create([
                            'type' => $type,
                            'employee_id' => $employee->id,
                            'month' => $date->format('F'),
                            'year' => $date->format('Y'),
                            'date' => $date,
                            'desc' => $row['desc'],
                            'minute' => $row['menit'],
                            'location_id' => $location,
                            'value' => $value
                        ]);

                        $transactionCon = new TransactionController;
                        $transactions = Transaction::where('status', '!=', 3)->where('employee_id', $employee->id)->get();

                        foreach($transactions as $tran){
                            $transactionCon->calculateTotalTransaction($tran, $tran->cut_from, $tran->cut_to);
                        }
                    }
     
                    
                }
            }
            
         }
      }
   }
}
