<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmployeeLeader;
use App\Models\Log;
use App\Models\Pe;
use App\Models\PeBehavior;
use App\Models\PeBehaviorApprasial;
use App\Models\PeBehaviorApprasialDetail;
use App\Models\PeComponent;
use App\Models\PeDiscipline;
use App\Models\PeDisciplineDetail;
use App\Models\PeKpa;
use App\Models\PekpaDetail;
use App\Models\PeKpi;
use App\Models\PekpiDetail;
use App\Models\Sp;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Round;

class QuickPEController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {

      $pes = Pe::orderBy('updated_at', 'asc')->get();
        $title = 'ALL QPE';
      // Data KPI
    //   if (auth()->user()->hasRole('Administrator')) {
      // Data KPI
      if (auth()->user()->hasRole('Administrator|HRD|HRD-Spv|HRD-Manager')) {
         $employee = null;
         $kpas = PeKpa::where('status', '!=', '0')
            ->orderBy('employe_id')
            ->get();
         $outAssesments = $this->outstandingAssessment();
         $myteams = [];
         $allpes = [];

         $total = Pe::orderBy('updated_at', 'asc')->get();
         $draft = Pe::where('status', 0)->orderBy('updated_at', 'asc')->get();
         $verification = Pe::where('status', 1)->orderBy('updated_at', 'asc')->get();
         $done = Pe::where('status', 2)->orderBy('updated_at', 'asc')->get();
         $reject = Pe::where('status', 101)->orderBy('updated_at', 'asc')->get();
      } else if (auth()->user()->hasRole('HRD|HRD-Spv|HRD-Manager')) {
         // dd('ok');
         $employee = auth()->user()->getEmployee();
         // $kpas = PeKpa::where('status', '!=', '0')
         //     ->orderBy('employe_id')
         //     ->get();

         $pes = Pe::orderBy('updated_at', 'desc')
            ->get();

         $outAssesments = $this->outstandingAssessment();

            $myteams = [];
            $allpes = [];
            $total = Pe::orderBy('updated_at', 'asc')->get();
         $draft = Pe::where('status', 0)->orderBy('updated_at', 'asc')->get();
         $verification = Pe::where('status', 1)->orderBy('updated_at', 'asc')->get();
         $done = Pe::where('status', 2)->orderBy('updated_at', 'asc')->get();
         $reject = Pe::where('status', 101)->orderBy('updated_at', 'asc')->get();
        }  else if (auth()->user()->hasRole('Manager|Asst. Manager')) {
        //  dd('ok');
         $employee = auth()->user()->getEmployee();
         // $pes = Pe::join('employees', 'pes.employe_id', '=', 'employees.id')
         //     ->where('employees.manager_id', $employee->id)
         //     ->where('pes.status', '>', '0')
         //     ->select('pes.*')
         //     ->orderBy('pes.release_at', 'desc')
         //     ->get(); 

         $pes = Pe::where('department_id', $employee->department_id)->where('pes.status', '>=', '0')
            ->orderBy('release_at', 'desc')
            ->get();
       

         //  $pes = Pe::where('pes.status', '>', '0')
         //  ->orderBy('updated_at', 'desc')
         //  ->get();

         // 
         $outAssesments = $this->outstandingAssessment($employee->department_id);
         $myteams = [];
         $allpes = [];
         $total = [];
         $draft = [];
         $verification = [];
         $done = [];
         $reject = [];
      } else if (auth()->user()->hasRole('Leader|Supervisor')) {
        
         $employee = auth()->user()->getEmployee();
         $myteams = EmployeeLeader::join('employees', 'employee_leaders.employee_id', '=', 'employees.id')
               ->join('biodatas', 'employees.biodata_id', '=', 'biodatas.id')
                ->where('leader_id', $employee->id)
                ->select('employees.*')
                ->orderBy('biodatas.first_name', 'asc')
                ->get();
            $allpes = Pe::orderBy('updated_at', 'desc')->get();
         
            // dd($myteams);
            if (auth()->user()->hasRole('Supervisor')) {
               $pes = Pe::where('department_id', $employee->department_id)->orderBy('updated_at', 'desc')->get();
            } else {
                // dd('ok');
               $pes = Pe::where('created_by', $employee->id)->orderBy('updated_at', 'desc')->get();
                // dd($pes);
            }
            
            // dd(count($pes));



         // 
         $outAssesments = $this->outstandingAssessment($employee->department_id);
         $total = [];
         $draft = [];
         $verification = [];
         $done = [];
         $reject = [];
      } else if (auth()->user()->hasRole('Karyawan')) {
        $employee = auth()->user()->getEmployee();

        $pes = Pe::join('employees', 'pes.employe_id', '=', 'employees.id')
           ->where('employees.id', $employee->id)
           ->whereIn('pes.status', [2, 101, 202])
           ->select('pes.*')
           ->orderBy('pes.release_at', 'desc')
           ->get();
         $outAssesments = $this->outstandingAssessment($employee->department_id);
         $myteams = [];
         $allpes = [];
         $total = [];
         $draft = [];
         $verification = [];
         $done = [];
         $reject = [];
      } 

        // dd($pes);


