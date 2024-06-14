<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Presence;
use App\Models\Sp;
use App\Models\Spkl;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
      $this->middleware(['auth']);
   }

   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
   public function index()
   {

      // if (auth()->user()->assignRole('Karyawan')) {
      //    dd('karyawan');
      // } else {
      //    dd('bukan karyawan');
      // }

      // AKTIDKAN CODE DIBAWAH INI HANYA SEKALI SETELAH REFRESH DB
      // ASSIGN ROLE USER
      // $users = User::where('id', '!=', 1)->where('id', '!=', 2)->get();
      // $admin = User::where('email', 'admin@gmail.com')->first();
      // $developer = User::where('email', 'developer@gmail.com')->first();

      // $admin->assignRole('Administrator');
      // $developer->assignRole('Administrator');

      // foreach ($users as $user) {
      //    $user->roles()->detach();
      //    $employee = Employee::where('nik', $user->username)->first();

      //    // $hrds = Employee::where('department_id', 8)->get();
      //    // dd($hrds);
      //    // JIKA EMPLOYEE DARI DIVISI HRD
      //    // ASSIGN 2 ROLE  (ADMINISTRATOR DAN HRD)
      //    if ($employee->department_id == 8) {
      //       // $employee->update([
      //       //    'department_id' => 8
      //       // ]);
      //       // $user->assignRole('Administrator');
      //       $user->assignRole('HRD');
      //    } else {
      //       if ($employee->designation_id == 1 || $employee->designation_id == 2) {
      //          $user->assignRole('Karyawan');
      //       } else if ($employee->designation_id == 3) {
      //          $user->assignRole('Leader');
      //       } else if ($employee->designation_id == 4) {
      //          $user->assignRole('Supervisor');
      //       } else if ($employee->designation_id == 5) {
      //          $user->assignRole('Asst. Manager');
      //       } else if ($employee->designation_id == 6) {
      //          $user->assignRole('Manager');
      //       } else if ($employee->designation_id == 7) {
      //          $user->assignRole('BOD');
      //       }
      //    }
      // }

      // $contracts = Contract::get();
      // foreach ($contracts as $cont) {
      //    $cont->update([
      //       'shift_id' => 1
      //    ]);
      // }
      // END OF ASSIGN ROLE





      // $employee = Employee::where('nik', auth()->user()->username)->first();
      // dd($employee->id);

      // if (auth()->user()->hasRole('Administrator')) {
      //    dd('admin');
      // } else {
      //    dd('staff');
      // }



      $employeeUsers = User::where('');

      $now = Carbon::now();
      // dd($now->format('Y-m-d'));
      // dd($now->format('F'));
      $yearMonth = $now->format('Y-m');
      // dd($yearMonth);
      $start = Carbon::parse($yearMonth)->startOfMonth();
      $end = Carbon::parse($yearMonth)->endOfMonth();

      $dates = [];
      while ($start->lte($end)) {
         $dates[] = $start->copy();
         $start->addDay();
      }

      // dd($dates);

      if (auth()->user()->hasRole('Administrator')) {
         $employees = Employee::get();
         $male = Biodata::where('gender', 'Male')->count();
         $female = Biodata::where('gender', 'Female')->count();
         $spkls = Spkl::orderBy('updated_at', 'desc')->paginate(5);
         $sps = Sp::where('status', 2)->get();
         return view('pages.dashboard.admin', [
            'employees' => $employees,
            'male' => $male,
            'female' => $female,
            'spkls' => $spkls,
            'sps' => $sps
         ]);
      } elseif (auth()->user()->hasRole('HRD')) {
         $employees = Employee::get();
         $male = Biodata::where('gender', 'Male')->count();
         $female = Biodata::where('gender', 'Female')->count();
         $spkls = Spkl::orderBy('updated_at', 'desc')->paginate(5);
         $sps = Sp::where('status', 1)->get();
         return view('pages.dashboard.hrd', [
            'employees' => $employees,
            'male' => $male,
            'female' => $female,
            'spkls' => $spkls,
            'sps' => $sps
         ]);
      } elseif (auth()->user()->hasRole('Manager')) {
         $employee = Employee::where('nik', auth()->user()->username)->first();
         $biodata = Biodata::where('email', auth()->user()->email)->first();
         $presences = Presence::where('employee_id', $employee->id)->orderBy('created_at', 'desc')->get();
         $pending = Presence::where('employee_id', $employee->id)->where('out_time', null)->first();
         // dd($biodata->employee->id);

         $spkls = Spkl::where('status', 1)->orWhere('status', 2)->where('department_id', $employee->department_id)->get();
         $sps = Sp::where('status', 1)->where('department_id', $employee->department_id)->get();
         // dd($spkls);
         return view('pages.dashboard.manager', [
            'employee' => $biodata->employee,
            'dates' => $dates,
            'presences' => $presences,
            'pending' => $pending,

            'spkls' => $spkls,
            'sps' => $sps
         ]);
      } elseif (auth()->user()->hasRole('Supervisor')) {
         $employee = Employee::where('nik', auth()->user()->username)->first();
         $biodata = Biodata::where('email', auth()->user()->email)->first();
         $presences = Presence::where('employee_id', $employee->id)->orderBy('created_at', 'desc')->get();
         $pending = Presence::where('employee_id', $employee->id)->where('out_time', null)->first();
         // dd($biodata->employee->id);

         $spkls = Spkl::where('status', '>=', 1)->where('department_id', $employee->department_id)->orderBy('created_at', 'desc')->paginate(5);
         // dd($spkls);
         return view('pages.dashboard.supervisor', [
            'employee' => $biodata->employee,
            'dates' => $dates,
            'presences' => $presences,
            'pending' => $pending,

            'spkls' => $spkls
         ]);
      } else {


         $employee = Employee::where('nik', auth()->user()->username)->first();
         $biodata = Biodata::where('email', auth()->user()->email)->first();
         $presences = Presence::where('employee_id', auth()->user()->getEmployeeId())->orderBy('created_at', 'desc')->get();
         $pending = Presence::where('employee_id', auth()->user()->getEmployeeId())->where('out_time', null)->first();
         // dd($biodata->employee->id);

         $spkls = Spkl::where('employee_id',)->orderBy('updated_at', 'desc')->paginate(3);
         $sps = Sp::where('employee_id', auth()->user()->getEmployeeId())->where('status', 2)->get();
         // dd(auth()->user()->getEmployeeId());
         return view('pages.dashboard.employee', [
            'now' => $now,
            'employee' => $employee,
            'dates' => $dates,
            'presences' => $presences,
            'pending' => $pending,
            'spkls' => $spkls,
            'sps' => $sps
         ]);
      }
   }

   // $date = \Carbon\Carbon::today()->subDays(7);
   // $users = User::where('created_at','>=',$date)->get();
}
