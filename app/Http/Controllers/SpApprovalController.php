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
         'type' => 'Submit',
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

   public function release(Request $req, $id)
   {
      // Validasi input
      $req->validate([
         'id' => 'required',
      ]);

      // dd(auth()->user()->getEmployeeId());

      $sp = Sp::find($req->id);
      // dd($sp->id);

      $sp->update([
         'status' => '3',
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
         'action' => 'Release',
         'desc' => 'SP ' . $sp->level . ' ' . $sp->code . ' ' . $sp->employee->nik . ' ' . $sp->employee->biodata->fullName()
      ]);

      return  back()->with('success', 'SP successfully sent to Manager');
   }

   public function appHrd(Request $req, $id)
   {
      // Validasi input
      $req->validate([
         'id' => 'required',
         'file' => request('file') ? 'mimes:pdf,jpg,jpeg,png|max:5120' : '',
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
      if (request('file')) {
         
         $file = request()->file('file')->store('sp/file');
      }  else {
         $file = $sp->file;
      }

      
      $sp->update([
         'tahun' => $tahun,
         'semester' => $semester,
         'status' => '2',
         'rule' => $req->rule,
         'date_from' => $req->date_from,
         'date_to' => $from->addMonths(6),
         'reason' => $req->reason,
         'file' => $file
         // 'approved_at' => NOW()
      ]);

      SpApproval::create([
         'status' => 1,
         'sp_id' => $sp->id,
         'type' => 'Approve',
         'level' => 'hrd',
         'employee_id' => auth()->user()->getEmployeeId(),
      ]);

      // $pe = Pe::where('employe_id', $sp->employee_id)
      //    ->where('tahun', $sp->tahun)
      //    ->where('semester', $sp->semester)
      //    ->first();

      // if ($pe) {
      //    $sp->update([
      //       'pe_id' => $pe->id
      //    ]);

      //    // Memanggil fungsi dari controller lain untuk calculate pe 
      //    $qpc = new QuickPEController;
      //    $qpc->calculatePe($pe->id);
      // }

      $employee = Employee::find(auth()->user()->getEmployeeId());
      Log::create([
         'department_id' => $employee->department_id,
         'user_id' => auth()->user()->id,
         'action' => 'Approve',
         'desc' => 'SP ' . $sp->level . ' ' . $sp->code . ' ' . $sp->employee->nik . ' ' . $sp->employee->biodata->fullName()
      ]);

      return  back()->with('success', 'SP successfully verified');
   }

   public function rejectHrd(Request $req){
      dd('reject');
   }

   public function appManager(Request $req, $id)
   {
      // Validasi input
      $req->validate([
         'id' => 'required',
      ]);

      // $from = Carbon::make($req->date_from);
      // $bulan = $from->format('m');
      // $tahun = $from->format('Y');

      // if ($bulan >= 1 && $bulan <= 6) {
      //    $semester =  1; // Semester 1: Januari sampai Juni
      // } else {
      //    $semester =  2; // Semester 2: Juli sampai Desember
      // }

      $sp = Sp::find($req->id);
      $sp->update([
         'status' => '4',
      ]);

      SpApproval::create([
         'status' => 1,
         'sp_id' => $sp->id,
         'type' => 'Approve',
         'level' => 'manager',
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

      return  back()->with('success', 'SP successfully approved and sent to Employee');
   }

   public function discussManager(Request $req){
      $sp = Sp::find($req->sp);
      $sp->update([
         'status' => 101,
         'nd_for' => $req->nd_for,
         'nd_date' => $req->date,
         'nd_reason' => $req->reason
      ]);

      $employee = Employee::find(auth()->user()->getEmployeeId());
      Log::create([
         'department_id' => $employee->department_id,
         'user_id' => auth()->user()->id,
         'action' => 'Need Discuss',
         'desc' => 'SP ' . $sp->level . ' ' . $sp->code . ' ' . $sp->employee->nik . ' ' . $sp->employee->biodata->fullName()
      ]);

      if ($req->nd_for == 1) {
         $for = 'Atasan Langsung';
      } elseif($req->nd_for == 2){
         $for = 'Karyawan';
      } elseif($req->nd_for == 3){
         $for = 'Atasan Langsung & Karyawan';
      }

      return  back()->with('success', 'SP Need Discussion sent to ' . $for);


   }

   public function appEmployee(Request $req, $id)
   {
      // Validasi input
      $req->validate([
         'id' => 'required',
      ]);

      $sp = Sp::find($req->id);
      $sp->update([
         'status' => '5',
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

   public function complainEmployee(Request $req)
   {
      // Validasi input
      $req->validate([
         'sp' => 'required',
      ]);

      $sp = Sp::find($req->sp);
      $sp->update([
         // 'status' => 202,
         'complain_reason' => $req->reason
      ]);

      // SpApproval::create([
      //    'status' => 1,
      //    'sp_id' => $sp->id,
      //    'type' => 'Approve',
      //    'level' => 'employee',
      //    'employee_id' => auth()->user()->getEmployeeId(),
      // ]);

      $employee = Employee::find(auth()->user()->getEmployeeId());
      Log::create([
         'department_id' => $employee->department_id,
         'user_id' => auth()->user()->id,
         'action' => 'Complain',
         'desc' => 'SP ' . $sp->level . ' ' . $sp->code
      ]);

      return  back()->with('success', 'SP notes successfully submited');
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

      // dd('ok');

      $sp = Sp::find($req->id);

      $sp->update([
         'status' => '505',
         'alasan_reject' => $req->alasan_reject,
         'reject_at' => NOW()
      ]);

      SpApproval::create([
         'status' => 1,
         'sp_id' => $sp->id,
         'type' => 'Reject',
         'level' => 'hrd',
         'desc' => $req->alasan_reject,
         'employee_id' => auth()->user()->getEmployeeId(),
      ]);

      // $employee = Employee::find(auth()->user()->getEmployeeId());
      // Log::create([
      //    'department_id' => $employee->department_id,
      //    'user_id' => auth()->user()->id,
      //    'action' => 'Reject',
      //    'desc' => 'SP ' . $sp->level . ' ' . $sp->code . ' ' . $sp->employee->nik . ' ' . $sp->employee->biodata->fullName()
      // ]);

      return  back()->with('success', 'SP successfully rejected');
   }
}