      return view('pages.qpe.qpe', [
         // 'kpas' => $kpas,
         'title' => $title,
         'employee' => $employee,
         'pes' => $pes,
         'allpes' => $allpes,
         'myteams' => $myteams,
         'outAssesments' =>  $outAssesments,

         'total' => $total,
         'draft' => $draft,
         'verification' => $verification,
         'done' => $done,
         'reject' => $reject
      ])->with('i');
   }

   public function draft()
   {

      $pes = Pe::where('status', 0)->orderBy('updated_at', 'asc')->get();
      $total = [];
        $title = 'DRAFT QPE';
      // Data KPI
    //   if (auth()->user()->hasRole('Administrator')) {
      // Data KPI
      if (auth()->user()->hasRole('Administrator|HRD|HRD-Spv|HRD-Manager')) {
         $employee = null;
         $kpas = PeKpa::where('status', '!=', '0')
            ->orderBy('employe_id')
            ->get();
         $outAssesments = $this->outstandingAssessment();
         $myteams = [];
         $allpes = [];

         $total = Pe::orderBy('updated_at', 'asc')->get();
         $draft = Pe::where('status', 0)->orderBy('updated_at', 'asc')->get();
         $verification = Pe::where('status', 1)->orderBy('updated_at', 'asc')->get();
         $done = Pe::where('status', 2)->orderBy('updated_at', 'asc')->get();
         $reject = Pe::where('status', 101)->orderBy('updated_at', 'asc')->get();
      } else if (auth()->user()->hasRole('HRD|HRD-Spv|HRD-Manager')) {
         // dd('ok');
         $employee = auth()->user()->getEmployee();
         // $kpas = PeKpa::where('status', '!=', '0')
         //     ->orderBy('employe_id')
         //     ->get();

         $pes = Pe::where('status', 0)->orderBy('updated_at', 'desc')
            ->get();

         $outAssesments = $this->outstandingAssessment();

            $myteams = [];
            $allpes = [];
            
         $total = Pe::orderBy('updated_at', 'asc')->get();
         $draft = Pe::where('status', 0)->orderBy('updated_at', 'asc')->get();
         $verification = Pe::where('status', 1)->orderBy('updated_at', 'asc')->get();
         $done = Pe::where('status', 2)->orderBy('updated_at', 'asc')->get();
         $reject = Pe::where('status', 101)->orderBy('updated_at', 'asc')->get();
        } else if (auth()->user()->hasRole('Manager|Asst. Manager')) {
            //  dd('ok');
         $employee = auth()->user()->getEmployee();
         // $kpas = PeKpa::where('status', '!=', '0')
         //     ->orderBy('employe_id')
         //     ->get();

         $pes = Pe::where('status', 0)->orderBy('updated_at', 'desc')
            ->get();

         $outAssesments = $this->outstandingAssessment();

         $myteams = [];
         $allpes = [];
         $total = [];
         $draft = [];
         $verification = [];
         $done = [];
         $reject = [];
      } else if (auth()->user()->hasRole('Manager|Asst. Manager')) {
        //  dd('ok');
         $employee = auth()->user()->getEmployee();
         // $pes = Pe::join('employees', 'pes.employe_id', '=', 'employees.id')
         //     ->where('employees.manager_id', $employee->id)
         //     ->where('pes.status', '>', '0')
         //     ->select('pes.*')
         //     ->orderBy('pes.release_at', 'desc')
         //     ->get(); 

         $pes = Pe::where('status', 0)->where('department_id', $employee->department_id)->where('pes.status', '>=', '0')
            ->orderBy('release_at', 'desc')
            ->get();
       

         //  $pes = Pe::where('pes.status', '>', '0')
         //  ->orderBy('updated_at', 'desc')
         //  ->get();

         // 
         $outAssesments = $this->outstandingAssessment($employee->department_id);
         $myteams = [];
         $allpes = [];
         $total = [];
         $draft = [];
         $verification = [];
         $done = [];
         $reject = [];
      } else if (auth()->user()->hasRole('Leader|Supervisor')) {
        
         $employee = auth()->user()->getEmployee();
         $myteams = EmployeeLeader::join('employees', 'employee_leaders.employee_id', '=', 'employees.id')
               ->join('biodatas', 'employees.biodata_id', '=', 'biodatas.id')
                ->where('leader_id', $employee->id)
                ->select('employees.*')
                ->orderBy('biodatas.first_name', 'asc')
                ->get();
            $allpes = Pe::orderBy('updated_at', 'desc')->get();
         
            // dd($myteams);
            if (auth()->user()->hasRole('Supervisor')) {
               $pes = Pe::where('status', 0)->where('department_id', $employee->department_id)->orderBy('updated_at', 'desc')->get();
            } else {
                // dd('ok');
               $pes = Pe::where('status', 0)->where('created_by', $employee->id)->orderBy('updated_at', 'desc')->get();
                // dd($pes);
            }
            
            // dd(count($pes));



         // 
         $outAssesments = $this->outstandingAssessment($employee->department_id);
         $total = [];
         $draft = [];
         $verification = [];
         $done = [];
         $reject = [];
      } else if (auth()->user()->hasRole('Karyawan')) {
        $employee = auth()->user()->getEmployee();

        $pes = Pe::join('employees', 'pes.employe_id', '=', 'employees.id')
           ->where('employees.id', $employee->id)
           ->whereIn('pes.status', [2, 101, 202])
           ->select('pes.*')
           ->where('status', 0)->orderBy('pes.release_at', 'desc')
           ->get();
         $outAssesments = $this->outstandingAssessment($employee->department_id);
         $myteams = [];
         $allpes = [];
         $total = [];
         $draft = [];
         $verification = [];
         $done = [];
         $reject = [];
      } 

        // dd($pes);


      return view('pages.qpe.qpe', [
         // 'kpas' => $kpas,
         'title' => $title,
         'employee' => $employee,
         'pes' => $pes,
         'allpes' => $allpes,
         'myteams' => $myteams,
         'outAssesments' =>  $outAssesments,

         'total' => $total,
         'draft' => $draft,
         'verification' => $verification,
         'done' => $done,
         'reject' => $reject
      ])->with('i');
   }

   public function delete($id){
      // dd('ok');

      $pe = Pe::find(dekripRambo($id));
      $peKpa = PeKpa::where('pe_id', $pe->id)->first();
      if ($peKpa) {
         $peKpaDetails = PekpaDetail::where('kpa_id', $peKpa->id)->get();
         foreach($peKpaDetails as $pkd){
            $pkd->delete();
         }
         $peKpa->delete();
      }
      

      $peDiscipline = PeDiscipline::where('pe_id', $pe->id)->first();
      if ($peDiscipline) {
         $peDisciplineDetails = PeDisciplineDetail::where('pd_id', $peDiscipline->id)->get();
         foreach($peDisciplineDetails as $pdd){
            $pdd->delete();
         }
         $peDiscipline->delete();
      }
      

      $peBehaviorApprasial = PeBehaviorApprasial::where('pe_id', $pe->id)->first();
      if ($peBehaviorApprasial) {
         $peBehaviorApprasialDetails = PeBehaviorApprasialDetail::where('pba_id', $peBehaviorApprasial->id)->get();
         foreach($peBehaviorApprasialDetails as $pbad){
            $pbad->delete();
         }
         $peBehaviorApprasial->delete();
      }
      
      $pe->delete();
      return redirect()->back()->with('success', 'QPE successfully deleted');
   }

   public function verification()
   {

      $pes = Pe::where('status', 1)->orderBy('updated_at', 'asc')->get();
        $title = 'VERIFICATION QPE';
      // Data KPI
    //   if (auth()->user()->hasRole('Administrator')) {
      // Data KPI
      if (auth()->user()->hasRole('Administrator')) {
         $employee = null;
         $kpas = PeKpa::where('status', '!=', '0')
            ->orderBy('employe_id')
            ->get();
         $outAssesments = $this->outstandingAssessment();
         $myteams = [];
         $allpes = [];

         $total = Pe::orderBy('updated_at', 'asc')->get();
         $draft = Pe::where('status', 0)->orderBy('updated_at', 'asc')->get();
         $verification = Pe::where('status', 1)->orderBy('updated_at', 'asc')->get();
         $done = Pe::where('status', 2)->orderBy('updated_at', 'asc')->get();
         $reject = Pe::where('status', 101)->orderBy('updated_at', 'asc')->get();
      } else if (auth()->user()->hasRole('HRD|HRD-Spv|HRD-Manager')) {
         // dd('ok');
         $employee = auth()->user()->getEmployee();
         // $kpas = PeKpa::where('status', '!=', '0')
         //     ->orderBy('employe_id')
         //     ->get();

         $pes = Pe::where('status', 1)->orderBy('updated_at', 'desc')
            ->get();

         $outAssesments = $this->outstandingAssessment();

            $myteams = [];
            $allpes = [];
            
         $total = Pe::orderBy('updated_at', 'asc')->get();
         $draft = Pe::where('status', 0)->orderBy('updated_at', 'asc')->get();
         $verification = Pe::where('status', 1)->orderBy('updated_at', 'asc')->get();
         $done = Pe::where('status', 2)->orderBy('updated_at', 'asc')->get();
         $reject = Pe::where('status', 101)->orderBy('updated_at', 'asc')->get();
        } else if (auth()->user()->hasRole('Manager|Asst. Manager')) {
            //  dd('ok');
         $employee = auth()->user()->getEmployee();
         // $kpas = PeKpa::where('status', '!=', '0')
         //     ->orderBy('employe_id')
         //     ->get();

         $pes = Pe::where('status', 1)->orderBy('updated_at', 'desc')
            ->get();

         $outAssesments = $this->outstandingAssessment();

         $myteams = [];
         $allpes = [];
         $total = [];
         $draft = [];
         $verification = [];
         $done = [];
         $reject = [];
      } else if (auth()->user()->hasRole('Manager|Asst. Manager')) {
        //  dd('ok');
         $employee = auth()->user()->getEmployee();
         // $pes = Pe::join('employees', 'pes.employe_id', '=', 'employees.id')
         //     ->where('employees.manager_id', $employee->id)
         //     ->where('pes.status', '>', '0')
         //     ->select('pes.*')
         //     ->orderBy('pes.release_at', 'desc')
         //     ->get(); 

         $pes = Pe::where('status', 1)->where('department_id', $employee->department_id)->where('pes.status', '>=', '0')
            ->orderBy('release_at', 'desc')
            ->get();
       

         //  $pes = Pe::where('pes.status', '>', '0')
         //  ->orderBy('updated_at', 'desc')
         //  ->get();

         // 
         $outAssesments = $this->outstandingAssessment($employee->department_id);
         $myteams = [];
         $allpes = [];
         $total = [];
         $draft = [];
         $verification = [];
         $done = [];
         $reject = [];
      } else if (auth()->user()->hasRole('Leader|Supervisor')) {
        
         $employee = auth()->user()->getEmployee();
         $myteams = EmployeeLeader::join('employees', 'employee_leaders.employee_id', '=', 'employees.id')
               ->join('biodatas', 'employees.biodata_id', '=', 'biodatas.id')
                ->where('leader_id', $employee->id)
                ->select('employees.*')
                ->orderBy('biodatas.first_name', 'asc')
                ->get();
            $allpes = Pe::orderBy('updated_at', 'desc')->get();
         
            // dd($myteams);
            if (auth()->user()->hasRole('Supervisor')) {
               $pes = Pe::where('status', 1)->where('department_id', $employee->department_id)->orderBy('updated_at', 'desc')->get();
            } else {
                // dd('ok');
               $pes = Pe::where('status', 1)->where('created_by', $employee->id)->orderBy('updated_at', 'desc')->get();
                // dd($pes);
            }
            
            // dd(count($pes));



         // 
         $outAssesments = $this->outstandingAssessment($employee->department_id);
         $total = [];
         $draft = [];
         $verification = [];
         $done = [];
         $reject = [];
      } else if (auth()->user()->hasRole('Karyawan')) {
        $employee = auth()->user()->getEmployee();

        $pes = Pe::join('employees', 'pes.employe_id', '=', 'employees.id')
           ->where('employees.id', $employee->id)
           ->whereIn('pes.status', [2, 101, 202])
           ->select('pes.*')
           ->where('status', 1)->orderBy('pes.release_at', 'desc')
           ->get();
         $outAssesments = $this->outstandingAssessment($employee->department_id);
         $myteams = [];
         $allpes = [];
         $total = [];
         $draft = [];
         $verification = [];
         $done = [];
         $reject = [];
      } 

        // dd($pes);


      return view('pages.qpe.qpe', [
         // 'kpas' => $kpas,
         'title' => $title,
         'employee' => $employee,
         'pes' => $pes,
         'allpes' => $allpes,
         'myteams' => $myteams,
         'outAssesments' =>  $outAssesments,

         'total' => $total,
         'draft' => $draft,
         'verification' => $verification,
         'done' => $done,
         'reject' => $reject
      ])->with('i');
   }

   public function done()
   {

      $pes = Pe::where('status', 2)->orderBy('updated_at', 'asc')->get();
        $title = 'COMPLETE QPE';
      // Data KPI
    //   if (auth()->user()->hasRole('Administrator')) {
      // Data KPI
      if (auth()->user()->hasRole('Administrator')) {
         $employee = null;
         $kpas = PeKpa::where('status', '!=', '0')
            ->orderBy('employe_id')
            ->get();
         $outAssesments = $this->outstandingAssessment();
         $myteams = [];
         $allpes = [];

         $total = Pe::orderBy('updated_at', 'asc')->get();
         $draft = Pe::where('status', 0)->orderBy('updated_at', 'asc')->get();
         $verification = Pe::where('status', 1)->orderBy('updated_at', 'asc')->get();
         $done = Pe::where('status', 2)->orderBy('updated_at', 'asc')->get();
         $reject = Pe::where('status', 101)->orderBy('updated_at', 'asc')->get();
      } else if (auth()->user()->hasRole('HRD|HRD-Spv|HRD-Manager')) {
         // dd('ok');
         $employee = auth()->user()->getEmployee();
         // $kpas = PeKpa::where('status', '!=', '0')
         //     ->orderBy('employe_id')
         //     ->get();

         $pes = Pe::where('status', 2)->orderBy('updated_at', 'desc')
            ->get();

         $outAssesments = $this->outstandingAssessment();

            $myteams = [];
            $allpes = [];
            
         $total = Pe::orderBy('updated_at', 'asc')->get();
         $draft = Pe::where('status', 0)->orderBy('updated_at', 'asc')->get();
         $verification = Pe::where('status', 1)->orderBy('updated_at', 'asc')->get();
         $done = Pe::where('status', 2)->orderBy('updated_at', 'asc')->get();
         $reject = Pe::where('status', 101)->orderBy('updated_at', 'asc')->get();
        } else if (auth()->user()->hasRole('Manager|Asst. Manager')) {
            //  dd('ok');
         $employee = auth()->user()->getEmployee();
         // $kpas = PeKpa::where('status', '!=', '0')
         //     ->orderBy('employe_id')
         //     ->get();

         $pes = Pe::where('status', 2)->orderBy('updated_at', 'desc')
            ->get();

         $outAssesments = $this->outstandingAssessment();

         $myteams = [];
         $allpes = [];
         $total = [];
         $draft = [];
         $verification = [];
         $done = [];
         $reject = [];
      } else if (auth()->user()->hasRole('Manager|Asst. Manager')) {
        //  dd('ok');
         $employee = auth()->user()->getEmployee();
         // $pes = Pe::join('employees', 'pes.employe_id', '=', 'employees.id')
         //     ->where('employees.manager_id', $employee->id)
         //     ->where('pes.status', '>', '0')
         //     ->select('pes.*')
         //     ->orderBy('pes.release_at', 'desc')
         //     ->get(); 

         $pes = Pe::where('status', 2)->where('department_id', $employee->department_id)->where('pes.status', '>=', '0')
            ->orderBy('release_at', 'desc')
            ->get();
       

         //  $pes = Pe::where('pes.status', '>', '0')
         //  ->orderBy('updated_at', 'desc')
         //  ->get();

         // 
         $outAssesments = $this->outstandingAssessment($employee->department_id);
         $myteams = [];
         $allpes = [];
         $total = [];
         $draft = [];
         $verification = [];
         $done = [];
         $reject = [];
      } else if (auth()->user()->hasRole('Leader|Supervisor')) {
        
         $employee = auth()->user()->getEmployee();
         $myteams = EmployeeLeader::join('employees', 'employee_leaders.employee_id', '=', 'employees.id')
               ->join('biodatas', 'employees.biodata_id', '=', 'biodatas.id')
                ->where('leader_id', $employee->id)
                ->select('employees.*')
                ->orderBy('biodatas.first_name', 'asc')
                ->get();
            $allpes = Pe::orderBy('updated_at', 'desc')->get();
         
            // dd($myteams);
            if (auth()->user()->hasRole('Supervisor')) {
               $pes = Pe::where('status', 2)->where('department_id', $employee->department_id)->orderBy('updated_at', 'desc')->get();
            } else {
                // dd('ok');
               $pes = Pe::where('status', 2)->where('created_by', $employee->id)->orderBy('updated_at', 'desc')->get();
                // dd($pes);
            }
            
            // dd(count($pes));



         // 
         $outAssesments = $this->outstandingAssessment($employee->department_id);
         $total = [];
         $draft = [];
         $verification = [];
         $done = [];
         $reject = [];
      } else if (auth()->user()->hasRole('Karyawan')) {
        $employee = auth()->user()->getEmployee();

        $pes = Pe::join('employees', 'pes.employe_id', '=', 'employees.id')
           ->where('employees.id', $employee->id)
           ->whereIn('pes.status', [2, 101, 202])
           ->select('pes.*')
           ->where('status', 2)->orderBy('pes.release_at', 'desc')
           ->get();
         $outAssesments = $this->outstandingAssessment($employee->department_id);
         $myteams = [];
         $allpes = [];
         $total = [];
         $draft = [];
         $verification = [];
         $done = [];
         $reject = [];
      } 

        // dd($pes);


      return view('pages.qpe.qpe', [
         // 'kpas' => $kpas,
         'title' => $title,
         'employee' => $employee,
         'pes' => $pes,
         'allpes' => $allpes,
         'myteams' => $myteams,
         'outAssesments' =>  $outAssesments,

         'total' => $total,
         'draft' => $draft,
         'verification' => $verification,
         'done' => $done,
         'reject' => $reject
      ])->with('i');
   }

   public function reject()
   {

      $pes = Pe::where('status', 101)->orderBy('updated_at', 'asc')->get();
        $title = 'REJECT QPE';
      // Data KPI
    //   if (auth()->user()->hasRole('Administrator')) {
      // Data KPI
      if (auth()->user()->hasRole('Administrator')) {
         $employee = null;
         $kpas = PeKpa::where('status', '!=', '0')
            ->orderBy('employe_id')
            ->get();
         $outAssesments = $this->outstandingAssessment();
         $myteams = [];
         $allpes = [];

         $total = Pe::orderBy('updated_at', 'asc')->get();
         $draft = Pe::where('status', 0)->orderBy('updated_at', 'asc')->get();
         $verification = Pe::where('status', 1)->orderBy('updated_at', 'asc')->get();
         $done = Pe::where('status', 2)->orderBy('updated_at', 'asc')->get();
         $reject = Pe::where('status', 101)->orderBy('updated_at', 'asc')->get();
      } else if (auth()->user()->hasRole('HRD|HRD-Spv|HRD-Manager')) {
         // dd('ok');
         $employee = auth()->user()->getEmployee();
         // $kpas = PeKpa::where('status', '!=', '0')
         //     ->orderBy('employe_id')
         //     ->get();

         $pes = Pe::where('status', 101)->orderBy('updated_at', 'desc')
            ->get();

         $outAssesments = $this->outstandingAssessment();

            $myteams = [];
            $allpes = [];
            
         $total = Pe::orderBy('updated_at', 'asc')->get();
         $draft = Pe::where('status', 0)->orderBy('updated_at', 'asc')->get();
         $verification = Pe::where('status', 1)->orderBy('updated_at', 'asc')->get();
         $done = Pe::where('status', 2)->orderBy('updated_at', 'asc')->get();
         $reject = Pe::where('status', 101)->orderBy('updated_at', 'asc')->get();
        } else if (auth()->user()->hasRole('Manager|Asst. Manager')) {
            //  dd('ok');
         $employee = auth()->user()->getEmployee();
         // $kpas = PeKpa::where('status', '!=', '0')
         //     ->orderBy('employe_id')
         //     ->get();

         $pes = Pe::where('status', 101)->orderBy('updated_at', 'desc')
            ->get();

         $outAssesments = $this->outstandingAssessment();

         $myteams = [];
         $allpes = [];
         $total = [];
         $draft = [];
         $verification = [];
         $done = [];
         $reject = [];
      } else if (auth()->user()->hasRole('Manager|Asst. Manager')) {
        //  dd('ok');
         $employee = auth()->user()->getEmployee();
         // $pes = Pe::join('employees', 'pes.employe_id', '=', 'employees.id')
         //     ->where('employees.manager_id', $employee->id)
         //     ->where('pes.status', '>', '0')
         //     ->select('pes.*')
         //     ->orderBy('pes.release_at', 'desc')
         //     ->get(); 

         $pes = Pe::where('status', 101)->where('department_id', $employee->department_id)->where('pes.status', '>=', '0')
            ->orderBy('release_at', 'desc')
            ->get();
       

         //  $pes = Pe::where('pes.status', '>', '0')
         //  ->orderBy('updated_at', 'desc')
         //  ->get();

         // 
         $outAssesments = $this->outstandingAssessment($employee->department_id);
         $myteams = [];
         $allpes = [];
         $total = [];
         $draft = [];
         $verification = [];
         $done = [];
         $reject = [];
      } else if (auth()->user()->hasRole('Leader|Supervisor')) {
        
         $employee = auth()->user()->getEmployee();
         $myteams = EmployeeLeader::join('employees', 'employee_leaders.employee_id', '=', 'employees.id')
               ->join('biodatas', 'employees.biodata_id', '=', 'biodatas.id')
                ->where('leader_id', $employee->id)
                ->select('employees.*')
                ->orderBy('biodatas.first_name', 'asc')
                ->get();
            $allpes = Pe::orderBy('updated_at', 'desc')->get();
         
            // dd($myteams);
            if (auth()->user()->hasRole('Supervisor')) {
               $pes = Pe::where('status', 101)->where('department_id', $employee->department_id)->orderBy('updated_at', 'desc')->get();
            } else {
                // dd('ok');
               $pes = Pe::where('status', 101)->where('created_by', $employee->id)->orderBy('updated_at', 'desc')->get();
                // dd($pes);
            }
            
            // dd(count($pes));



         // 
         $outAssesments = $this->outstandingAssessment($employee->department_id);
         $total = [];
         $draft = [];
         $verification = [];
         $done = [];
         $reject = [];
      } else if (auth()->user()->hasRole('Karyawan')) {
        $employee = auth()->user()->getEmployee();

        $pes = Pe::join('employees', 'pes.employe_id', '=', 'employees.id')
           ->where('employees.id', $employee->id)
           ->whereIn('pes.status', [2, 101, 202])
           ->select('pes.*')
           ->where('status', 101)->orderBy('pes.release_at', 'desc')
           ->get();
         $outAssesments = $this->outstandingAssessment($employee->department_id);
         $myteams = [];
         $allpes = [];
         $total = [];
         $draft = [];
         $verification = [];
         $done = [];
         $reject = [];
      } 

        // dd($pes);


      return view('pages.qpe.qpe', [
         // 'kpas' => $kpas,
         'title' => $title,
         'employee' => $employee,
         'pes' => $pes,
         'allpes' => $allpes,
         'myteams' => $myteams,
         'outAssesments' =>  $outAssesments,

         'total' => $total,
         'draft' => $draft,
         'verification' => $verification,
         'done' => $done,
         'reject' => $reject
      ])->with('i');
   }

   

   public function create()
   {

      // Menggunakan request() helper
      $fullUrl = request()->fullUrl();

      $empId  = NULL;

      if (isset($_GET['empId'])) {
         # code...
         $empId = $_GET['empId'];
      }

      
      // Data KPI
      if (auth()->user()->hasRole('Administrator')) {
         $kpas = PeKpa::orderBy('date', 'desc')
            ->where('status', '!=', '0')
            ->orderBy('employe_id')
            ->get();


         $employes = Employee::where('status', '1')
            ->whereNotNull('kpi_id')
            ->get();

         $outAssesments = $this->outstandingAssessment();

         // 
      } else if (auth()->user()->hasRole('Manager|Asst. Manager')) {
         $employee = auth()->user()->getEmployee();
         $kpas = DB::table('pe_kpas')
            ->join('pe_kpis', 'pe_kpas.kpi_id', '=', 'pe_kpis.id')
            ->where('pe_kpis.departement_id', $employee->department_id)
            ->select('pe_kpas.*')
            ->orderBy('pe_kpas.date', 'desc')
            ->orderBy('pe_kpas.status', 'asc')
            ->get();

         // Convert the query builder result to Order model instances
         $kpas = PeKpa::hydrate($kpas->toArray());

         // $employes = Employee::where('department_id', $employee->department_id)
         //     ->where('status', '1')
         //     ->whereNotNull('kpi_id')
         //     ->get();
         $employes = [];
         if (count($employee->positions) > 0) {
            foreach ($employee->positions as $pos) {
               foreach ($pos->department->employees as $emp) {
                  $employes[] = $emp;
               }
            }
         } else {
            $employes = Employee::where('department_id', $employee->department_id)
               ->where('status', '1')
               ->whereNotNull('kpi_id')
               ->get();
         }

         // $employes = Employee::where('department_id', $employee->department_id)
         //     ->where('status', '1')
         //     ->whereNotNull('kpi_id')
         //     ->get();
         $employes = [];
         if (count($employee->positions) > 0) {
            foreach ($employee->positions as $pos) {
               foreach ($pos->department->employees as $emp) {
                  $employes[] = $emp;
               }
            }
         } else {
            $employes = Employee::where('department_id', $employee->department_id)
               ->where('status', '1')
               ->whereNotNull('kpi_id')
               ->get();
         }


         // $employes = EmployeeLeader::where('leader_id', $employee->id)->get();
         // 
         $outAssesments = $this->outstandingAssessment($employee->department_id);
         // 
      }  else if (auth()->user()->hasRole('Leader|Supervisor')) {
         $employee = auth()->user()->getEmployee();
         $kpas = DB::table('pe_kpas')
            ->join('pe_kpis', 'pe_kpas.kpi_id', '=', 'pe_kpis.id')
            ->where('pe_kpis.departement_id', $employee->department_id)
            ->select('pe_kpas.*')
            ->orderBy('pe_kpas.date', 'desc')
            ->orderBy('pe_kpas.status', 'asc')
            ->get();

         // Convert the query builder result to Order model instances
         $kpas = PeKpa::hydrate($kpas->toArray());
         
         $employes = EmployeeLeader::where('leader_id', $employee->id)->get();
         // $employes[] = $employ
         // 

         $outAssesments = $this->outstandingAssessment($employee->department_id);
         // 
      }
        
      // Berikut Behavior  Staff
      $behaviors = PeBehavior::where('level', 's')->get();

      $designations = Designation::orderBy('name')->get();
      $departements = Department::orderBy('name')->get();


      return view('pages.qpe.qpe-create', [
         'employee' => $employee,
         'designations' => $designations,
         'departements' => $departements,
         'kpas' => $kpas,
         'employes' => $employes,
         'behaviors' => $behaviors,
         'empId' => 'empId',
         'outAssesments' =>  $outAssesments
      ])->with('i');
   }


   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */


   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   // Store Apprasial
  
   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   // Store Apprasial
   public function store(Request $req)
   {
      // Validasi input
      $req->validate([
         'kpi_id' => 'required',
         'employe_id' => 'required',
         'semester' => 'required',
         'tahun' => 'required',
         'date' => 'required'
      ]);
      $leader = Employee::where('nik', auth()->user()->username)->first();

      // Memeriksa apakah PE untuk karyawan pada semester dan tahun tertentu sudah ada
      $cek = Pe::where([
         'employe_id' => $req->employe_id,
         'semester' => $req->semester,
         'tahun' => $req->tahun
      ])->first();

      if ($cek) {
         return redirect()->back()->with('danger', 'PE Karyawan di semester dan tahun tersebut sudah ada');
      }

      // Memulai transaksi database
      DB::beginTransaction();
      
      try {
         // Mencari data karyawan
         $employe = Employee::find($req->employe_id);

         // Memanggil fungsi dari controller lain untuk mendapatkan weight KPI
         $pcc = new PeComponentController();
         $weight = $pcc->getWeightKpi($employe->contract->designation->id);

        
         // Menyisipkan data PE baru ke database
         $pe = Pe::create([
            'department_id' => $employe->department_id,
            'sub_dept_id' => $employe->sub_dept_id,
            'employe_id' => $req->employe_id,
            'date' => $req->date,
            'is_semester' => '1',
            'semester' => $req->semester,
            'tahun' => $req->tahun,
            'created_by' => $leader->id,
            'created_at' => NOW(),
            'updated_at' => NOW()
         ]);

         // Menyisipkan data KPA baru ke database
         $kpa = PeKpa::create([
            'pe_id' => $pe->id,
            'kpi_id' => $req->kpi_id,
            'employe_id' => $req->employe_id,
            'date' => $req->date,
            'is_semester' => '1',
            'semester' => $req->semester,
            'tahun' => $req->tahun,
            'weight' => $weight
         ]);

         // Mengenkripsi ID KPA untuk digunakan dalam URL
         $kpaId = enkripRambo($kpa->id);

         // Menyisipkan detail KPI ke database
         $arrays = $req->qty;
         foreach ($arrays as $kpidetail_id => $value) {
            if (isset($req->attachment[$kpidetail_id])) {
               // Menyimpan file lampiran jika ada
               $pdfFile = $req->attachment[$kpidetail_id];
               $pdfFileName = time() . '_' . $kpidetail_id . '.pdf';
               $pdfFile->storeAs('kpa-evidence', $pdfFileName, 'public');
               $evidence = 'kpa-evidence/' . $pdfFileName;
            } else {
               $evidence = null;
            }

             // Mendapatkan detail KPI
            $kpiDetail = PekpiDetail::find($kpidetail_id);
            // Menghitung pencapaian
            $achievement = round(($value / $kpiDetail->target) * $kpiDetail->weight);

            // Menyisipkan detail KPA ke database
            $kpaDetail = PekpaDetail::create([
               'kpa_id' => $kpa->id,
               'kpidetail_id' => $kpidetail_id,
               'value' => $value,
               'achievement' => $achievement,
               'evidence' => $evidence
            ]);
         }
            

         // Menghitung ulang pencapaian KPA
         $this->calculateAcvKpa($kpa->id);

         // Menghitung ulang pencapaian PE
         $this->calculatePe($pe->id);

         // Mengonfirmasi transaksi
         DB::commit();

         // if (auth()->user()->hasRole('Administrator')) {
         //    $departmentId = null;
         // } else {
         //    $user = Employee::find(auth()->user()->getEmployeeId());
         //    $departmentId = $user->department_id;
         // }
         Log::create([
            'department_id' => $leader->department_id,
            'user_id' => auth()->user()->id,
            'action' => 'Create',
            'desc' => 'QPE ' . $employe->nik . ' ' . $employe->biodata->fullName() . ' Semester ' . $req->semester . '/' . $req->tahun
         ]);
        

         return redirect('/qpe/edit/' . $kpaId)->with('success', 'KPI successfully added');
      } catch (\Exception $e) {
         // Membatalkan transaksi jika terjadi kesalahan
         DB::rollBack();
         return redirect()->back()->with('danger', 'An error occurred: ' . $e->getMessage());
      }
   }



   
   public function edit($id)
   {

        $kpa = PeKpa::find(dekripRambo($id));
      $datas = PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '0')->get();
      $valueAvg = ROUND(PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '0')->avg('value'), 2);

        // dd(ROUND($valueAvg, 2));
      // Additional 
      $addtional = PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '1')->first();


      $employe = Employee::where('id', $kpa->employe_id)->first();
      

      if ($employe->designation_id == 1 || $employe->designation_id == 2 ) {
        $level = 's';
        } else {
            $level = 'l';
        }

      
        // dd($level);
        //  dd($employe->biodata->fullName());


        // Berikut Behavior  Staff
        $behaviors = PeBehavior::where('level', $level)->get();
        //  dd($behaviors);


      $isDone = false;
      $isReject = false;

      
      if ($kpa->status == '2') {
         # code...

         $dataOpen = PekpaDetail::where('kpa_id', $kpa->id)->where('status', '0')->get();
         if ($dataOpen->count() == 0) {
            $dataReject = PekpaDetail::where('kpa_id', $kpa->id)->where('status', '202')->get();

            if ($dataReject->count() == 0) {
               // Valid Semua
               $isDone = true;
            } else {
               // ada yang belum valid
               $isReject = true;
            }
         }
      }
      // dd($datas);
    //         if ($dataReject->count() == 0) {
    //            // Valid Semua
    //            $isDone = true;
    //         } else {
    //            // ada yang belum valid
    //            $isReject = true;
    //         }
    //      }
    //   }
      // dd($datas);


     
      if (!isset($kpa)) {
         return back()->with('danger', 'Id KPA Anda Salah');
      }

    //   dd($kpa->pe_id);

        $pba = PeBehaviorApprasial::where('pe_id', $kpa->pe_id)->first();
        // dd($pba->id);

        if (isset($pba)) {
            $pbads = PeBehaviorApprasialDetail::where('pba_id', $pba->id)->get();
        } else {
            $pbads = null;
        }

        $pe = Pe::find($kpa->pe_id);
        $today = Carbon::now();
        $date1 = Carbon::createFromDate($pe->employe->join);
        $date2 = Carbon::createFromDate($today->format('Y'), 6, 30);
        $time = $today->diff($pe->employe->join);

        $joinMonth = $date1->diffInMonths($date2);

        $pd = PeDiscipline::where('pe_id', $kpa->pe_id)->first();


        // Fixing bug leader bobot disiplin 15
        // $pcc = new PeComponentController();
      // $weight = $pcc->getWeightDiscipline($employe->contract->designation->id);
      // dd($weight);
      // $pd->update([
      //    'weight' => $weight
      // ]);

        // dd($pba->id);
        $pe = Pe::find($kpa->pe_id);
        $this->updatePengurang($pe);
        $this->calculatePe($pe->id);
        $this->calculateAcvKpa($kpa->id);

      return view('pages.qpe.qpe-edit', [
         'kpa' => $kpa,
         'addtional' => $addtional,
         'behaviors' => $behaviors,
         'isDone' => $isDone,
         'isReject' => $isReject,
         'pd' => $pd,
         'pba' => $pba,
         'pbads' => $pbads,
         'pe' => $pe,
         'kpaAchievement' => 0,
         'pbaAchievement' => 0,
         'datas' => $datas,
         'valueAvg' => $valueAvg,
         'joinMonth' => $joinMonth
      ])->with('i');
   }


   public function approval($id)
   {

    // dd('ok');
      $kpa = PeKpa::find(dekripRambo($id));
      $datas = PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '0')->get();
      $valueAvg = ROUND(PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '0')->avg('value'), 2);

      // Additional 
      $addtional = PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '1')->first();


      $employes = Employee::where('status', '1')
         ->whereNotNull('kpi_id')
         ->get();

      // Berikut Behavior  Staff
      $behaviors = PeBehavior::where('level', 's')->get();

      if (auth()->user()->hasRole('Administrator')) {
         $user = null;
      } else {
         $user = auth()->user()->getEmployee();
      }


      $isDone = false;
      $isReject = false;

    if ($kpa->status == '2') {
         # code...

        $dataOpen = PekpaDetail::where('kpa_id', $kpa->id)->where('status', '0')->get();
        if ($dataOpen->count() == 0) {
            $dataReject = PekpaDetail::where('kpa_id', $kpa->id)->where('status', '202')->get();

            if ($dataReject->count() == 0) {
               // Valid Semua
               $isDone = true;
            } else {
               // ada yang belum valid
               $isReject = true;
            }
        }
    }
        // dd($datas);


      if (!isset($kpa)) {
         return back()->with('danger', 'Id KPA Anda Salah');
      }

      $pba = PeBehaviorApprasial::where('pe_id', $kpa->pe_id)->first();

      if (isset($pba)) {
         $pbads = PeBehaviorApprasialDetail::where('pba_id', $pba->id)->get();
      } else {
         $pbads = null;
      }

        $pe = Pe::find($kpa->pe_id);

      $pd = PeDiscipline::where('pe_id', $kpa->pe_id)->first();
    //   $this->calculatePe($pe->id);
    //   $this->calculateAcvKpa($kpa->id);

      return view('pages.qpe.qpe-approval', [
         'kpa' => $kpa,
         'addtional' => $addtional,
         'behaviors' => $behaviors,
         'isDone' => $isDone,
         'isReject' => $isReject,
         'pd' => $pd,
         'pba' => $pba,
         'pbads' => $pbads,
         'pe' => $pe,
         'kpaAchievement' => 0,
         'pbaAchievement' => 0,
         'datas' => $datas,
         'user' => $user,
         'valueAvg' => $valueAvg
      ])->with('i');
   }

