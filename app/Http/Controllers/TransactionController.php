<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Additional;
use App\Models\Absence;
use App\Models\Additional;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Location;
use App\Models\Overtime;
use App\Models\Payroll;
use App\Models\Reduction;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TransactionReduction;
use App\Models\Unit;
use App\Models\UnitTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

   public function index()
   {
   public function index()
   {
      $employees = Employee::get();
      $transactions = Transaction::get();
      $units = Unit::get();
      $firstUnit = Unit::get()->first();
      return view('pages.payroll.transaction.index', [
         'employees' => $employees,
         'transactions' => $transactions,
         'units' => $units,
         'firstUnit' => $firstUnit
      ])->with('i');
   }

   public function detail($id)
   {

   public function detail($id)
   {

      // dd($employee->id);
      // $payroll = Payroll::find($employee->payroll_id);
      $transaction = Transaction::find(dekripRambo($id));
      $employee = Employee::find($transaction->employee_id);
      $reductions = Reduction::where('unit_id', $employee->unit_id)->get();
      $payroll = Payroll::find($employee->payroll_id);
      $transactionReductions = TransactionReduction::where('transaction_id', $transaction->id)->get();



      $overtimes = Overtime::where('month', $transaction->month)->where('employee_id', $employee->id)->get();
      $totalOvertime = $overtimes->sum('rate');
      $bruto = $payroll->total + $totalOvertime;

      $absences = $employee->absences->where('month', $transaction->month)->where('year', $transaction->year);
      $alphas = $employee->absences->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 1);
      $lates = $employee->absences->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 2);
      $izins = $employee->absences->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 3);
      // dd($alphas);
      $reductionAlpha = null;
      foreach ($alphas as $alpha) {
         $reductionAlpha = $reductionAlpha + $alpha->value;
         // $alpha->update([
         //    'value' => $reductionAlpha
         // ]);
      }
      // dd($reductionAlpha);

      $reduction = $transaction->reductions->where('type', 'employee')->sum('value') + $reductionAlpha;
      $additionals = Additional::where('employee_id', $employee->id)->where('month', $transaction->month)->where('year', $transaction->year)->get();


      $transaction->update([
         'bruto' => $bruto,
         'overtime' => $totalOvertime,
         'reduction' => $reduction,

      ]);

      $bruto = $payroll->total + $totalOvertime;

      $absences = $employee->absences->where('month', $transaction->month)->where('year', $transaction->year);
      $alphas = $employee->absences->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 1);
      $lates = $employee->absences->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 2);
      $izins = $employee->absences->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 3);
      // dd($alphas);
      $reductionAlpha = null;
      foreach ($alphas as $alpha) {
         $reductionAlpha = $reductionAlpha + $alpha->value;
         // $alpha->update([
         //    'value' => $reductionAlpha
         // ]);
      }
      // dd($reductionAlpha);

      $reduction = $transaction->reductions->where('type', 'employee')->sum('value') + $reductionAlpha;
      $additionals = Additional::where('employee_id', $employee->id)->where('month', $transaction->month)->where('year', $transaction->year)->get();


      $transaction->update([
         'bruto' => $bruto,
         'overtime' => $totalOvertime,
         'reduction' => $reduction,

      ]);


      $this->calculateTotalTransaction($transaction);




      return view('pages.payroll.transaction.detail', [
         'employee' => $employee,
         'payroll' => $payroll,
         'transaction' => $transaction,
         'overtimes' => $overtimes,
         'totalOvertime' => $totalOvertime,
         'alphas' => $alphas,
         'lates' => $lates,
         'izins' => $izins,
         'absences' => $absences,
         'additionals' => $additionals
         'totalOvertime' => $totalOvertime,
         'alphas' => $alphas,
         'lates' => $lates,
         'izins' => $izins,
         'absences' => $absences,
         'additionals' => $additionals
      ]);
   }

   public function storeMaster(Request $req)
   {
   public function storeMaster(Request $req)
   {
      $unit = Unit::find($req->unit);
      $employees = Employee::where('unit_id', $unit->id)->where('status', 1)->get();
      $current = UnitTransaction::where('unit_id', $unit->id)->where('month', $req->month)->where('year', $req->year)->first();
      if ($current) {
         return redirect()->back()->with('danger', 'Slip Gaji ' . $unit->name . ' Bulan ' . $req->month . ' ' . $req->year . ' sudah ada');
<<<<<<< HEAD
      } 
      $totalSalary = 0;
      $totalEmployee = 0;

      foreach($employees as $employee){
         if ($employee->payroll_id != null) {
            if ($employee->contract->loc == null) {
               return redirect()->back()->with('danger', 'Data Lokasi Kerja Kosong '. $employee->nik . ' ' . $employee->biodata->fullName());
=======
      }
      $totalSalary = 0;
      $totalEmployee = 0;

      foreach ($employees as $employee) {
         if ($employee->payroll_id != null) {
            if ($employee->contract->loc == null) {
               return redirect()->back()->with('danger', 'Data Lokasi Kerja Kosong ' . $employee->nik . ' ' . $employee->biodata->fullName());
>>>>>>> 5371422cd3838fa00e68679ea77f2f283da3fa49
            }
         }
      }

<<<<<<< HEAD
      foreach($employees as $emp){
=======
      foreach ($employees as $emp) {
>>>>>>> 5371422cd3838fa00e68679ea77f2f283da3fa49
         if ($emp->payroll_id != null) {
            $totalSalary = $totalSalary + $emp->payroll->total;
            $totalEmployee = $totalEmployee + 1;
            
            $this->store($emp, $req);
         }
      }

      UnitTransaction::create([
         'status' => 0,
         'unit_id' => $unit->id,
         'month' => $req->month,
         'year' => $req->year,
         'total_employee' => $totalEmployee,
         'total_salary' => $totalSalary
      ]);




      return redirect()->back()->with('success', 'Master Transaction successfully created');

      // dd($totalSalary);
   }

<<<<<<< HEAD
   public function deleteMaster($id){
=======
   public function deleteMaster($id)
   {
>>>>>>> 5371422cd3838fa00e68679ea77f2f283da3fa49
      $unitTransaction = UnitTransaction::find(dekripRambo($id));
      dd($unitTransaction->id);
   }

<<<<<<< HEAD
   public function monthly($id){
=======
   public function monthly($id)
   {
>>>>>>> 5371422cd3838fa00e68679ea77f2f283da3fa49
      $unitTransaction = UnitTransaction::find(dekripRambo($id));
      $unit = Unit::find($unitTransaction->unit_id);
      $units = Unit::get();
      $locations = Location::get();
      $firstLoc = Location::orderBy('id', 'asc')->first();
      $transactions = Transaction::where('unit_id', $unit->id)->where('month', $unitTransaction->month)->where('year', $unitTransaction->year)->get();

      return view('pages.payroll.transaction.monthly-loc', [
         'unit' => $unit,
         'units' => $units,
         'locations' => $locations,
         'firstLoc' => $firstLoc,
         'unitTransaction' => $unitTransaction,
         'transactions' => $transactions
      ])->with('i');
   }

   public function location($unit, $loc)
   {
      $unitTransaction = UnitTransaction::find(dekripRambo($unit));
      $location = Location::find(dekripRambo($loc));
      $transactions = Transaction::where('month', $unitTransaction->month)->where('year', $unitTransaction->year)->where('location_id', $location->id)->get();
      // dd($unitTransaction->id);

      return view('pages.payroll.transaction.location', [
         'unitTransaction' => $unitTransaction,
         'transactions' => $transactions,
         'location' => $location
      ])->with('i');
   }

   public function monthlyAll($id)
   {
      $unitTransaction = UnitTransaction::find(dekripRambo($id));
      $unit = Unit::find($unitTransaction->unit_id);
      $units = Unit::get();
      $locations = Location::get();
      $firstLoc = Location::orderBy('id', 'asc')->first();
      $locations = Location::get();
      $firstLoc = Location::orderBy('id', 'asc')->first();
      $transactions = Transaction::where('unit_id', $unit->id)->where('month', $unitTransaction->month)->where('year', $unitTransaction->year)->get();

      return view('pages.payroll.transaction.monthly-all', [
      return view('pages.payroll.transaction.monthly-all', [
         'unit' => $unit,
         'units' => $units,
         'locations' => $locations,
         'firstLoc' => $firstLoc,
         'locations' => $locations,
         'firstLoc' => $firstLoc,
         'unitTransaction' => $unitTransaction,
         'transactions' => $transactions
      ])->with('i');
   }

   public function store($emp, $req)
   {
   public function store($emp, $req)
   {
      $employee = Employee::find($emp->id);
      $payroll = Payroll::find($employee->payroll_id);
      $locations = Location::get();

<<<<<<< HEAD
      foreach($locations as $loc){
=======
      foreach ($locations as $loc) {
>>>>>>> 5371422cd3838fa00e68679ea77f2f283da3fa49
         if ($loc->code == $employee->contract->loc) {
            $location = $loc->id;
         }
      }

      // if ($employee->contract->loc == null) {
      //    return redirect()->back()->with('danger', 'Data Lokasi Kerja Kosong '. $employee->nik . ' ' . $employee->biodata->fullName());
      // }

      $now = Carbon::today();
      $month = $now->format('F');
      // dd($month);
      $year = $now->format('Y');
      // dd($now->format('d/m/Y'));



      $transaction = Transaction::create([
         'status' => 0,
<<<<<<< HEAD
         'unit_id' => $emp->unit_id, 
=======
         'unit_id' => $emp->unit_id,
>>>>>>> 5371422cd3838fa00e68679ea77f2f283da3fa49
         'location_id' => $location,
         'employee_id' => $employee->id,
         'payroll_id' => $payroll->id,
         'payroll_id' => $payroll->id,
         'month' => $req->month,
         'year' => $req->year,
         'total' => 0
      ]);

      TransactionDetail::create([
         'transaction_id' => $transaction->id,
         'type' => 'basic',
         'desc' => 'Gaji Pokok',
         'value' => $payroll->pokok,
      ]);

      TransactionDetail::create([
         'transaction_id' => $transaction->id,
         'type' => 'basic',
         'desc' => 'Tunj. Jabatan',
         'value' => $payroll->tunj_jabatan,
      ]);

      TransactionDetail::create([
         'transaction_id' => $transaction->id,
         'type' => 'basic',
         'desc' => 'Tunj. OPS',
         'value' => $payroll->tunj_ops,
      ]);

      TransactionDetail::create([
         'transaction_id' => $transaction->id,
         'type' => 'basic',
         'desc' => 'Tunj. Kinerja',
         'value' => $payroll->tunj_kinerja,
      ]);

      TransactionDetail::create([
         'transaction_id' => $transaction->id,
         'type' => 'basic',
         'desc' => 'Tunj. Fungsional',
         'value' => $payroll->tunj_fungsional,
      ]);

      TransactionDetail::create([
         'transaction_id' => $transaction->id,
         'type' => 'basic',
         'desc' => 'Insentif',
         'value' => $payroll->insentif,
      ]);

      $reductions = Reduction::where('unit_id', $employee->unit_id)->get();
      foreach ($reductions as $red) {
         if ($payroll->total <= $red->min_salary) {
            // dd('kurang dari minimum gaju');
            $salary = $red->min_salary;
            $realSalary = $payroll->total;

            $bebanPerusahaan = ($red->company * $salary) / 100;
            $bebanKaryawan = ($red->employee * $realSalary) / 100;
            $bebanKaryawanReal = ($red->employee * $salary) / 100;
            $selisih = $bebanKaryawanReal - $bebanKaryawan;
            $bebanPerusahaanReal = $bebanPerusahaan + $selisih;
            $bebanKaryawanReal = ($red->employee * $salary) / 100;
            $selisih = $bebanKaryawanReal - $bebanKaryawan;
            $bebanPerusahaanReal = $bebanPerusahaan + $selisih;
         } else {
            $salary = $payroll->total;
            $bebanPerusahaan = ($red->company * $salary) / 100;
            $bebanKaryawan = ($red->employee * $salary) / 100;
            $bebanKaryawanReal = 0;
            $bebanPerusahaanReal = $bebanPerusahaan;
            $bebanKaryawanReal = 0;
            $bebanPerusahaanReal = $bebanPerusahaan;
         }
         // $bebanPerusahaan = ($red->company * $salary) / 100;
         // $bebanKaryawan = ($red->employee * $salary) / 100;
         // dd($bebanPerusahaan);

         TransactionReduction::create([
            'transaction_id' => $transaction->id,
            'type' => 'company',
            'location_id' => $location,
            'location_id' => $location,
            'name' => $red->name,
            'value' => $bebanPerusahaan,
            'value_real' => $bebanPerusahaanReal
            'value' => $bebanPerusahaan,
            'value_real' => $bebanPerusahaanReal
         ]);

         TransactionReduction::create([
            'transaction_id' => $transaction->id,
            'type' => 'employee',
            'location_id' => $location,
            'location_id' => $location,
            'name' => $red->name,
            'value' => $bebanKaryawan,
            'value_real' => $bebanKaryawanReal
            'value' => $bebanKaryawan,
            'value_real' => $bebanKaryawanReal
         ]);
      }

      $transactionDetails = TransactionDetail::where('transaction_id', $transaction->id)->get();


      // $overtimes = Overtime::where('month', $transaction->month)->get();
      // $totalOvertime = $overtimes->sum('rate');


      $transaction->update([
         'total' => $transactionDetails->sum('value') - $transaction->reductions->where('type', 'employee')->sum('value')
         'total' => $transactionDetails->sum('value') - $transaction->reductions->where('type', 'employee')->sum('value')
      ]);




      return redirect()->back()->with('success', 'Payroll Transaction successfully added');
   }



   public function calculateTotalTransaction($transaction)
   {
   public function calculateTotalTransaction($transaction)
   {
      $employee = Employee::find($transaction->employee_id);
      $payroll = Payroll::find($employee->payroll_id);
      $transactionDetails = TransactionDetail::where('transaction_id', $transaction->id)->get();
      $overtimes = Overtime::where('month', $transaction->month)->where('employee_id', $employee->id)->get();
      $totalOvertime = $overtimes->sum('rate');

      $alphas = $employee->absences->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 1);
      $lates = $employee->absences->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 2);
      $izins = $employee->absences->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 3);

      // additoinal penambahan & pengurangan
      $addPenambahan = Additional::where('employee_id', $employee->id)->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 1)->get()->sum('value');
      $addPengurangan = Additional::where('employee_id', $employee->id)->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 2)->get()->sum('value');


      $reductionAlpha = null;
      foreach ($alphas as $alpha) {
         $reductionAlpha = $reductionAlpha + 1 * 1 / 30 * $payroll->total;
      }


      $alphas = $employee->absences->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 1);
      $lates = $employee->absences->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 2);
      $izins = $employee->absences->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 3);

      // additoinal penambahan & pengurangan
      $addPenambahan = Additional::where('employee_id', $employee->id)->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 1)->get()->sum('value');
      $addPengurangan = Additional::where('employee_id', $employee->id)->where('month', $transaction->month)->where('year', $transaction->year)->where('type', 2)->get()->sum('value');


      $reductionAlpha = null;
      foreach ($alphas as $alpha) {
         $reductionAlpha = $reductionAlpha + 1 * 1 / 30 * $payroll->total;
      }

      $transaction->update([
         'total' => $transactionDetails->sum('value') - $transaction->reductions->where('type', 'employee')->sum('value') + $totalOvertime - $reductionAlpha + $addPenambahan - $addPengurangan
         'total' => $transactionDetails->sum('value') - $transaction->reductions->where('type', 'employee')->sum('value') + $totalOvertime - $reductionAlpha + $addPenambahan - $addPengurangan
      ]);
   }
}
