<?php

namespace App\Http\Controllers;

use App\Imports\OvertimesImport;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\Location;
use App\Models\Overtime;
use App\Models\Payroll;
use App\Models\Transaction;
use App\Models\TransactionReduction;
use App\Models\Unit;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class OvertimeController extends Controller
{
   public function index()
   {

      $now = Carbon::now();
      $overtimes = Overtime::get();


      if (auth()->user()->hasRole('HRD-KJ12')) {
         $employees = Employee::join('contracts', 'employees.contract_id', '=', 'contracts.id')
            ->where('contracts.loc', 'kj1-2')
            ->select('employees.*')
            ->get();

         $overtimes = Overtime::where('location_id', 3)->get();
      } elseif (auth()->user()->hasRole('HRD-KJ45')) {

         // dd('ok');
         $employees = Employee::join('contracts', 'employees.contract_id', '=', 'contracts.id')
            ->where('contracts.loc', 'kj4')->orWhere('contracts.loc', 'kj5')
            ->select('employees.*')
            ->get();
         $overtimes = Overtime::where('location_id', 4)->orWhere('location_id', 5)->get();
         // dd($overtimes);
      } else {
         // dd('ok');
         $employees = Employee::get();
      }

      // $debugOver = Overtime::find(713);
      // $employee = Employee::find($debugOver->employee_id);
      // $payroll = Payroll::find($employee->payroll_id);
      // $spkl_type = $employee->unit->spkl_type;
      // $newRate = $this->calculateRate($payroll, $debugOver->type, $spkl_type, $debugOver->hour_type, $debugOver->hours, $debugOver->holiday_type);
      // dd($newRate);

      // foreach($overtimes as $over){
      //    $employee = Employee::find($over->employee_id);
      //    $payroll = Payroll::find($employee->payroll_id);
      //    $spkl_type = $employee->unit->spkl_type;
      //    $newRate = $this->calculateRate($payroll, $over->type, $spkl_type, $over->hour_type, $over->hours, $over->holiday_type);

      //    $over->update([
      //       'rate' => $newRate
      //    ]);
      // }
      // $testOver = Overtime::find(1);

      // dd('ok');

      foreach ($overtimes as $over) {
         $employee = Employee::find($over->employee_id);
         $spkl_type = $employee->unit->spkl_type;
         $hour_type = $employee->unit->hour_type;
         $payroll = Payroll::find($employee->payroll_id);
         $rate = $this->calculateRate($payroll, $over->type, $spkl_type, $hour_type, $over->hours, $over->holiday_type);

         $over->update([
            'rate' => $rate
         ]);

         $transactionCon = new TransactionController;
         $transactions = Transaction::where('status', '!=', 3)->where('employee_id', $employee->id)->get();

         foreach ($transactions as $tran) {
            $transactionCon->calculateTotalTransaction($tran, $tran->cut_from, $tran->cut_to);
         }

         if ($over->hours == 0) {
            $over->delete();
         }
      }

      // $transactionReductions = TransactionReduction::get();
      // foreach ($transactionReductions as $tr) {
      //    $transaction = Transaction::find($tr->transaction_id);
      //    $tr->update([
      //       'month' => $transaction->month,
      //       'year' => $transaction->year
      //    ]);
      // }
      // if (auth()->user()->hasRole('HRD-KJ12')) {
      //    $employees = Employee::join('contracts', 'employees.contract_id', '=', 'contracts.id')
      //       ->where('contracts.loc', 'kj1-2')
      //       ->select('employees.*')
      //       ->get();
      // } elseif (auth()->user()->hasRole('HRD-KJ45')) {
      //    $employees = Employee::join('contracts', 'employees.contract_id', '=', 'contracts.id')
      //       ->where('contracts.loc', 'kj4')->orWhere('contracts.loc', 'kj5')
      //       ->select('employees.*')
      //       ->get();
      // } else {
      //    $employees = Employee::get();
      // }
      // $employees = Employee::get();
      // $holidays = Holiday::orderBy('date', 'asc')->get();
      // dd($overtimes);
      return view('pages.payroll.overtime', [
         'overtimes' => $overtimes,
         'employees' => $employees,
         'month' => $now->format('F'),
         'year' => $now->format('Y'),
         'from' => null,
         'to' => null
         // 'holidays' => $holidays
      ])->with('i');
   }


   public function import()
   {

      $now = Carbon::now();
      $overtimes = Overtime::where('month', $now->format('F'))->where('year', $now->format('Y'))->orderBy('date', 'desc')->get();


      $employees = Employee::get();
      // $holidays = Holiday::orderBy('date', 'asc')->get();
      return view('pages.payroll.overtime-import', [
         'overtimes' => $overtimes,
         'employees' => $employees,
         'month' => $now->format('F'),
         'year' => $now->format('Y')
         // 'holidays' => $holidays
      ])->with('i');
   }

   public function importStore(Request $req)
   {

      $req->validate([
         'excel' => 'required'
      ]);
      $file = $req->file('excel');
      $fileName = $file->getClientOriginalName();
      $file->move('OvertimeData', $fileName);

      try {
         // Excel::import(new CargoItemImport($parent->id), $req->file('file-cargo'));
         Excel::import(new OvertimesImport, public_path('/OvertimeData/' . $fileName));
      } catch (Exception $e) {
         return redirect()->back()->with('danger', 'Import Failed ' . $e->getMessage());
      }


      return redirect()->route('payroll')->with('success', 'Overtime Data successfully imported');
   }


   public function filter(Request $req)
   {
      $req->validate([]);

      $employees = Employee::get();

      // if ($req->month == 'all') {
      //    if ($req->year == 'all') {
      //       $overtimes = Overtime::orderBy('date', 'desc')->get();
      //    } else {
      //       // dd('ok');
      //       $overtimes = Overtime::where('year', $req->year)->orderBy('date', 'desc')->get();
      //    }
      // } elseif ($req->year == 'all') {
      //    if ($req->month == 'all') {
      //       $overtimes = Overtime::orderBy('date', 'desc')->get();
      //    } else {
      //       $overtimes = Overtime::where('month', $req->month)->orderBy('date', 'desc')->get();
      //    }
      // } else {
      //    $overtimes = Overtime::where('month', $req->month)->where('year', $req->year)->orderBy('date', 'desc')->get();
      // }

      $overtimes = Overtime::whereBetween('date', [$req->from, $req->to])->get();
      $employees = Employee::get();
      return view('pages.payroll.overtime', [
         'overtimes' => $overtimes,
         'employees' => $employees,
         'month' => $req->month,
         'year' => $req->year,
         'from' => $req->from,
         'to' => $req->to
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
         return redirect()->route('payroll.overtime')->with('danger', $employee->nik . ' ' . $employee->biodata->fullName() . ' belum ada data Gaji Karyawan');
      }


      $locations = Location::get();
      $locId = null;
      foreach ($locations as $loc) {
         if ($loc->code == $employee->contract->loc) {
            $locId = $loc->id;
         }
      }

      $rate = $this->calculateRate($payroll, $req->type, $spkl_type, $hour_type, $req->hours, $req->holiday_type);

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
         'description' => $req->desc,
         'doc' => $doc
      ]);

      // $overtimes = Overtime::where('month', $transaction->month)->get();
      // $totalOvertime = $overtimes->sum('rate');
      $transactionCon = new TransactionController;
      $transactions = Transaction::where('status', '!=', 3)->where('employee_id', $employee->id)->get();

      foreach ($transactions as $tran) {
         $transactionCon->calculateTotalTransaction($tran, $tran->cut_from, $tran->cut_to);
      }



      return redirect()->route('payroll.overtime')->with('success', 'Overtime Data successfully added');
   }






   public function calculateRate($payroll, $type, $spkl_type, $hour_type,  $hours, $holiday_type)
   {
      if ($type == 1) {
         // jika lembur

         if ($spkl_type == 1) {
            $rateOvertime = $payroll->pokok / 173;
         } else if ($spkl_type == 2) {
            $rateOvertime = $payroll->total / 173;
         }

         // dd($rateOvertime);

         if ($hour_type == 1) {
            $rate = $hours * round($rateOvertime);
         } else {
            $multiHours = $hours - 1;
            $totalHours = $multiHours * 2 + 1.5;
            $rate = $totalHours * round($rateOvertime);
         }
      } else {
         // dd('ok');
         $rateOvertime = round(1 / 30 * $payroll->total);
         if ($holiday_type == 1) {
            $rate = 1 * $rateOvertime;
         } elseif ($holiday_type == 2) {
            $rate = 1 * $rateOvertime;
            // dd($rate);
            $rate = 1 * $rateOvertime;
         } elseif ($holiday_type == 3) {
            $rate = 2 * $rateOvertime;
         } elseif ($holiday_type == 4) {
            $rate = 3 * $rateOvertime;
         }
      }



      return $rate;
   }

   public function calculateRateB($type, $spkl_type, $hour_type, $payroll, $hours, $holiday_type)
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
      $employee = Employee::find($overtime->employee_id);
      Storage::delete($overtime->doc);
      $overtime->delete();

      $transactionCon = new TransactionController;
      $transactions = Transaction::where('status', '!=', 3)->where('employee_id', $employee->id)->get();

      foreach ($transactions as $tran) {
         $transactionCon->calculateTotalTransaction($tran, $tran->cut_from, $tran->cut_to);
      }



      return redirect()->route('payroll.overtime')->with('success', 'Overtime Data successfully deleted');
   }
}
