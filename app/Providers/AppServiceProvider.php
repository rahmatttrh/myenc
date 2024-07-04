<?php

namespace App\Providers;

use App\Models\Employee;
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
               $spNotifs = Sp::where('status', 2)->where('department_id', $manager->department_id)->orderBy('updated_at', 'desc')->get();
            } elseif(auth()->user()->hasRole('Karyawan')){
               $id = auth()->user()->getEmployeeId();
               $employee = Employee::find($id);
               $spNotifs = Sp::where('status', 3)->where('employee_id', $employee->id)->orderBy('updated_at', 'desc')->get();
            } else {
               $spNotifs = [];
            }
            // dd($notif);
            if (count($spNotifs) > 0) {
               $notif = true;
            } else {
               $notif = false;
            }

            $view->with([
               'notifSp' => $spNotifs,
               'notif' => $notif,
            ]);
         }
      );
    }
}
