<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Pe;
use App\Models\Sp;
use App\Models\SpApproval;
use App\Models\Spkl;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SpController extends Controller
{
   public function index()
   {
      $now = Carbon::now();

      // dd(auth()->user()->getEmployee()->id);

      if (auth()->user()->hasRole('Administrator|HRD-Spv')) {
         $employees = Employee::get();
         $sps = Sp::orderBy('created_at', 'desc')->get();
      } elseif (auth()->user()->hasRole('HRD')) {
         $employees = Employee::get();
         $sps = Sp::orderBy('created_at', 'desc')->get();
      } elseif (auth()->user()->hasRole('Manager')) {
         $employees = Employee::where('department_id', auth()->user()->getEmployee()->department_id)->where('designation_id', '<', 6)->get();

         $sps = Sp::where('department_id', auth()->user()->getEmployee()->department_id)->orderBy('created_at', 'desc')->get();
      } elseif (auth()->user()->hasRole('Leader') || auth()->user()->hasRole('Supervisor')) {
         // dd(auth()->user()->getEmployeeId());
         // $employees = Employee::where('department_id', auth()->user()->getEmployee()->department_id)->where('designation_id', '<', 4)->get();
         $employees = Employee::where('direct_leader_id', auth()->user()->getEmployeeId())->get();
         $sps = Sp::where('department_id', auth()->user()->getEmployee()->department_id)->orderBy('created_at', 'desc')->get();
      }
      
      // foreach ($sps as $sp) {
      //    if ($sp->date_to < $now) {
      //       // dd($sp->code);
      //       $sp->update([
      //          'status' => 0
      //       ]);
      //    }
      // }

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
      // $from = Carbon::make($req->date_from);

      // $bulan = $from->format('m');
      // $tahun = $from->format('Y');

      // if ($bulan >= 1 && $bulan <= 6) {
      //    $semester =  1; // Semester 1: Januari sampai Juni
      // } else {
      //    $semester =  2; // Semester 2: Juli sampai Desember
      // }





      Sp::create([
         'department_id' => $employee->department_id,
         'employee_id' => $req->employee,
         'by_id' => auth()->user()->getEmployee()->id,
         // 'semester' => $semester,
         // 'tahun' => $tahun,
         'status' => '0',
         'code' => $code,
         'level' => $req->level,
         // 'date_from' => $req->date_from,
         // 'date_to' => $from->addMonths(6),
         'reason' => $req->reason,
         'desc' => $req->desc,
         // 'rule' => $req->rule,
      ]);

      

      return redirect()->back()->with('success', 'SP Created');
   }

   public function detail($id)
   {
      $spkl = Spkl::get()->first();
      $sp = Sp::find(dekripRambo($id));
      // $manager = Employee::find(1);
      $employee = Employee::find($sp->employee_id);
      if (auth()->user()->hasRole('Administrator|HRD|HRD-Spv')) {
         $employees = Employee::get();
      } elseif (auth()->user()->hasRole('Manager')) {
         $employees = Employee::where('department_id', auth()->user()->getEmployee()->department_id)->where('designation_id', '<', 6)->get();
      } elseif (auth()->user()->hasRole('Leader') || auth()->user()->hasRole('Supervisor')) {
         $employees = Employee::where('department_id', auth()->user()->getEmployee()->department_id)->where('designation_id', '<', 4)->get();
      } else {
         $employees = [];
      }

      $user = SpApproval::where('status', 1)->where('type', 'Release')->first();
      $hrd = SpApproval::where('status', 1)->where('type', 'Approve')->where('level', 'hrd')->first();
      $manager = SpApproval::where('status', 1)->where('type', 'Approve')->where('level', 'manager')->first();
      $suspect = SpApproval::where('status', 1)->where('type', 'Approve')->where('level', 'employee')->first();
      // dd($sp->created_by->biodata->fullName());
      // dd();

      if ($employee->biodata->gender == 'Male') {
         $gen = 'Saudara';
      } elseif ($employee->biodata->gender == 'Female') {
         $gen = 'Saudari';
      } else {
         $gen = 'Saudara/Saudari';
      }

      $approvals = SpApproval::where('sp_id', $sp->id)->get();


      return view('pages.sp.detail', [
         'spkl' => $spkl,
         'sp' => $sp,
         // 'manager' => $manager,
         'gen' => $gen,
         'employees' => $employees,
         'approvals' => $approvals,
         'user' => $user,
         'hrd' => $hrd,
         'manager' => $manager,
         'suspect' => $suspect
      ]);
   }

   public function update(Request $req)
   {
      $sp = Sp::find($req->id);
      // dd($sp->code);

      $sp->update([
         'employee_id' => $req->employee,
         'level' => $req->level,
         'reason' => $req->reason,
         'desc' => $req->desc
      ]);

      return redirect()->back()->with('success', 'SP updated.');
   }

   public function delete($id)
   {
      // dd('delete');
      $sp = Sp::find(dekripRambo($id));

      $sp->delete();

      return redirect()->route('sp')->with('success', 'SP deleted');
   }

   
}
