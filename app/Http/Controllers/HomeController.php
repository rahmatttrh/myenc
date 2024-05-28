<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Employee;
use App\Models\Presence;
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
         return view('pages.dashboard.admin', [
            'employees' => $employees,
            'male' => $male,
            'female' => $female
         ]);
      } elseif (auth()->user()->hasRole('Manager')){
         $employee = Employee::where('nik', auth()->user()->username)->first();
         $biodata = Biodata::where('email', auth()->user()->email)->first();
         $presences = Presence::where('employee_id', $employee->id)->orderBy('created_at', 'desc')->get();
         $pending = Presence::where('employee_id', $employee->id)->where('out_time', null)->first();
         // dd($biodata->employee->id);

         $spkls = Spkl::where('status', 1)->orWhere('status', 2)->where('department_id', $employee->department_id)->get();
         // dd($spkls);
         return view('pages.dashboard.manager', [
            'employee' => $biodata->employee,
            'dates' => $dates,
            'presences' => $presences,
            'pending' => $pending,

            'spkls' => $spkls
         ]);
      } elseif (auth()->user()->hasRole('Supervisor')){
         $employee = Employee::where('nik', auth()->user()->username)->first();
         $biodata = Biodata::where('email', auth()->user()->email)->first();
         $presences = Presence::where('employee_id', $employee->id)->orderBy('created_at', 'desc')->get();
         $pending = Presence::where('employee_id', $employee->id)->where('out_time', null)->first();
         // dd($biodata->employee->id);

         $spkls = Spkl::where('status', '>=', 1)->where('department_id', $employee->department_id)->paginate(10);
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
         $presences = Presence::where('employee_id', $employee->id)->orderBy('created_at', 'desc')->get();
         $pending = Presence::where('employee_id', $employee->id)->where('out_time', null)->first();
         // dd($biodata->employee->id);

         $spkls = Spkl::where('employee_id', $employee->id)->orderBy('updated_at', 'desc')->paginate(3);
         return view('pages.dashboard.employee', [
            'now' => $now,
            'employee' => $biodata->employee,
            'dates' => $dates,
            'presences' => $presences,
            'pending' => $pending,
            'spkls' => $spkls
         ]);
      }
   }

   // $date = \Carbon\Carbon::today()->subDays(7);
   // $users = User::where('created_at','>=',$date)->get();
}