//     public function storeBehavior(Request $req)
//     {

//         $req->validate([
//             'kpa_id' => 'required',
//             'employe_id' => 'required',
//             'pe_id' => 'required'
//         ]);

//         // Validasi New
//         $cek = PeBehaviorApprasial::where([
//             'pe_id' => $req->pe_id
//         ])->first();

//          $pe = Pe::find($req->pe_id);

//         if ($cek) {
//             return redirect()->back()->with('danger', 'Behavior Karyawan dengan PE tersebut sudah ada');
//         }

//         $employe = Employee::find($req->employe_id);

//         $pcc = new PeComponentController();
//         $weight = $pcc->getWeightBehavior($employe->contract->designation->id);

//         // DB::beginTransaction(); // Mulai transaksi database

//         // try {

//         $pba = PeBehaviorApprasial::create([
//             'pe_id' => $req->pe_id,
//             'weight' => $weight
//         ]);

//         $achievement = 0;

//         foreach ($req->valBehavior as $behavior_id => $value) {

//             PeBehaviorApprasialDetail::create([
//                 'pba_id' => $pba->id,
//                 'behavior_id' => $behavior_id,
//                 'value' => $value,
//                 'achievement' => $req->acvBehavior[$behavior_id]
//             ]);

//             $achievement += $req->acvBehavior[$behavior_id];
//         }

