<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Pe;
use App\Models\Sp;
use App\Models\Spkl;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SpController extends Controller
{
   public function index()
   {
      $now = Carbon::now();

      // dd(auth()->user()->getEmployee()->id);

      if (auth()->user()->hasRole('Administrator')) {
         $employees = Employee::get();
         $sps = Sp::orderBy('created_at', 'desc')->get();
      } elseif (auth()->user()->hasRole('Manager')) {
         $employees = Employee::where('department_id', auth()->user()->getEmployee()->department_id)->where('designation_id', '<', 6)->get();

         $sps = Sp::where('department_id', auth()->user()->getEmployee()->department_id)->orderBy('created_at', 'desc')->get();
      } elseif (auth()->user()->hasRole('Leader') || auth()->user()->hasRole('Supervisor')) {
         $employees = Employee::where('department_id', auth()->user()->getEmployee()->department_id)->where('designation_id', '<', 4)->get();

         $sps = Sp::where('department_id', auth()->user()->getEmployee()->department_id)->orderBy('created_at', 'desc')->get();
      }

      foreach ($sps as $sp) {
         if ($sp->date_to < $now) {
            // dd($sp->code);
            $sp->update([
               'status' => 0
            ]);
         }
      }

      return view('pages.sp.index', [
         'employees' => $employees,
         'sps' => $sps
      ])->with('i');
   }

   public function store(Request $req)
   {

      $date = Carbon::now();
      $employee = Employee::find($req->employee);

      $sp = Sp::orderBy("created_at", "desc")->first();
      if (isset($sp)) {
         $code = "SP/" . $employee->department->id . '/' . $date->format('dmy') . '/' . ($sp->id + 1);
      } else {
         $code = "SP/"  . $employee->department->id . '/' . $date->format('dmy') . '/' . 1;
      }

      $spEmployee = Sp::where('employee_id', $employee->id)->where('status', 1)->latest()->first();
      if ($spEmployee) {
         if ($spEmployee->level == 'I') {
            $level = 'II';
         } elseif ($spEmployee->level == 'II') {
            $level = 'III';
         } else {
            $level = 'I';
         }
      } else {
         $level = 'I';
      }

      // dd($req->date_from);
      $from = Carbon::make($req->date_from);

      $bulan = $from->format('m');
      $tahun = $from->format('Y');

      if ($bulan >= 1 && $bulan <= 6) {
         $semester =  1; // Semester 1: Januari sampai Juni
      } else {
         $semester =  2; // Semester 2: Juli sampai Desember
      }



      Sp::create([
         'department_id' => $employee->department_id,
         'employee_id' => $req->employee,
         'by_id' => auth()->user()->getEmployee()->id,
         'semester' => $semester,
         'tahun' => $tahun,
         'status' => '0',
         'code' => $code,
         'level' => $req->level,
         'date_from' => $req->date_from,
         'date_to' => $from->addMonths(6),
         'desc' => $req->desc
      ]);

      return redirect()->back()->with('success', 'SP submited');
   }

   public function detail($id)
   {
      $spkl = Spkl::get()->first();
      $sp = Sp::find(dekripRambo($id));

      // dd($sp->created_by->biodata->fullName());
      // dd();


      return view('pages.sp.detail', [
         'spkl' => $spkl,
         'sp' => $sp,
         'manager' => $manager
      ]);
   }

   public function delete($id)
   {
      // dd('delete');
      $sp = Sp::find(dekripRambo($id));

      $sp->delete();

      return redirect()->route('sp')->with('success', 'SP deleted');
   }

   public function submit(Request $req, $id)
   {
      // Validasi input
      $req->validate([
         'id' => 'required',
      ]);

      $sp = Sp::find($req->id);

      $sp->update([
         'status' => '1',
         'release_at' => NOW()
      ]);

      return  back()->with('success', 'SP berhasil di submit');
   }

   public function approved(Request $req, $id)
   {
      // Validasi input
      $req->validate([
         'id' => 'required',
      ]);

      $sp = Sp::find($req->id);

      $pe = Pe::where('employe_id', $sp->employee_id)
         ->where('tahun', $sp->tahun)
         ->where('semester', $sp->semester)
         ->first();


      $sp->update([
         'status' => '2',
         'approved_at' => NOW()
      ]);

      if ($pe) {
         $sp->update([
            'pe_id' => $pe->id
         ]);

         // Memanggil fungsi dari controller lain untuk calculate pe 
         $qpc = new QuickPEController;
         $qpc->calculatePe($pe->id);
      }

      return  back()->with('success', 'SP berhasil di Approved');
   }


   public function reject(Request $req, $id)
   {
      // Validasi input
      $req->validate([
         'id' => 'required',
      ]);

      $sp = Sp::find($req->id);

      $sp->update([
         'status' => '101',
         'alasan_reject' => $req->alasan_reject,
         'reject_at' => NOW()
      ]);

      return  back()->with('success', 'SP berhasil di reject');
   }
}
