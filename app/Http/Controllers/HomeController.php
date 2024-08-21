<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\EmployeeLeader;
use App\Models\EmployeePosition;
use App\Models\Log;
use App\Models\Pe;
use App\Models\Presence;
use App\Models\Sp;
use App\Models\Spkl;
use App\Models\Unit;
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

      // if (auth()->user()->hasRole('Manager')) {
      //    dd('Manager');
      // } else {
      //    dd('ok');
      // }

      // $contracts = Contract::get();
      // foreach($contracts as $con){
      //    $con->update([
      //       'manager_id' => null
      //    ]);
      // }

      // $employees = Employee::get();
      // foreach($employees as $emp){
      //    $emp->update([
      //       'manager_id' => null
      //    ]);
      // }

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

      // $admin->assignRole('Administratorss
      // $developer->assignRole('Administrator');

      // foreach ($users as $user) {
      //    $user->roles()->detach();
      //    $employee = Employee::where('nik', $user->username)->first();
       // $hrds = Employee::where('department_id', 8)->get();
      //    // dd($hrds);
      //    // JIKA EMPLOYEE DARI DIVISI HRD
      //    // ASSIGN 2 ROLE  (ADMINISTRATOR DAN HRD)
      //    if ($employee->department_id == 8) {
      //       // $employee->update(s[
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
      // }s

      // $contracts = Contract::get();
      // foreach ($contracts as $cont) {
      //    $cont->update([
      //       'shift_id' => 1ssss
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


      // Aktifkan sekali
      // Set Role user
      // $employees = Employee::get();
      // foreach($employees as $emp){
      //    // dd('ok');
      //    $user = User::where('username', $emp->nik)->first();
      //    if ($emp->designation_id == 1) {
      //       $user->assignRole('Manager');
      //    } elseif ($emp->designation_id == 2) {
      //       $user->assignRole('Asst. Manager');
      //    } elseif ($emp->designation_id == 3) {
      //       $user->assignRole('Supervisor');
      //    } else {
      //       $user->assignRole('Karyawan');
      //    }
      // }

      // Aktifkan sekali
      // $employees = Employee::get();
      // foreach($employees as $emp){
      //    $contract = Contract::find($emp->contract_id);
      //    $emp->update([
      //       'unit_id' => $contract->unit_id
      //    ]);
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

      // if (auth()->user()->hasRole('HRD') && auth()->user()->hasRole('Manager')) {
      //    dd('okee');
      // } else {
      //    dd('not okee');
      // }

      // dd($dates);
      // dd(auth()->user()->getEmployeeId());

      if (auth()->user()->hasRole('Administrator')) {
         $employees = Employee::get();
         $tetap = Contract::where('status', 1)->where('type', 'Tetap')->get()->count();
         $kontrak = Contract::where('status', 1)->where('type', 'Kontrak')->get()->count();
         $off = Employee::where('status', 3)->get()->count();
         // dd($tetap);
         $male = Biodata::where('gender', 'Male')->count();
         $female = Biodata::where('gender', 'Female')->count();
         $spkls = Spkl::orderBy('updated_at', 'desc')->paginate(5);
         $sps = Sp::orderBy('updated_at', 'desc')->get();
         $recentSps = Sp::orderBy('updated_at', 'desc')->paginate(5);
         $logins = Log::orderBy('created_at', 'desc')->paginate(10);
         $qpes = Pe::orderBy('updated_at', 'desc')->get();
         $recentQpes = Pe::orderBy('updated_at', 'desc')->paginate(8);

         $kontrak = Contract::where('status', 1)->where('type', 'Kontrak')->get()->count();
         $tetap = Contract::where('status', 1)->where('type', 'Tetap')->get()->count();
         $empty = Contract::where('type', null)->get()->count();
         // $empty = Contract::where('type', null)->get()->count();
         
         // Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit culpa tenetur sed
         
         return view('pages.dashboard.admin', [
            'employees' => $employees,
            'male' => $male,
            'female' => $female,
            'spkls' => $spkls,
            'sps' => $sps,
            'recentSps' => $recentSps,
            'tetap' => $tetap,
            'kontrak' => $kontrak,
            'off' => $off,
            'logins' => $logins,
            'qpes' => $qpes,
            'recentQpes' => $recentQpes,
            'kontrak' => $kontrak,
            'tetap' => $tetap,
            'empty' => $empty,
         ]);
      } elseif (auth()->user()->hasRole('HRD-Manager|HRD')) {
         $user = Employee::find(auth()->user()->getEmployeeId());
         $employees = Employee::get();
         $male = Biodata::where('gender', 'Male')->count();
         $female = Biodata::where('gender', 'Female')->count();
         $spkls = Spkl::orderBy('updated_at', 'desc')->paginate(5);
         $sps = Sp::orderBy('updated_at', 'desc')->paginate(5);
         $kontrak = Contract::where('status', 1)->where('type', 'Kontrak')->get()->count();
         $tetap = Contract::where('status', 1)->where('type', 'Tetap')->get()->count();
         $empty = Contract::where('type', null)->get()->count();
         $logs = Log::where('department_id', $user->department_id)->orderBy('created_at', 'desc')->paginate(5);
         $teams = EmployeeLeader::where('leader_id', $user->id)->get();
         // dd($teams);
         $pes = Pe::orderBy('updated_at', 'desc')->get();
         $recentPes = Pe::orderBy('updated_at', 'desc')->paginate(8);
         // dd($pes);
         return view('pages.dashboard.hrd', [
            'user' => $user,
            'employee' => $user,
            'employees' => $employees,
            'male' => $male,
            'female' => $female,
            'spkls' => $spkls,
            'sps' => $sps,
            'kontrak' => $kontrak,
            'tetap' => $tetap,
            'empty' => $empty,
            'logs' => $logs,
            'teams' => $teams,
            'pes' => $pes,
            'recentPes' => $recentPes
         ]);
      } elseif (auth()->user()->hasRole('HRD-Spv')) {
         $user = Employee::find(auth()->user()->getEmployeeId());
         $units = Unit::get()->count();
         $employees = Employee::get();
         $male = Biodata::where('gender', 'Male')->count();
         $female = Biodata::where('gender', 'Female')->count();
         $spkls = Spkl::orderBy('updated_at', 'desc')->paginate(5);
         $sps = Sp::where('status', '>' ,1)->orderBy('created_at', 'desc')->paginate('5');
         $kontrak = Contract::where('status', 1)->where('type', 'Kontrak')->get()->count();
         $tetap = Contract::where('status', 1)->where('type', 'Tetap')->get()->count();
         $empty = Contract::where('type', null)->get()->count();

         $logs = Log::where('department_id', $user->department_id)->orderBy('created_at', 'desc')->paginate(5);
         return view('pages.dashboard.hrd-spv', [
            'units' => $units,
            'employees' => $employees,
            'male' => $male,
            'female' => $female,
            'spkls' => $spkls,
            'sps' => $sps,
            'kontrak' => $kontrak,
            'tetap' => $tetap,
            'empty' => $empty,
            'logs' => $logs
         ]);
      } elseif (auth()->user()->hasRole('HRD-Recruitment')) {
         $user = Employee::find(auth()->user()->getEmployeeId());
         $units = Unit::get()->count();
         $employees = Employee::where('kpi_id', null)->get();
         $male = Biodata::where('gender', 'Male')->count();
         $female = Biodata::where('gender', 'Female')->count();
         $spkls = Spkl::orderBy('updated_at', 'desc')->paginate(5);
         $sps = Sp::where('status', 1)->get();
         $kontrak = Contract::where('status', 1)->where('type', 'Kontrak')->get()->count();
         $tetap = Contract::where('status', 1)->where('type', 'Tetap')->get()->count();
         $empty = Contract::where('type', null)->get()->count();
         return view('pages.dashboard.hrd-recruitment', [
            'units' => $units,
            'employee' => $user,
            'employees' => $employees,
            'male' => $male,
            'female' => $female,
            'spkls' => $spkls,
            'sps' => $sps,
            'kontrak' => $kontrak,
            'tetap' => $tetap,
            'empty' => $empty
         ])->with('i');
      } elseif (auth()->user()->hasRole('Manager')) {
         // dd('ok');
         $employee = Employee::where('nik', auth()->user()->username)->first();
         $biodata = Biodata::where('email', auth()->user()->email)->first();
         $presences = Presence::where('employee_id', $employee->id)->orderBy('created_at', 'desc')->get();
         $pending = Presence::where('employee_id', $employee->id)->where('out_time', null)->first();
         // dd($biodata->employee->id);

         $spkls = Spkl::where('status', 1)->orWhere('status', 2)->where('department_id', $employee->department_id)->get();
         $sps = Sp::where('status', '>', 2)->where('department_id', $employee->department_id)->orderBy('updated_at', 'desc')->paginate('5');
         // dd($spkls);

         if (count($employee->positions) > 0) {
            $teams = null;
            $pes = null;
         } else {
            if ($employee->position->sub_dept_id != null) {
               // dd('ada sub');
               $teams = Employee::where('status', 1)->where('sub_dept_id', $employee->position->sub_dept_id)->where('id', '!=', $employee->id)->get();
            } else {
               $teams = Employee::where('status', 1)->where('department_id', $employee->position->department_id)->get();
            }

            $pes = Pe::where('department_id', $employee->department_id)->where('status', '>', '0')
            ->orderBy('release_at', 'desc')
            ->get();
         }
         
         
         // dd(count($final));
         $employeePositions = $employee->positions;
         // dd($employeePositions);
         return view('pages.dashboard.manager', [
            'employee' => $biodata->employee,
            'dates' => $dates,
            'presences' => $presences,
            'pending' => $pending,
            'spkls' => $spkls,
            'sps' => $sps,
            'teams' => $teams,
            'positions' => $employeePositions,
            'pes' => $pes
         ]);
      } elseif (auth()->user()->hasRole('Supervisor|Leader')) {
         // dd('ok');
         $employee = Employee::where('nik', auth()->user()->username)->first();
         $biodata = Biodata::where('email', auth()->user()->email)->first();
         $presences = Presence::where('employee_id', $employee->id)->orderBy('created_at', 'desc')->get();
         $pending = Presence::where('employee_id', $employee->id)->where('out_time', null)->first();
         // dd($biodata->employee->id);

         $spkls = Spkl::where('status', '>=', 1)->where('department_id', $employee->department_id)->orderBy('created_at', 'desc')->paginate(5);
         // dd($spkls);
         // $teams = Employee::where('direct_leader_id', auth()->user()->getEmployeeId())->get();
         $teams = EmployeeLeader::where('leader_id', $employee->id)->get();

         $myteams = EmployeeLeader::join('employees', 'employee_leaders.employee_id', '=', 'employees.id')
               ->join('biodatas', 'employees.biodata_id', '=', 'biodatas.id')
                ->where('leader_id', $employee->id)
                ->select('employees.*')
                ->orderBy('biodatas.first_name', 'asc')
                ->get();
               //  dd($myteams);

         // $pes = Pe::join('employees', 'pes.employe_id', '=', 'employees.id')
         // ->where('employees.id', $employee->id)
         // ->whereIn('pes.status', [2, 101, 202])
         // ->select('pes.*')
         // ->orderBy('pes.release_at', 'desc')
         // ->get();

                
         // dd($teams);
         $spRecents = Sp::where('by_id',auth()->user()->getEmployeeId())->orderBy('updated_at', 'desc')->paginate('5');
         $peRecents = Pe::where('created_by', $employee->id)->where('status', '!=', 2)->orderBy('updated_at', 'desc')->get();
         if ($employee->designation->slug == 'supervisor') {
            $peRecents = Pe::where('department_id', $employee->department_id)->where('status', '!=', 2)->orderBy('updated_at', 'desc')->get();
         } else {
            $peRecents = Pe::where('created_by', $employee->id)->where('status', '!=', 2)->orderBy('updated_at', 'desc')->paginate(10);
         }
         return view('pages.dashboard.supervisor', [
            'employee' => $biodata->employee,
            'teams' => $teams,
            'myteams' => $myteams,
            'dates' => $dates,
            'presences' => $presences,
            'pending' => $pending,

            'spkls' => $spkls,
            'spRecents' => $spRecents,
            'peRecents' => $peRecents
         ]);
      } else {


         $employee = Employee::where('nik', auth()->user()->username)->first();
         $biodata = Biodata::where('email', auth()->user()->email)->first();
         $presences = Presence::where('employee_id', auth()->user()->getEmployeeId())->orderBy('created_at', 'desc')->get();
         $pending = Presence::where('employee_id', auth()->user()->getEmployeeId())->where('out_time', null)->first();
         // dd($biodata->employee->id);

         $spkls = Spkl::where('employee_id',)->orderBy('updated_at', 'desc')->paginate(3);
         $sps = Sp::where('employee_id', auth()->user()->getEmployeeId())->where('status', 2)->get();
         $spHistories = Sp::where('employee_id', auth()->user()->getEmployeeId())->where('status', '>', 3)->get();
         // dd(auth()->user()->getEmployeeId());
         return view('pages.dashboard.employee', [
            'now' => $now,
            'employee' => $employee,
            'dates' => $dates,
            'presences' => $presences,
            'pending' => $pending,
            'spkls' => $spkls,
            'sps' => $sps,
            'spHistories' => $spHistories
         ])->with('i');
      }
   }

   // $date = \Carbon\Carbon::today()->subDays(7);
   // $users = User::where('created_at','>=',$date)->get();
}
