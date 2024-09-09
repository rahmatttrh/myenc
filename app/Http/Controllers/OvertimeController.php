<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Holiday;
use App\Models\Location;
use App\Models\Overtime;
use App\Models\Payroll;
use App\Models\Transaction;
use App\Models\TransactionReduction;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OvertimeController extends Controller
{
   public function index()
   {

      $now = Carbon::now();
      $overtimes = Overtime::where('month', $now->format('F'))->where('year', $now->format('Y'))->orderBy('date', 'desc')->get();

      // $transactionReductions = TransactionReduction::get();
      // foreach ($transactionReductions as $tr) {
      //    $transaction = Transaction::find($tr->transaction_id);
      //    $tr->update([
      //       'month' => $transaction->month,
      //       'year' => $transaction->year
      //    ]);
      // }

      $employees = Employee::get();
      // $holidays = Holiday::orderBy('date', 'asc')->get();
      return view('pages.payroll.overtime', [
         'overtimes' => $overtimes,
         'employees' => $employees,
         'month' => $now->format('F'),
         'year' => $now->format('Y')
         // 'holidays' => $holidays
      ])->with('i');
   }

   public function filter(Request $req)
   {
      $req->validate([]);

      $employees = Employee::get();

      if ($req->month == 'all') {
         if ($req->year == 'all') {
            $overtimes = Overtime::orderBy('date', 'desc')->get();
         } else {
            // dd('ok');
            $overtimes = Overtime::where('year', $req->year)->orderBy('date', 'desc')->get();
         }
      } elseif ($req->year == 'all') {
         if ($req->month == 'all') {
            $overtimes = Overtime::orderBy('date', 'desc')->get();
         } else {
            $overtimes = Overtime::where('month', $req->month)->orderBy('date', 'desc')->get();
         }
      } else {
         $overtimes = Overtime::where('month', $req->month)->where('year', $req->year)->orderBy('date', 'desc')->get();
      }





      $employees = Employee::get();
      return view('pages.payroll.overtime', [
         'overtimes' => $overtimes,
         'employees' => $employees,
         'month' => $req->month,
         'year' => $req->year
      ])->with('i');
   }


   public function store(Request $req)
   {
      // // dd('ok');
      // $req->validate([
      //    'doc' => 'required|image|mimes:jpg,jpeg,png|max:5120',
      // ]);

      $employee = Employee::find($req->employee);
      $transaction = Transaction::find($req->transaction);
      $spkl_type = $employee->unit->spkl_type;
      $hour_type = $employee->unit->hour_type;
      $payroll = Payroll::find($employee->payroll_id);

      // Cek jika karyawan tsb blm di set payroll
      if (!$payroll) {
         return redirect()->back()->with('danger', $employee->nik . ' ' . $employee->biodata->fullName() . ' belum ada data Gaji Karyawan');
      }


      $locations = Location::get();
      $locId = null;
      foreach ($locations as $loc) {
         if ($loc->code == $employee->contract->loc) {
            $locId = $loc->id;
         }
      }

      // Cek lembur atau piket
      if ($req->type == 1) {
         // jika lembur

         $rate = $this->calculateRate($spkl_type, $hour_type, $payroll, $req->hours, $req->holiday_type);
      } elseif ($req->type == 2) {
         // jika piket

         if ($req->hours > 12) {
            $leftHour = $req->hours - 12;

            // Cek jenis hari libur
            if ($req->holiday_type == 2) {
               $piketRate = 1 * 1 / 30 * $payroll->total;
            } elseif ($req->holiday_type == 3) {
               $piketRate = 2 * 1 / 30 * $payroll->total;
            } elseif ($req->holiday_type == 4) {
               $piketRate = 3 * 1 / 30 * $payroll->total;
            }
            $rate = $piketRate + $this->calculateRate($spkl_type, $hour_type, $payroll, $leftHour, $req->holiday_type);
         } else {
            $rate = $this->calculateRate($spkl_type, $hour_type, $payroll, $req->hours, $req->holiday_type);
         }
      }


      // Cek jika tgl tsb adalah hari libur atau bukan
      // if ($holiday) {
      //    // dd('ada hari libur');

      //    if ($req->hours > 12) {
      //       $leftHour = $req->hours - 12;

      //       // Cek libur, libur nasional atau hari raya
      //       if ($holiday->type == 1) {
      //          $piketRate = 1 * 1 / 30 * $payroll->total;
      //       } elseif ($holiday->type == 2) {
      //          $piketRate = 2 * 1 / 30 * $payroll->total;
      //       } else {
      //          $piketRate = 3 * 1 / 30 * $payroll->total;
      //       }
      //       $rate = $piketRate + $this->calculateRate($spkl_type, $req->hours_type, $payroll, $leftHour);;
      //    } else {
      //       $rate = $this->calculateRate($spkl_type, $req->hours_type, $payroll, $req->hours);
      //    }
      // } else {
      //    // jika bukan hari libur, perhitungan lembur/jam tergantung aktual/multiple
      //    $day = Carbon::create($req->date)->format('l');
      //    // dd($day);
      //    if ($day == 'Saturday' || $day == 'Sunday') {
      //       if ($req->hours > 12) {
      //          $leftHour = $req->hours - 12;
      //          $piketRate = 1 * 1 / 30 * $payroll->total;
      //          $rate = $piketRate + $this->calculateRate($spkl_type, $req->hours_type, $payroll, $leftHour);;
      //       } else {
      //          $rate = $this->calculateRate($spkl_type, $req->hours_type, $payroll, $req->hours);
      //       }
      //    } else {
      //       $rate = $this->calculateRate($spkl_type, $req->hours_type, $payroll, $req->hours);
      //    }
      // }




      if (request('doc')) {
         $doc = request()->file('doc')->store('doc/overtime');
      } else {
         $doc = null;
      }


      $date = Carbon::create($req->date);

      $overtime = Overtime::create([
         'location_id' => $locId,
         'employee_id' => $employee->id,
         'month' => $date->format('F'),
         'year' => $date->format('Y'),
         'date' => $req->date,
         'type' => $req->type,
         'hour_type' => $hour_type,
         'holiday_type' => $req->holiday_type,
         'hours' => $req->hours,
         'rate' => round($rate),
         'desc' => $req->desc,
         'doc' => $doc
      ]);

      // $overtimes = Overtime::where('month', $transaction->month)->get();
      // $totalOvertime = $overtimes->sum('rate');

      if ($transaction) {
         $transaction->update([
            'total' => $transaction->total +  $overtime->rate
         ]);
      }

      return redirect()->back()->with('success', 'Overtime Data successfully added');
   }

   public function calculateRate($spkl_type, $hour_type, $payroll, $hours)
   {
      if ($spkl_type == 1) {
         $rateOvertime = $payroll->pokok / 173;
      } else if ($spkl_type == 2) {
         $rateOvertime = $payroll->total / 173;
      }

      if ($hour_type == 1) {
         $rate = $hours * $rateOvertime;
      } else {
         $multiHours = $hours - 1;
         $totalHours = $multiHours * 2 + 1.5;
         $rate = $totalHours * $rateOvertime;
      }

      return $rate;
   }

   public function delete($id)
   {
      $overtime = Overtime::find(dekripRambo($id));
      Storage::delete($overtime->doc);
      $overtime->delete();

      return redirect()->back()->with('success', 'Overtime Data successfully deleted');
   }
}
