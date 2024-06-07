<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Pe;
use App\Models\PeBehaviorApprasial;
use App\Models\PeDiscipline;
use App\Models\PeKpa;
use App\Models\PekpaDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportController extends Controller
{
   public function kpaEmployee($id)
   {
      $dekripId = dekripRambo($id);
      $kpa = PeKpa::find($dekripId);

      $datas = PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '0')->get();
      // Additional 
      $addtional = PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '1')->first();
      // dd($kpa->employe->biodata->fullName());
      return view('pages.pdf.kpa-employee', [
         'kpa' => $kpa,
         'datas' => $datas,
         'addtional' => $addtional
      ])->with('i');
   }

   public function kpaSummary($employee, $semester, $tahun)
   {
      $dekripEMployee = dekripRambo($employee);
      $dekripSemester = dekripRambo($semester);
      $dekripTahun = dekripRambo($tahun);
      $employee = Employee::find($dekripEMployee);
      // dd($employee->biodata->fullName());

      if ($dekripSemester == 'I') {
         # JIKA SEMESTER I
         $startMonth = 1; // Bulan Mei
         $endMonth = 6; // Bulan Agustus

         // $products = Product::
         //     ->get();

      } else if ($dekripSemester == 'II') {
         # JIKA SEMSESTER II

         $startMonth = 7; // Bulan Mei
         $endMonth = 12; // Bulan Agustus
      }

      $kpas = PeKpa::where('employe_id', $employee->id)
         ->where('status', '>', 0)
         ->whereYear('date', $dekripTahun)
         ->whereMonth('date', '>=', $startMonth)
         ->whereMonth('date', '<=', $endMonth)
         ->orderBy('date', 'desc')
         ->orderBy('employe_id')
         ->get();

      $months = range($startMonth, $endMonth);


      $achievementData = array_fill_keys($months, 0);

      $achievements = PeKpa::selectRaw('MONTH(date) as month, achievement')
         ->whereIn(DB::raw('MONTH(date)'), $months)
         ->where('employe_id', $employee->id)
         ->where('status', '>', 0)
         ->whereYear('date', $dekripTahun)
         ->get();

      $index = 0;
      foreach ($achievements as $achievement) {
         $month = $achievement->month;
         $achievementData[$month] = $achievement->achievement;

         $index++;
      }

      $rating = PeKpa::where('employe_id', $employee->id)
         ->where('status', '>', 0)
         ->whereYear('date', $dekripTahun)
         ->whereMonth('date', '>=', $startMonth)
         ->whereMonth('date', '<=', $endMonth)
         ->avg('achievement');



      $karyawan = Employee::find($employee->id);

      return view('pages.pdf.kpa-summary', [
         'kpas' => $kpas,
         'karyawan' => $karyawan,
         'semester' => $dekripSemester,
         'tahun' => $dekripTahun,

         'rating' => intval($rating),
         'achievementData' => $achievementData
      ])->with('i');
   }



   public function kpiExample()
   {

      // dd($kpa->employe->biodata->fullName());
      return view('pages.pdf.kpi-example', [
         // 'kpa' => $kpa,
         // 'datas' => $datas,
         // 'addtional' => $addtional
      ])->with('i');
   }


   public function qpe($id)
   {

      $pe = Pe::find($id);
      $pd = PeDiscipline::where('pe_id', $pe->id)->first();
      $kpa = PeKpa::where('pe_id', $pe->id)->first();
      $pba = PeBehaviorApprasial::where('pe_id', $pe->id)->first();
      $kds = PekpaDetail::where('kpa_id', $kpa->id)
         ->where('addtional', '0')
         ->get();

      $kda = PekpaDetail::where('kpa_id', $kpa->id)
         ->where('addtional', '1')
         ->first();

      // dd($kpa->employe->biodata->fullName());
      return view('pages.pdf.qpe-pdf', [
         'pe' => $pe,
         'pd' => $pd,
         'kpa' => $kpa,
         'pba' => $pba,
         'kds' => $kds,
         'kda' => $kda,
      ])->with('i');
   }
}
