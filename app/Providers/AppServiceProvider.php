<?php

namespace App\Providers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Pe;
use App\Models\Sp;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      view()->composer(
         'layouts.header',
         function ($view) {
            

            if (auth()->user()->hasRole('HRD|HRD-Spv')) {
               $spNotifs = Sp::where('status', 1)->orderBy('updated_at', 'desc')->get();
               $peNotifs = [];
               $employee = null;
            } elseif(auth()->user()->hasRole('Manager|Asst. Manager')){
               $id = auth()->user()->getEmployeeId();
               $employee = Employee::find($id);
               $spNotifs = Sp::where('status', 3)->where('department_id', $employee->department_id)->orderBy('updated_at', 'desc')->get();
               // $peNotifs = Pe::where('status', 1)->get();
               // $department = Department::find($employee->department_id);
               $peTotal = null;
               $peNotifs = [];
               foreach($employee->positions as $pos){
                  foreach($pos->department->pes->where('status', 1) as $pe){
                     $peTotal = ++$peTotal;
                     $peNotifs[] = $pe;
                  }
               }
               // dd($peNotifs);
               // $peNotifNd = [];
               // $peNotifs = $peNotif->concat($peNotifNd);
            } elseif(auth()->user()->hasRole('Supervisor|Leader')){
               $id = auth()->user()->getEmployeeId();
               $employee = Employee::find($id);
               $spNotifNd = Sp::where('status', 101)->where('nd_for', 1)->orWhere('nd_for', 3)->where('by_id', $employee->id)->orderBy('updated_at', 'desc')->get();
               $spNotif = Sp::where('status', 2)->orWhere('status', 202)->where('by_id', $employee->id)->where('department_id', $employee->department_id)->orderBy('updated_at', 'desc')->get();
               $spNotifs = $spNotifNd->concat($spNotif);

               // $peNotif = null;
               // $department
               $peNotifs = Pe::where('status', 202)->where('created_by', $employee->id )->get();
               // $peNotifs = $peNotif->concat($peNotifNd);
               // dd($spNotifs);
            } elseif(auth()->user()->hasRole('Karyawan')){
               $id = auth()->user()->getEmployeeId();
               $employee = Employee::find($id);
               $spNotifNd = Sp::where('status', 101)->where('nd_for', 2)->orWhere('nd_for', 3)->where('employee_id', $employee->id)->orderBy('updated_at', 'desc')->get();
               $spNotif = Sp::where('status', 4)->where('employee_id', $employee->id)->orderBy('updated_at', 'desc')->get();
               $spNotifs = $spNotifNd->concat($spNotif);
               $peNotifs = Pe::where('status', 202)->where('employe_id', $id)->get();
            }  else {
               $spNotifs = [];
               $peNotifs = [];
               $employee = null;
            }
            // dd($notif);
            if (count($spNotifs) > 0) {
               $notif = true;
            } else {
               $notif = false;
            }

            $view->with([
               'employee' => $employee,
               'notifSp' => $spNotifs,
               'peNotifs' => $peNotifs,
               'notif' => $notif,

            ]);
         }
      );
    }
}
