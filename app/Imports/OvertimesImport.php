<?php

namespace App\Imports;

use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\TransactionController;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Overtime;
use App\Models\Payroll;
use App\Models\Transaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OvertimesImport implements ToCollection,  WithHeadingRow
{
   /**
 * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */
   public function collection(Collection $rows)
   {
      foreach ($rows as $key => $row) {
         

         $overtimeController = new OvertimeController;

         if($row->filter()->isNotEmpty()){

            $employee = Employee::where('nik', $row['nik'])->first();
            $spkl_type = $employee->unit->spkl_type;
            $hour_type = $employee->unit->hour_type;
            $payroll = Payroll::find($employee->payroll_id);

            $locations = Location::get();
            $locId = null;
            foreach ($locations as $loc) {
                if ($employee->contract->loc == $loc->code) {
                $locId = $loc->id;
                }
            }

            if ($row['tipe_libur'] == 'Masuk') {
                $holidayType = 1;
            } elseif($row['tipe_libur'] == 'Libur') {
                $holidayType = 2;
            } elseif($row['tipe_libur'] == 'Libur Nasional') {
                $holidayType = 3;
            } elseif($row['tipe_libur'] == 'Idhul Fitri') {
                $holidayType = 4;
            }

            if ($row['type'] == 'Lembur') {
                $type = 1;
            } elseif($row['type'] == 'Piket'){
                $type = 2;
            }


            if ($payroll) {
                // $this->calculateRate($payroll, $req->type, $spkl_type, $hour_type, $req->hours, $req->holiday_type);
                $rate = $overtimeController->calculateRate($payroll, $type, $spkl_type, $hour_type, $row['hours'], $holidayType);
                //  dd($rate);
                $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date'])->format('Y-m-d');
                //  dd($date->format('Y'));
                $date = Carbon::create($date);
                // dd($date->format('Y'));
                $currentOvertime = Overtime::where('employee_id', $employee->id)->where('date', $date)->first();

                // if (!$currentOvertime) {
                    $overtime = Overtime::create([
                        'location_id' => $locId,
                        'employee_id' => $employee->id,
                        'month' => $date->format('F'),
                        'year' => $date->format('Y'),
                        'date' => $date->format('Y-m-d'),
                        'type' => $type,
                        'hour_type' => $hour_type,
                        'holiday_type' => $holidayType,
                        'hours' => $row['hours'],
                        'rate' => round($rate),
                        'description' => $row['note'],
                        // 'doc' => $doc
                    ]);

                    $transactionCon = new TransactionController;
                    $transactions = Transaction::where('status', '!=', 3)->where('employee_id', $employee->id)->get();

                    foreach($transactions as $tran){
                        $transactionCon->calculateTotalTransaction($tran, $tran->cut_from, $tran->cut_to);
                    }

                // }
            
            }
            
         }
      }
      
      
   }
}