//         $this->calculateAcvBehavior($pba->id);

//         $this->calculatePe($pba->pe_id);

//         if (auth()->user()->hasRole('Administrator')) {
//             $departmentId = null;
//             } else {
//                 $user = Employee::find(auth()->user()->getEmployeeId());
//                 $departmentId = $user->department_id;
//             }
        
//       // dd($datas);


//       if (!isset($kpa)) {
//          return back()->with('danger', 'Id KPA Anda Salah');
//       }

//       $pba = PeBehaviorApprasial::where('pe_id', $kpa->pe_id)->first();

//       if (isset($pba)) {
//          $pbads = PeBehaviorApprasialDetail::where('pba_id', $pba->id)->get();
//       } else {
//          $pbads = null;
//       }

//       $pe = Pe::find($kpa->pe_id);
//       $this->calculateAcvKpa($kpa->id);
//       // Menghitung ulang pencapaian PE
//       $this->calculatePe($pe->id);


//       $pd = PeDiscipline::where('pe_id', $kpa->pe_id)->first();

//       return view('pages.qpe.qpe-approval', [
//          'kpa' => $kpa,
//          'addtional' => $addtional,
//          'behaviors' => $behaviors,
//          'isDone' => $isDone,
//          'isReject' => $isReject,
//          'pd' => $pd,
//          'pba' => $pba,
//          'pbads' => $pbads,
//          'pe' => $pe,
//          'kpaAchievement' => 0,
//          'pbaAchievement' => 0,
//          'datas' => $datas,
//          'user' => $user,
//          'valueAvg' => $valueAvg
//       ])->with('i');
//    }

   public function storeBehavior(Request $req)
   {

      $req->validate([
         'kpa_id' => 'required',
         'employe_id' => 'required',
         'pe_id' => 'required'
      ]);

      // Validasi New
      $cek = PeBehaviorApprasial::where([
         'pe_id' => $req->pe_id
      ])->first();
      $pe = Pe::find($req->pe_id);

      if ($cek) {
         // $this->updateBehavior($req, )
         return redirect()->back()->with('danger', 'Behavior Karyawan dengan PE tersebut sudah ada');
      }

      $employe = Employee::find($req->employe_id);

      $pcc = new PeComponentController();
      $weight = $pcc->getWeightBehavior($employe->contract->designation->id);

      // DB::beginTransaction(); // Mulai transaksi database
      // DB::beginTransaction(); // Mulai transaksi database

      // try {
      // try {

      
      $pba = PeBehaviorApprasial::create([
         'pe_id' => $req->pe_id,
         'weight' => $weight
      ]);

      $achievement = 0;

      foreach ($req->valBehavior as $behavior_id => $value) {
         PeBehaviorApprasialDetail::create([
            'pba_id' => $pba->id,
            'behavior_id' => $behavior_id,
            'value' => $value,
            'achievement' => $req->acvBehavior[$behavior_id]
         ]);

         $achievement += $req->acvBehavior[$behavior_id];
      }

      $this->calculateAcvBehavior($pba->id);
      $this->calculatePe($pba->pe_id);
      $pe = Pe::find($pba->pe_id);
      $this->updatePengurang($pe);

      
      if (auth()->user()->hasRole('Administrator')) {
         $departmentId = null;
      } else {
         $user = Employee::find(auth()->user()->getEmployeeId());
         $departmentId = $user->department_id;
      }
      Log::create([
         'department_id' => $departmentId,
         'user_id' => auth()->user()->id,
         'action' => 'Update',
         'desc' => 'QPE Behavior ' . $employe->nik . ' ' . $employe->biodata->fullName() . ' Semester ' . $pe->semester . '/' . $pe->tahun
      ]);
     

      return back()->with('success', 'Behavior berhasil di Create');
     
   }
   
   public function updateBehavior(Request $request, $id)
   {
      $pbda = PeBehaviorApprasialDetail::find($id);

      
      $update = $pbda->update([
         'value' => $request->valBv,
         'achievement' => $request->achievement
      ]);

      $pba = PeBehaviorApprasial::find($pbda->pba_id);
      $pe = Pe::find($pba->pe_id);
      $employe = Employee::find($pe->employe_id);

      $this->calculateAcvBehavior($pba->id);
      $this->calculatePe($pba->pe_id);

      if (auth()->user()->hasRole('Administrator')) {
        $departmentId = null;
        } else {
            $user = Employee::find(auth()->user()->getEmployeeId());
            $departmentId = $user->department_id;
        }
        Log::create([
            'department_id' => $departmentId,
            'user_id' => auth()->user()->id,
            'action' => 'Update',
            'desc' => 'QPE Behavior ' . $employe->nik . ' ' . $employe->biodata->fullName() . ' Semester ' . $pe->semester . '/' . $pe->tahun
        ]);

      return redirect()->back()->with('success', 'Behavior Karyawan Berhasil di Update');
   }

    public function submit(Request $request, $id)
    {

        $pe = Pe::find($request->id);


        PeDiscipline::where('pe_id', $pe->id)->update([
            'status' => '1'
        ]);

        PeKpa::where('pe_id', $pe->id)->update([
            'release_at' => NOW(),
            'status' => '1'
        ]);

        PeBehaviorApprasial::where('pe_id', $pe->id)->update([
            'status' => '1'
        ]);


        $pe->update([
            'release_at' => NOW(),
            'status' => '1'
        ]);

        if (auth()->user()->hasRole('Administrator')) {
         $departmentId = null;
      } else {
         $user = Employee::find(auth()->user()->getEmployeeId());
         $departmentId = $user->department_id;
      }
         Log::create([
            'department_id' => $departmentId,
            'user_id' => auth()->user()->id,
            'action' => 'Submit',
            'desc' => 'QPE ' . $pe->employe->nik . ' ' . $pe->employe->biodata->fullName() . ' Semester ' . $pe->semester . '/' . $pe->tahun 
         ]);

        return redirect('/')->with('success', 'Perfomance Evaluation berhasil di Sumbit');
    }

   public function approved($id)
   {

      $pe = Pe::find($id);

      $pba = PeBehaviorApprasial::where('pe_id', $pe->id)->first();
        //   $pba = PeBehaviorApprasial::where('pe_id', $pe->id)->first();

      if (!$pba) {
         # code...
         return back()->with('danger', 'Data Behavior Belum di isi !');
      }

      $verifikasiBy = auth()->user()->getEmployeeId();
      if (!$verifikasiBy) {
         $verifikasiBy = 'System';
      }

      // Mulai transaksi
      DB::beginTransaction();
      // Mulai transaksi
      try {
         // Update status pada tabel PeDiscipline
         PeDiscipline::where('pe_id', $pe->id)->update(['status' => '2']);

         // Update status pada tabel PeKpa
         PeKpa::where('pe_id', $pe->id)->update(['status' => '2']);
         // Update status pada tabel PeBehaviorApprasial
         PeBehaviorApprasial::where('pe_id', $pe->id)->update(['status' => '2']);

         // Update status dan verifikasi pada tabel PE
         $pe->update([
            'status' => '2',
            'verifikasi_by' => $verifikasiBy,
            'verifikasi_at' => NOW()
         ]);

         // Commit transaksi jika semua operasi berhasil
         DB::commit();
         // Commit transaksi jika semua operasi berhasil
        //  DB::commit();

         if (auth()->user()->hasRole('Administrator')) {
            $departmentId = null;
         } else {
            $user = Employee::find(auth()->user()->getEmployeeId());
            $departmentId = $user->department_id;
         }
         Log::create([
            'department_id' => $departmentId,
            'user_id' => auth()->user()->id,
            'action' => 'Approve',
            'desc' => 'QPE ' . $pe->employe->nik . ' ' . $pe->employe->biodata->fullName() . ' Semester ' . $pe->semester . ' Tahun ' . $pe->tahun 
         ]);

         // Redirect dengan pesan sukses
         return redirect('qpe')->with('success', 'PE Verifikasi successfully');
      } catch (\Exception $e) {
         // Rollback transaksi jika terjadi kesalahan
         DB::rollBack();
         // Redirect dengan pesan sukses
         return redirect('qpe')->with('success', 'PE Verifikasi successfully');
 
    //      return redirect('qpe')->with('danger', 'An error occurred while verifying PE');
      }
   }

   public function komentar(Request $request, $id)

   {

      $pe = Pe::find($id);

      // Mulai transaksi
      DB::beginTransaction();
   
      try {       
         if ($request->evidence) {
            # code...
            $pdfFile = $request->evidence;

            $pdfFileName = time() . '_' . $request->id . '.pdf';
            $pdfFile->storeAs('pe-evidence', $pdfFileName, 'public');

            // Update status dan verifikasi pada tabel PE
            $result = $pe->update([
               'komentar' => $request->komentar,
               'pengembangan' => $request->pengembangan,
               'evidence' => 'pe-evidence/' . $pdfFileName
            ]);
         } else {
           $pe->update([
            'komentar' => $request->komentar,
            'pengembangan' => $request->pengembangan
           ]);
         } 



         // Commit transaksi jika semua operasi berhasil
        //  DB::commit();
         // Commit transaksi jika semua operasi berhasil
         DB::commit();

         if (auth()->user()->hasRole('Administrator')) {
            $departmentId = null;
         } else {
            $user = Employee::find(auth()->user()->getEmployeeId());
            $departmentId = $user->department_id;
         }
         Log::create([
            'department_id' => $departmentId,
            'user_id' => auth()->user()->id,
            'action' => 'Create',
            'desc' => 'QPE Comment Training & Development ' . $pe->employe->nik . ' ' . $pe->employe->biodata->fullName() . ' Semester ' . $pe->semester . ' Tahun ' . $pe->tahun 
         ]);

         // Redirect dengan pesan sukses
         return back()->with('success', 'Komentar berhasil disimpan');
      } catch (\Exception $e) {
         // Rollback transaksi jika terjadi kesalahan
         DB::rollBack();
         // Redirect dengan pesan sukses
         return back()->with('success', 'Komentar berhasil disimpan');
      }
   }

