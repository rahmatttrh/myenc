<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Employee;
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
      $this->middleware(['auth', 'verified']);
   }

   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
   public function index()
   {


      if (auth()->user()->hasRole('Administrator')) {
         $employees = Employee::get();
         $male = Biodata::where('gender', 'Male')->count();
         $female = Biodata::where('gender', 'Female')->count();
         return view('pages.dashboard.admin', [
            'employees' => $employees,
            'male' => $male,
            'female' => $female
         ]);
      } else {
         $biodata = Biodata::where('email', auth()->user()->email)->first();
         // dd($biodata->employee->id);
         return view('pages.dashboard.employee', [
            'employee' => $biodata->employee
         ]);
      }
   }

   // $date = \Carbon\Carbon::today()->subDays(7);
   // $users = User::where('created_at','>=',$date)->get();
}
