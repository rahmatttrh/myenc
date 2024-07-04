<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Log;
use App\Models\Pe;
use App\Models\Sp;
use App\Models\SpApproval;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SpApprovalController extends Controller
{
   public function submit(Request $req, $id)
   {
      // Validasi input
      $req->validate([
         'id' => 'required',
      ]);

      // dd(auth()->user()->getEmployeeId());

      $sp = Sp::find($req->id);

      $sp->update([
         'status' => '1',
         // 'release_at' => NOW()
      ]);

      SpApproval::create([
         'status' => 1,
         'sp_id' => $sp->id,
         'type' => 'Release',
         'level' => 'user',
         'employee_id' => auth()->user()->getEmployeeId(),
      ]);

      $employee = Employee::find(auth()->user()->getEmployeeId());
      Log::create([
         'department_id' => $employee->department_id,
         'user_id' => auth()->user()->id,
         'action' => 'Submit',
         'desc' => 'SP ' . $sp->level . ' ' . $sp->code . ' ' . $sp->employee->nik . ' ' . $sp->employee->biodata->fullName()
      ]);

      return  back()->with('success', 'SP berhasil di submit');
   }

   public function appHrd(Request $req, $id)
   {
      // Validasi input
      $req->validate([
         'id' => 'required',
      ]);

      $from = Carbon::make($req->date_from);
      $bulan = $from->format('m');
      $tahun = $from->format('Y');

      if ($bulan >= 1 && $bulan <= 6) {
         $semester =  1; // Semester 1: Januari sampai Juni
      } else {
         $semester =  2; // Semester 2: Juli sampai Desember
      }

      $sp = Sp::find($req->id);
      $sp->update([
         'tahun' => $tahun,
         'semester' => $semester,
         'status' => '2',
         'rule' => $req->rule,
         'date_from' => $req->date_from,
         'date_to' => $from->addMonths(6),
         'approved_at' => NOW()
      ]);

      SpApproval::create([
         'status' => 1,
         'sp_id' => $sp->id,
         'type' => 'Approve',
         'level' => 'hrd',
         'employee_id' => auth()->user()->getEmployeeId(),
      ]);

      $pe = Pe::where('employe_id', $sp->employee_id)
         ->where('tahun', $sp->tahun)
         ->where('semester', $sp->semester)
         ->first();

      if ($pe) {
         $sp->update([
            'pe_id' => $pe->id
         ]);

         // Memanggil fungsi dari controller lain untuk calculate pe 
         $qpc = new QuickPEController;
         $qpc->calculatePe($pe->id);
      }

      $employee = Employee::find(auth()->user()->getEmployeeId());
      Log::create([
         'department_id' => $employee->department_id,
         'user_id' => auth()->user()->id,
         'action' => 'Approve',
         'desc' => 'SP ' . $sp->level . ' ' . $sp->code . ' ' . $sp->employee->nik . ' ' . $sp->employee->biodata->fullName()
      ]);

      return  back()->with('success', 'SP successfully verified');
   }

   public function appManager(Request $req, $id)
   {
      // Validasi input
      $req->validate([
         'id' => 'required',
      ]);

      $sp = Sp::find($req->id);
      $sp->update([
         'status' => '3',
      ]);

      SpApproval::create([
         'status' => 1,
         'sp_id' => $sp->id,
         'type' => 'Approve',
         'level' => 'manager',
         'employee_id' => auth()->user()->getEmployeeId(),
      ]);

      $employee = Employee::find(auth()->user()->getEmployeeId());
      Log::create([
         'department_id' => $employee->department_id,
         'user_id' => auth()->user()->id,
         'action' => 'Approve',
         'desc' => 'SP ' . $sp->level . ' ' . $sp->code . ' ' . $sp->employee->nik . ' ' . $sp->employee->biodata->fullName()
      ]);

      return  back()->with('success', 'SP successfully approved and sent to Employee');
   }

   public function appEmployee(Request $req, $id)
   {
      // Validasi input
      $req->validate([
         'id' => 'required',
      ]);

      $sp = Sp::find($req->id);
      $sp->update([
         'status' => '4',
      ]);

      SpApproval::create([
         'status' => 1,
         'sp_id' => $sp->id,
         'type' => 'Approve',
         'level' => 'employee',
         'employee_id' => auth()->user()->getEmployeeId(),
      ]);

      $employee = Employee::find(auth()->user()->getEmployeeId());

      Log::create([
         'department_id' => $employee->department_id,
         'user_id' => auth()->user()->id,
         'action' => 'Confirm',
         'desc' => 'SP ' . $sp->level . ' ' . $sp->code
      ]);

      return  back()->with('success', 'SP successfully confirmed');
   }

   // public function appEmployee(Request $req, $id)
   // {
   //    // Validasi input
   //    $req->validate([
   //       'id' => 'required',
   //    ]);

   //    $sp = Sp::find($req->id);
   //    $sp->update([
   //       'status' => '3',
   //       'approved_at' => NOW()
   //    ]);

   //    return  back()->with('success', 'SP successfully confirmed');
   // }

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