//    public function discuss(Request $request, $id)
   public function discuss(Request $request, $id)
   {
      $pe = Pe::find($id);

      // Validasi input
      $request->validate([
         'nd_dibuat' => 'required|string|max:50',
         'nd_from' => 'required|string|max:50',
         'nd_for' => 'required',
         'nd_date' => 'required|date',
         'nd_alasan' => 'required',
      ]);


      // Mulai transaksi
      DB::beginTransaction();
     
      try {
         $update = $pe->update([
            'nd_dibuat' => $request->nd_dibuat,
            'nd_from' => $request->nd_from,
            'nd_for' => $request->nd_for,
            'nd_date' => $request->nd_date,
            'nd_alasan' => $request->nd_alasan,
            'status' => '202' //Status need discuss
         ]);

        
         // Commit transaksi jika semua operasi berhasil
         DB::commit();

         // $user = Employee::find(auth()->user()->getEmployeeId());
         // Log::create([
         //    'department_id' => $user->department_id,
         //    'user_id' => auth()->user()->id,
         //    'action' => 'Need Discuss',
         //    'desc' => 'QPE ' . $pe->employe->nik . ' ' . $pe->employe->biodata->fullName() . ' Semester ' . $pe->semester . ' Tahun ' . $pe->tahun 
         // ]);

         // dd($pe->id);
         // dd($pe->id);

         // Redirect dengan pesan sukses
         return redirect()->back()->with('success', 'Need Discuss berhasil di kirim');
      } catch (\Exception $e) {
         // Rollback transaksi jika terjadi kesalahan
         DB::rollBack();
         // Redirect dengan pesan sukses
         return redirect()->back()->with('success', 'Need Discuss berhasil di kirim');
      } 
   }
      
   public function complain(Request $request, $id)

   {
      $pe = Pe::find($id);
      // Validasi input
      $request->validate([
         'complain_alasan' => 'required',
      ]);

      // Mulai transaksi
      DB::beginTransaction();
      
      try {

     
         $update = $pe->update([
            'complained' => '1',
            'complain_date' => NOW(),
            'complain_alasan' => $request->complain_alasan
            // 'status' => '303' //Status need discuss
         ]);
         // dd($update);

         // Commit transaksi jika semua operasi berhasil
         DB::commit();

         // $user = Employee::find(auth()->user()->getEmployeeId());
         // Log::create([
         //    'department_id' => $user->department_id,
         //    'user_id' => auth()->user()->id,
         //    'action' => 'Complain',
         //    'desc' => 'QPE ' . $pe->employe->nik . ' ' . $pe->employe->biodata->fullName() . ' Semester ' . $pe->semester . ' Tahun ' . $pe->tahun 
         // ]);
         // $user = Employee::find(auth()->user()->getEmployeeId());
         // Log::create([
         //    'department_id' => $user->department_id,
         //    'user_id' => auth()->user()->id,
         //    'action' => 'Complain',
         //    'desc' => 'QPE ' . $pe->employe->nik . ' ' . $pe->employe->biodata->fullName() . ' Semester ' . $pe->semester . ' Tahun ' . $pe->tahun 
         // ]);

         // Redirect dengan pesan sukses
         return back()->with('success', 'Komplain berhasil di kirim');
      } catch (\Exception $e) {
         // Rollback transaksi jika terjadi kesalahan
         DB::rollBack();
         // Redirect dengan pesan sukses
         return back()->with('success', 'Komplain berhasil di kirim');
      }
   }
     
   public function closeComplain(Request $request, $id)

   {
      $pe = Pe::find($id);
      // Validasi input

      // Mulai transaksi
      DB::beginTransaction();

      try {

         $update = $pe->update([
            'complained' => '0',
            // 'status' => '303' //Status need discuss
         ]);

         // Commit transaksi jika semua operasi berhasil
         DB::commit();
         // $user = Employee::find(auth()->user()->getEmployeeId());
         // Log::create([
         //    'department_id' => $user->department_id,
         //    'user_id' => auth()->user()->id,
         //    'action' => 'Close',
         //    'desc' => 'QPE ' . $pe->employe->nik . ' ' . $pe->employe->biodata->fullName() . ' Semester ' . $pe->semester . ' Tahun ' . $pe->tahun 
         // ]);

         // Redirect dengan pesan sukses
         return back()->with('success', 'Komplain berhasil di tutup');
      } catch (\Exception $e) {
         // Rollback transaksi jika terjadi kesalahan
         DB::rollBack();
         // Redirect dengan pesan sukses
         return back()->with('success', 'Komplain berhasil di tutup');
      }
   }
   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
