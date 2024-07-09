<?php

namespace App\Providers;

use App\Models\Employee;
use App\Models\Pe;
use App\Models\Sp;
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
            } elseif(auth()->user()->hasRole('Manager')){
               $id = auth()->user()->getEmployeeId();
               $manager = Employee::find($id);
               $spNotifs = Sp::where('status', 3)->where('department_id', $manager->department_id)->orderBy('updated_at', 'desc')->get();
               $peNotifs = Pe::where('status', 1)->get();
               // $peNotifNd = [];
               // $peNotifs = $peNotif->concat($peNotifNd);
            } elseif(auth()->user()->hasRole('Supervisor')){
               $id = auth()->user()->getEmployeeId();
               $employee = Employee::find($id);
               $spNotifNd = Sp::where('status', 101)->where('nd_for', 1)->orWhere('nd_for', 3)->where('by_id', $employee->id)->orderBy('updated_at', 'desc')->get();
               $spNotif = Sp::where('status', 2)->orWhere('status', 202)->where('by_id', $employee->id)->orderBy('updated_at', 'desc')->get();
               $spNotifs = $spNotifNd->concat($spNotif);

               // $peNotif = null;
               $peNotifs = Pe::where('status', 202)->get();
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
            }
            // dd($notif);
            if (count($spNotifs) > 0) {
               $notif = true;
            } else {
               $notif = false;
            }

            $view->with([
               'notifSp' => $spNotifs,
               'peNotifs' => $peNotifs,
               'notif' => $notif,

            ]);
         }
      );
    }
}