//    public function show($id)
//    {
//       $kpa = PeKpa::find(dekripRambo($id));
//       $datas = PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '0')->get();
//       $valueAvg = ROUND(PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '0')->avg('value'), 2);
//       // Additional 
//       $addtional = PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '1')->first();
//          // Redirect dengan pesan error
//          return back()->with('danger', $e . 'An error occurred while verifying PE');
//       }
//    }
   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      $kpa = PeKpa::find(dekripRambo($id));
      $datas = PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '0')->get();
      $valueAvg = ROUND(PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '0')->avg('value'), 2);
      // Additional 
      $addtional = PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '1')->first();


      $employes = Employee::where('status', '1')
         ->whereNotNull('kpi_id')
         ->get();
   
      $behaviors = PeBehavior::where('level', 's')->get();

      $isDone = false;
      $isReject = false;

      if (!isset($kpa)) {
         return back()->with('danger', 'Id KPA Anda Salah');
      }

    //   $pba = PeBehaviorApprasial::where('pe_id', $kpa->pe_id)->first();
      $pba = PeBehaviorApprasial::where('pe_id', $kpa->pe_id)->first();

      if (isset($pba)) {
         $pbads = PeBehaviorApprasialDetail::where('pba_id', $pba->id)->get();
      } else {
         $pbads = null;
      }

      $pe = Pe::find($kpa->pe_id);
      $this->updatePengurang($pe);
      $pd = PeDiscipline::where('pe_id', $kpa->pe_id)->first();

      return view('pages.qpe.qpe-show', [
         'kpa' => $kpa,
         'addtional' => $addtional,
         'behaviors' => $behaviors,
         'isDone' => $isDone,
         'isReject' => $isReject,
         'pd' => $pd,
         'pba' => $pba,
         'pbads' => $pbads,
         'pe' => $pe,
         'kpaAchievement' => 0,
         'pbaAchievement' => 0,
         'datas' => $datas,
         'valueAvg' => $valueAvg
      ])->with('i');
   }
   
      

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */


   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
      //
   }
   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   
   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  
   public function destroy($id)
   {
      //
      $pe = Pe::find($id);

      // dd($pe);
   }

//    private function outstandingAssessment($departmentId = 'All')
//    {
//       // Outstanding Query
//       // Membuat array untuk menyimpan hasil query
//       $outAssesment = array();

//             // Commit transaksi jika semua operasi berhasil
//             DB::commit();

//             if (auth()->user()->hasRole('Administrator')) {
//                $departmentId = null;
//             } else {
//                $user = Employee::find(auth()->user()->getEmployeeId());
//                $departmentId = $user->department_id;
//             }
//             Log::create([
//                'department_id' => $departmentId,
//                'user_id' => auth()->user()->id,
//                'action' => 'Approve',
//                'desc' => 'QPE ' . $pe->employe->nik . ' ' . $pe->employe->biodata->fullName() . ' Semester ' . $pe->semester . '/' . $pe->tahun 
//             ]);

//             // Redirect dengan pesan sukses
//             return redirect('qpe')->with('success', 'PE Verifikasi successfully');
//         // } catch (\Exception $e) {
//         //     // Rollback transaksi jika terjadi kesalahan
//         //     DB::rollBack();

//         //     // Redirect dengan pesan error
//         //     return redirect('qpe')->with('danger', 'An error occurred while verifying PE');
//         // }
//     }

    // public function komentar(Request $request, $id)

    // {

    //     $pe = Pe::find($id);

    //     // Mulai transaksi
    //     DB::beginTransaction();

    //     try {

    //         if ($request->evidence) {
    //             # code...
    //             $pdfFile = $request->evidence;

    //             $pdfFileName = time() . '_' . $request->id . '.pdf';
    //             $pdfFile->storeAs('pe-evidence', $pdfFileName, 'public');

    //             // Update status dan verifikasi pada tabel PE
    //             $result = $pe->update([
    //                 'komentar' => $request->komentar,
    //                 'pengembangan' => $request->pengembangan,
    //                 'evidence' => 'pe-evidence/' . $pdfFileName
    //             ]);
    //         } else {

    //             // Update status dan verifikasi pada tabel PE
    //             $pe->update([
    //                 'komentar' => $request->komentar,
    //                 'pengembangan' => $request->pengembangan,
    //             ]);
    //         }



    //         // Commit transaksi jika semua operasi berhasil
    //         DB::commit();

    //         if (auth()->user()->hasRole('Administrator')) {
    //            $departmentId = null;
    //         } else {
    //            $user = Employee::find(auth()->user()->getEmployeeId());
    //            $departmentId = $user->department_id;
    //         }
    //         Log::create([
    //            'department_id' => $departmentId,
    //            'user_id' => auth()->user()->id,
    //            'action' => 'Update',
    //            'desc' => 'QPE Comment & Training ' . $pe->employe->nik . ' ' . $pe->employe->biodata->fullName() . ' Semester ' . $pe->semester . '/' . $pe->tahun 
    //         ]);

    //         // Redirect dengan pesan sukses
    //         return back()->with('success', 'Komentar berhasil disimpan');
    //     } catch (\Exception $e) {
    //         // Rollback transaksi jika terjadi kesalahan
    //         DB::rollBack();

    //         // Redirect dengan pesan error
    //         return back()->with('danger', $e . 'An error occurred while verifying PE');
    //     }
    // }

    // public function discuss(Request $request, $id)

    // {
    //     $pe = Pe::find($id);
        
    //     // Validasi input
    //     $request->validate([
    //         'nd_dibuat' => 'required|string|max:50',
    //         'nd_from' => 'required|string|max:50',
    //         'nd_for' => 'required',
    //         'nd_date' => 'required|date',
    //         'nd_alasan' => 'required',
    //     ]);
        

    //     // Mulai transaksi
    //     DB::beginTransaction();

    //     try {

    //         $update = $pe->update([
    //             'nd_dibuat' => $request->nd_dibuat,
    //             'nd_from' => $request->nd_from,
    //             'nd_for' => $request->nd_for,
    //             'nd_date' => $request->nd_date,
    //             'nd_alasan' => $request->nd_alasan,
    //             'status' => '202' //Status need discuss
    //         ]);

    //         // Commit transaksi jika semua operasi berhasil
    //         DB::commit();
            
    //         $user = Employee::find(auth()->user()->getEmployeeId());
    //         Log::create([
    //            'department_id' => $user->department_id,
    //            'user_id' => auth()->user()->id,
    //            'action' => 'Need Discuss',
    //            'desc' => 'QPE ' . $pe->employe->nik . ' ' . $pe->employe->biodata->fullName() . ' Semester ' . $pe->semester . '/' . $pe->tahun 
    //         ]);

    //         // dd($pe->id);

    //         // Redirect dengan pesan sukses
    //         return redirect()->back()->with('success', 'Need Discuss berhasil di kirim');
    //     } catch (\Exception $e) {
    //         // Rollback transaksi jika terjadi kesalahan
    //         DB::rollBack();

    //         // Redirect dengan pesan error
    //         return back()->with('danger', $e . 'An error occurred while verifying PE');
    //     }
    // }


    // public function complain(Request $request, $id)

    // {
    //     $pe = Pe::find($id);
    //     // Validasi input
    //     $request->validate([
    //         'complain_alasan' => 'required',
    //     ]);

    //     // Mulai transaksi
    //     DB::beginTransaction();

    //     try {

    //         $update = $pe->update([
    //             'complained' => '1',
    //             'complain_date' => NOW(),
    //             'complain_alasan' => $request->complain_alasan
    //             // 'status' => '303' //Status need discuss
    //         ]);
    //         // dd($update);

    //         // Commit transaksi jika semua operasi berhasil
    //         DB::commit();

    //         // $user = Employee::find(auth()->user()->getEmployeeId());
    //         // Log::create([
    //         //    'department_id' => $user->department_id,
    //         //    'user_id' => auth()->user()->id,
    //         //    'action' => 'Complain',
    //         //    'desc' => 'QPE ' . $pe->employe->nik . ' ' . $pe->employe->biodata->fullName() . ' Semester ' . $pe->semester . ' Tahun ' . $pe->tahun 
    //         // ]);

    //         // Redirect dengan pesan sukses
    //         return back()->with('success', 'Komplain berhasil di kirim');
    //     } catch (\Exception $e) {
    //         // Rollback transaksi jika terjadi kesalahan
    //         DB::rollBack();

    //         // Redirect dengan pesan error
    //         return back()->with('danger', $e . 'An error occurred while verifying PE');
    //     }
    // }


    // public function closeComplain(Request $request, $id)

    // {
    //     $pe = Pe::find($id);
    //     // Validasi input

    //     // Mulai transaksi
    //     DB::beginTransaction();

    //     try {

    //         $update = $pe->update([
    //             'complained' => '0',
    //             // 'status' => '303' //Status need discuss
    //         ]);

    //         // Commit transaksi jika semua operasi berhasil
    //         DB::commit();
    //         // $user = Employee::find(auth()->user()->getEmployeeId());
    //         // Log::create([
    //         //    'department_id' => $user->department_id,
    //         //    'user_id' => auth()->user()->id,
    //         //    'action' => 'Close',
    //         //    'desc' => 'QPE ' . $pe->employe->nik . ' ' . $pe->employe->biodata->fullName() . ' Semester ' . $pe->semester . ' Tahun ' . $pe->tahun 
    //         // ]);

    //         // Redirect dengan pesan sukses
    //         return back()->with('success', 'Komplain berhasil di tutup');
    //     } catch (\Exception $e) {
    //         // Rollback transaksi jika terjadi kesalahan
    //         DB::rollBack();

    //         // Redirect dengan pesan error
    //         return back()->with('danger', $e . 'An error occurred while verifying PE');
    //     }
    // }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $kpa = PeKpa::find(dekripRambo($id));
    //     $datas = PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '0')->get();
    //     $valueAvg = ROUND(PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '0')->avg('value'), 2);
    //     // Additional 
    //     $addtional = PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '1')->first();


    //     $employes = Employee::where('status', '1')
    //         ->whereNotNull('kpi_id')
    //         ->get();

    //     // Berikut Behavior  Staff
    //     $behaviors = PeBehavior::where('level', 's')->get();



    //     // $pcc = new PeComponentController();
    //     // $pcs = $pcc->getComponentDesignation($kpa->employe->contract->designation->id); // Memanggil fungsi show dari ProfileController

    //     // dd($pcs);


    //     $isDone = false;
    //     $isReject = false;


    //     if (!isset($kpa)) {
    //         return back()->with('danger', 'Id KPA Anda Salah');
    //     }

    //     $pba = PeBehaviorApprasial::where('pe_id', $kpa->pe_id)->first();

    //     if (isset($pba)) {
    //         $pbads = PeBehaviorApprasialDetail::where('pba_id', $pba->id)->get();
    //     } else {
    //         $pbads = null;
    //     }

    //     $pe = Pe::find($kpa->pe_id);

    //     $pd = PeDiscipline::where('pe_id', $kpa->pe_id)->first();

    //     return view('pages.qpe.qpe-show', [
    //         'kpa' => $kpa,
    //         'addtional' => $addtional,
    //         'behaviors' => $behaviors,
    //         'isDone' => $isDone,
    //         'isReject' => $isReject,
    //         'pd' => $pd,
    //         'pba' => $pba,
    //         'pbads' => $pbads,
    //         'pe' => $pe,
    //         'kpaAchievement' => 0,
    //         'pbaAchievement' => 0,
    //         'datas' => $datas,
    //         'valueAvg' => $valueAvg
    //     ])->with('i');
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    //     $pe = Pe::find($id);

    //     // dd($pe);
    // }

    private function outstandingAssessment($departmentId = 'All')
    {
        // Outstanding Query
        // Membuat array untuk menyimpan hasil query
        $outAssesment = array();

      $bulanMulai = 7;   // Bulan untuk mulai atau mengetahui ouststanding assesment

      $bulanSekarang = date('n');


      $tahun = date('Y');

      // Loop dari bulan 1 hingga 12
      for ($bulan = $bulanSekarang; $bulan >= $bulanMulai; $bulan--) {
         // Mengambil data untuk bulan saat ini

         if ($departmentId == 'All') {
            # code...
            $employees = Employee::where('designation_id', '<=', '4')
               ->get();
         } else {
            # code...
            $employees = Employee::where('department_id', $departmentId)
               ->where('designation_id', '<=', '4')
               ->get();
         }

         // mencari data karyawan pada departemen ini 
         // mencari data karyawan pada departemen ini 


       
         // looping karywanya
         foreach ($employees as $key => $karyawan) {
            # cek apakah ada penilai kpi di bulan ini
            $kpa = PeKpa::where('employe_id', $karyawan->id)
               ->whereMonth('date', $bulan)
               ->whereYear('date', $tahun)
               ->first();

            if (!$kpa) {
               # jika tidak ada mauskan kedalam oustanding

               $outAssesment[$bulan][$karyawan->id] = [
                  'employe_id' => $karyawan->id,
                  'employe' => $karyawan->biodata->fullName(),
                  'bulan' => $bulan,
                  'tahun' => $tahun,
                  'status' => 'Belum ada data!'
               ];
            }
         }
      }
              
      return $outAssesment;
   }


  
   public function calculateAcvKpa($kpaId)
   {
      $kpa = PeKpa::find($kpaId);

      $totalAchievement = PekpaDetail::where('kpa_id', $kpa->id)->sum('achievement');
    
      // Untuk mengakomodir jika semua achievment di tambah lebih dari 100
      if ($totalAchievement > 100) {
         $totalAchievement = 100;
      }

    //   $contribute = round(($kpa->weight / 100) * $totalAchievement);
      $contribute = round(($kpa->weight / 100) * $totalAchievement);

      $kpa->update([
         'achievement' => $totalAchievement,
         'contribute_to_pe' => $contribute
      ]);

      Pe::where('id', $kpa->pe_id)->update([
         'kpi' => $contribute
      ]);
   }


   public function calculateAcvBehavior($pbaId)
   {
      $pba = PeBehaviorApprasial::find($pbaId);

      $totalAchievement = PeBehaviorApprasialDetail::where('pba_id', $pba->id)->sum('achievement');

     
      // Untuk mengakomodir jika semua achievment di tambah lebih dari 100
      if ($totalAchievement > $pba->weight) {
         $totalAchievement = $pba->weight;
      }

      $contribute =   $totalAchievement;

      $pba->update([
         'achievement' => $totalAchievement,
         'contribute_to_pe' => $contribute
      ]);

      Pe::where('id', $pba->pe_id)->update([
         'behavior' => $contribute
      ]);
   }
      

  
   public function calculatePe($peId)
   {

      $pe = Pe::find($peId);

      $this->createAndUpdateDiscipline($pe);

      // Update Pengurang (SP)
      $this->updatePengurang($pe);

      $pe->update([
         'achievement' => ($pe->discipline + $pe->kpi + $pe->behavior) - $pe->pengurang
      ]);
   }
    


   public function createAndUpdateDiscipline($pe)
   {
      // Pe Discipline
      // Mencari data PeDiscipline berdasarkan pe_id
      $pd = PeDiscipline::where([
         'pe_id' => $pe->id
      ])->first();

      // Jika data tidak ditemukan berdasarkan pe_id
      if (!isset($pd)) {
         # code...
         // Mencari data PeDiscipline berdasarkan employe_id, tahun, dan bulan
         $pd = PeDiscipline::where([
            'employe_id' => $pe->employe_id,
            'tahun' => $pe->tahun,
            'semester' => $pe->semester
         ])->first();

         // Jika data tidak ditemukan berdasarkan employe_id, tahun, dan bulan
         if (!isset($pd)) {
            # Create Pe Discipline 
            // Membuat entri baru di tabel PeDiscipline

            $employe = Employee::find($pe->employe_id);

            $pcc = new PeComponentController();
            $weight = $pcc->getWeightDiscipline($employe->contract->designation->id); // Memanggi


            $pd = PeDiscipline::create([
               'pe_id' => $pe->id,
               'employe_id' => $pe->employe_id,
               'tahun' => $pe->tahun,
               'semester' => $pe->semester,
               'weight' => $weight
            ]);
         }
      }

      // Update Pe Discipline
      // Memperbarui pe_id di entri PeDiscipline
      $pd->update([
         'pe_id' => $pe->id
      ]);

      if (!isset($pd->contribute_to_pe)) {
         $pd->contribute_to_pe = 0;
      }

      // Memperbarui nilai discipline di entri PE berdasarkan nilai contribute_to_pe dari PeDiscipline
      $pe->update([
         'discipline' => $pd->contribute_to_pe
      ]);
   }

  
   public function updatePengurang($pe)
   {
      $sp = Sp::where('employee_id', $pe->employe_id)
         ->where('tahun', $pe->tahun)
         ->where('semester', $pe->semester)
         ->where('status', '>=', 4)
         ->get();

      if ($sp->count() > 0) {
         // Update Tabel SP
         Sp::where('employee_id', $pe->employe_id)
            ->where('tahun', $pe->tahun)
            ->where('semester', $pe->semester)
            ->where('status', '>=', 4)
            ->update([
               'pe_id' => $pe->id
            ]);

         $pe->update([
            'pengurang' => 5
         ]);
      } else {
         $pe->update([
            'pengurang' => 0
         ]);
      } 
   }




//    public function report()
//    {
//       $units = Unit::get();
//       $qpes = Pe::get();

//       $now = Carbon::now();
//       $month = $now->format('m');
//       if ($month < 7) {
//          $semester = 1;
//       } else {
//          $semester = 2;
//       }
//       // $semeter = 1;
//       $year = $now->format('Y');

//       return view('pages.qpe.report', [
//          'units' => $units,
//          'qpes' => $qpes,
//          'semester' => $semester,
//          'year' => $year
//       ]);
//    }

//    public function reportFilter(Request $req)
//    {
//       $units = Unit::get();
//       $qpes = Pe::get();

//       // $now = Carbon::now();
//       // $month = $now->format('m');

//       // $semeter = 1;
//       // $year = $now->format('Y');

//       return view('pages.qpe.report', [
//          'units' => $units,
//          'qpes' => $qpes,
//          'semester' => $req->semester,
//          'year' => $req->year
//       ]);
//    }

//    public function reportUnit($id, $semester, $year)
//    {
//       $unit = Unit::find(dekripRambo($id));
//       $semester = dekripRambo($semester);
//       $year = dekripRambo($year);

//       return view('pages.qpe.report-unit', [
//          'unit' => $unit,
//          'semester' => $semester,
//          'year' => $year
//       ]);
//    }

//    public function reportDepartment($id, $semester, $year)
//    {
//       $department = Department::find(dekripRambo($id));
//       $semester = dekripRambo($semester);
//       $year = dekripRambo($year);

//       return view('pages.qpe.report-department', [
//          'department' => $department,
//          'semester' => $semester,
//          'year' => $year
//       ]);
//    }
//          $pe->update([
//             'pengurang' => 0
//          ]);
//       }
//    }




   public function report()
   {
      $units = Unit::get();
      $qpes = Pe::get();

      $now = Carbon::now();
      $month = $now->format('m');
      if ($month < 7) {
         $semester = 1;
      } else {
         $semester = 2;
      }
      // $semeter = 1;
      $year = $now->format('Y');

      return view('pages.qpe.report', [
         'units' => $units,
         'qpes' => $qpes,
         'semester' => $semester,
         'year' => $year
      ]);
   }

   public function reportFilter(Request $req)
   {
      $units = Unit::get();
      $qpes = Pe::get();

      // $now = Carbon::now();
      // $month = $now->format('m');

      // $semeter = 1;
      // $year = $now->format('Y');

      return view('pages.qpe.report', [
         'units' => $units,
         'qpes' => $qpes,
         'semester' => $req->semester,
         'year' => $req->year
      ]);
   }

   public function reportUnit($id, $semester, $year)
   {
      $unit = Unit::find(dekripRambo($id));
      $semester = dekripRambo($semester);
      $year = dekripRambo($year);

      return view('pages.qpe.report-unit', [
         'unit' => $unit,
         'semester' => $semester,
         'year' => $year
      ]);
   }

   public function reportDepartment($id, $semester, $year)
   {
      $department = Department::find(dekripRambo($id));
      $semester = dekripRambo($semester);
      $year = dekripRambo($year);

      return view('pages.qpe.report-department', [
         'department' => $department,
         'semester' => $semester,
         'year' => $year
      ]);
   }

   public function applyMany(Request $req)
    {

      //   dd('ok');
        // try {
        DB::beginTransaction();

        // Memeriksa apakah permintaan untuk menerapkan data (apply) adalah '1'
        if ($req->apply == '1') {
            $apply = 0; // Inisialisasi penghitung untuk data yang berhasil diterapkan
            $duplikat = 0; // Inisialisasi penghitung untuk data yang sudah ada (duplikat)

            // Melakukan iterasi melalui setiap ID yang diperiksa dalam permintaan
            foreach ($req->check as $key => $id) {

                $this->approved($id);
                $apply++;
            }

            $pesan1 = ''; // Pesan untuk data yang berhasil diterapkan
            $pesan2 = ''; // Pesan untuk data yang duplikat

            // Membuat pesan jika ada data yang berhasil diterapkan
            if ($apply > 0) {
                $pesan1 = $apply . ' QPE successfully approved ';
            }

            // Membuat pesan jika ada data yang duplikat
            if ($duplikat > 0) {
                $pesan2 = $duplikat . ' Data already available ';
            }

            // Membuat array pesan untuk dikembalikan sebagai tanggapan
            $message = [
                'success' => $pesan1,
                'danger' => $pesan2,
            ];
        }
       
        // Commit transaksi jika semua operasi berhasil
        DB::commit();

        return back()->with($message);
        // } catch (\Exception $e) {
        //     // Rollback transaksi jika terjadi kesalahan
        //     DB::rollBack();

        //     // Handle kesalahan sesuai kebutuhan Anda
        //     // Misalnya, log pesan kesalahan atau kembalikan respons kesalahan ke pengguna
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }
    }
}
