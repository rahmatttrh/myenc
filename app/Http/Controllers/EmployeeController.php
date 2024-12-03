<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeExport;
use App\Exports\EmployeeSimpleExport;
use App\Imports\BiodataImport;
use App\Imports\EmployeeImport;
use App\Models\Bank;
use App\Models\Biodata;
use App\Models\Contract;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmployeeLeader;
use App\Models\Log;
use App\Models\Position;
use App\Models\Role;
use App\Models\Shift;
use App\Models\Social;
use App\Models\SocialAccount;
use App\Models\SubDept;
use App\Models\Unit;
use App\Models\User;
use App\Models\Location;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\PeKpi;

class EmployeeController extends Controller
{
   public function index($enkripTab)
   {
      $tab = dekripRambo($enkripTab);

      $employees = Employee::get();


      // foreach ($employees as $emp) {
      //    if($emp->kpi_id != null) {
      //       $kpi = PeKpi::find($emp->kpi_id);
      //       if ($kpi == null) {
      //          $emp->update([
      //             'kpi_id' => null
      //          ]);
      //          // dd($emp->kpi_id);
      //       }
      //    }

      //    # code...
      // }
      // dd($tab);
      // $employees = Employee::where('status', 1)
      //    ->orderBy('department_id')
      //    ->orderBy('sub_dept_id')
      //    ->orderBy('designation_id')
      //    ->orderBy('position_id')
      //    ->get();


      $employees = Employee::where('status', 1)
         ->orderBy('updated_at', 'desc')
         ->get();

      // foreach($employees as $emp){
      //    $contract = Contract::find($emp->contract_id);
      //    if ($emp->unit_id != $contract->unit_id) {
      //       // dd($emp->contract->unit->name);
      //       $emp->update([
      //          'unit_id' => $contract->unit_id
      //       ]);
      //    }
      // }

      foreach ($employees as $emp) {
         $contract = Contract::find($emp->contract_id);
         $loc = Location::where('code', $contract->loc)->first();
         if ($loc) {
            $emp->update([
               'location_id' => $loc->id
            ]);
         }
      }

      // foreach ($employees as $emp) {
      //    $user = User::where('username', $emp->nik)->first();
      //    if ($user) {
      //       if ($user->hasRole('BOD')) {
      //          $emp->update([
      //             'role' => 6,
      //          ]);
      //       } elseif ($user->hasRole('Manager')) {
      //          $emp->update([
      //             'role' => 5,
      //          ]);
      //       } elseif ($user->hasRole('Asst. Manager')) {
      //          $emp->update([
      //             'role' => 8,
      //          ]);
      //       } elseif ($user->hasRole('Supervisor')) {
      //          $emp->update([
      //             'role' => 7,
      //          ]);
      //       } elseif ($user->hasRole('Leader')) {
      //          $emp->update([
      //             'role' => 4,
      //          ]);
      //       }
      //    }
      // }


      // foreach ($employees as $emp) {
      //    $user = User::where('username', $emp->nik)->first();
      //    if ($user) {
      //       $emp->update([
      //          'role' => 3,
      //          'user_id' => $user->id
      //       ]);
      //       $user->assignRole('Karyawan');
      //    }
      // }
      $draftEmployees = Employee::where('status', 0)->get();
      return view('pages.employee.index', [
         'employees' => $employees,
         'draftEmployees' => $draftEmployees,
         'tab' => $tab,
         'departments' => Department::get()
      ])->with('i');
   }


   public function resetPassword($id)
   {
      $employee = Employee::find(dekripRambo($id));
      $user = User::where('username', $employee->nik)->first();

      $user->update([
         'password' => Hash::make('12345678')
      ]);

      return redirect()->back()->with('success', 'Password User successfully updated');
   }



   public function indexSpv()
   {
      $department = Department::find(auth()->user()->getEmployee()->department_id);
      // dd($department->id);
      // dd($tab);
      $employees = Employee::where('department_id', $department->id)->where('status', 1)
         ->orderBy('department_id')
         ->orderBy('sub_dept_id')
         ->orderBy('designation_id')
         ->orderBy('position_id')
         ->get();

      // dd($departmentId);
      return view('pages.employee.indexSpv', [
         'employees' => $employees,

      ])->with('i');
   }

   public function nonactive()
   {

      $employees = Employee::where('status', 3)
         ->orderBy('department_id')
         ->orderBy('sub_dept_id')
         ->orderBy('designation_id')
         ->orderBy('position_id')
         ->get();
      return view('pages.employee.nonactive', [
         'employees' => $employees,
         'departments' => Department::get()
      ])->with('i');
   }

   public function off()
   {

      $draftEmployees = Employee::where('status', 0)->get();
      return view('pages.employee.off', [
         'draftEmployees' => $draftEmployees,
         'departments' => Department::get()
      ])->with('i');
   }

   public function draft()
   {
      $employees = Employee::where('status', 0)->get();
      return view('pages.employee.draft', [
         'employees' => $employees
      ])->with('i');
   }


   public function publishSingle($id)
   {
      $employee = Employee::find(dekripRambo($id));

      // try {
      //    $user = User::create([
      //       'name' => $employee->biodata->first_name . ' ' . $employee->biodata->last_name,
      //       'email' => $employee->biodata->email,
      //       'username' => $employee->nik,
      //       'password' => Hash::make('12345678')
      //    ]);
      // } catch (Exception $e) {
      //    return redirect()->back()->with('danger', 'Can not activate employee  ' . $employee->biodata->first_name . ' ' . $employee->biodata->last_name . ', Error log : ' . $e->getMessage());
      // }
      // try {
      //    $user = User::create([
      //       'name' => $employee->biodata->first_name . ' ' . $employee->biodata->last_name,
      //       'email' => $employee->biodata->email,
      //       'username' => $employee->nik,
      //       'password' => Hash::make('12345678')
      //    ]);
      // } catch (Exception $e) {
      //    return redirect()->back()->with('danger', 'Can not activate employee  ' . $employee->biodata->first_name . ' ' . $employee->biodata->last_name . ', Error log : ' . $e->getMessage());
      // }


      $employee->update([
         'status' => 1,
         // 'user_id' => $user->id
      ]);


      $employee->biodata->update([
         'status' => 1,
      ]);

      // $user = User::where('username', $employee->nik)->first();
      // if ($employee->contract->designation_id == 1) {
      //    $user->assignRole('Manager');
      // } elseif ($employee->contract->designation_id == 2) {
      //    $user->assignRole('Asst. Manager');
      // } elseif ($employee->contract->designation_id == 3) {
      //    $user->assignRole('Supervisor');
      // } else {
      //    $user->assignRole('Karyawan');
      // }
      $user = User::where('username', $employee->nik)->first();
      if ($employee->contract->designation_id == 1) {
         $user->assignRole('Manager');
      } elseif ($employee->contract->designation_id == 2) {
         $user->assignRole('Asst. Manager');
      } elseif ($employee->contract->designation_id == 3) {
         $user->assignRole('Supervisor');
      } else {
         $user->assignRole('Karyawan');
      }

      // $user->assignRole('Karyawan');
      // $user->assignRole('Karyawan');

      if (auth()->user()->hasRole('Administrator')) {
         $departmentId = null;
      } else {
         $user = Employee::find(auth()->user()->getEmployeeId());
         $departmentId = $user->department_id;
      }
      Log::create([
         'department_id' => $departmentId,
         'user_id' => auth()->user()->id,
         'action' => 'Publish',
         'desc' => 'Employee ' . $employee->nik . ' ' . $employee->biodata->fullname()
      ]);
      return redirect()->back()->with('success', 'Employee successfully activated');
   }

   public function publish(Request $req)
   {
      $req->validate([
         'id_item' => 'required',
      ]);

      $arrayItem = $req->id_item;
      $jumlah = count($arrayItem);

      for ($i = 0; $i < $jumlah; $i++) {
         $employee = Employee::find($arrayItem[$i]);

         // try {
         //    $user = User::create([
         //       'name' => $employee->biodata->first_name . ' ' . $employee->biodata->last_name,
         //       'email' => $employee->biodata->email,
         //       'username' => $employee->nik,
         //       'password' => Hash::make('12345678')
         //    ]);
         // } catch (Exception $e) {
         //    return redirect()->back()->with('danger', 'Can not activate employee  ' . $employee->biodata->first_name . ' ' . $employee->biodata->last_name . ', Error log : ' . $e->getMessage());
         // }

         $employee->update([
            'status' => 1,
            // 'user_id' => $user->id
         ]);

         $employee->biodata->update([
            'status' => 1,
         ]);

         $contract = Contract::find($employee->contract_id);
         $contract->update([
            'status' => 1
         ]);



         $user = User::where('username', $employee->nik)->first();
         if ($employee->contract->designation_id == 1) {
            $user->assignRole('Manager');
         } elseif ($employee->contract->designation_id == 2) {
            $user->assignRole('Asst. Manager');
         } elseif ($employee->contract->designation_id == 3) {
            $user->assignRole('Supervisor');
         } else {
            $user->assignRole('Karyawan');
         }
         // $user->assignRole('Karyawan');

         // Cek email apakah ada atau belum 

         $emailEnv = env('MAIL_FROM_ADDRESS');
         if ($emailEnv != null) {
            // jika ada kirim email
            // $user->sendEmailVerificationNotification();
         }
      }

      if (auth()->user()->hasRole('Administrator')) {
         $departmentId = null;
      } else {
         $user = Employee::find(auth()->user()->getEmployeeId());
         $departmentId = $user->department_id;
      }
      Log::create([
         'department_id' => $departmentId,
         'user_id' => auth()->user()->id,
         'action' => 'Publish',
         'desc' => 'Employees Data'
      ]);
      return redirect()->route('employee', enkripRambo('active'))->with('success', 'Employee successfully activated');
   }

   public function detail($id, $enkripPanel)
   {


      // $employee = auth()->user()->getEmployee();
      // // Data KPI
      // if (auth()->user()->hasRole('Administrator|HRD')) {

      //    // 
      // } else if (auth()->user()->hasRole('Leader|Manager')) {
      // }
      // dd('ok');

      $dekripId = dekripRambo($id);
      $employee = Employee::find($dekripId);
      $user = User::where('username', $employee->nik)->first();

      // if ($employee->id == 19) {
      //    // dd($employee->position->id);
      //    $contract = Contract::find($employee->contract_id);
      //    // dd($contract->position_id);
      //    $employee->update([
      //       'unit_id' => $contract->unit_id
      //    ]);
      // }

      // if ($user) {
      //    // dd('ok');
      //   $employee->update([
      //    'user_id' => $user->id
      //   ]);
      // }
      // $user->roles()->detach('Karyawan');

      // if ($employee->contract->loc = 'HWW') {
      //    dd('ada');
      // } else {
      //    dd('tidak ada');
      // }
      // $empUnit = Unit::find($employee->unit_id);
      // $empDepartment = Department::find($employee->department_id);
      // $empSubdept = SubDept::find($employee->sub_dept_id);
      // if ($empUnit == null) {
      //    $employee->update([
      //       'unit_id' => null,
      //       'department_id' => null,
      //       'sub_dept_id' => null,
      //       'position_id' => null
      //    ]);
      // }
      // dd($employee->id);
      // $employee->update([
      //    'department_id' => 5
      // ]);
      if ($employee->designation->name == 'Manager') {
         // if (count($employee->positions) > 0) {
         //    $employee->contract->update([
         //       'type' => 'Tetap'
         //    ]);
         // }
      } else {
         // $department = Department::find($employee->department_id);
         // $subdept = SubDept::find($employee->sub_dept_id);
         // $subManager = Position::where('designation_id', 6)->where('sub_dept_id', $subdept->id)->first();

         // if ($subManager != null) {
         //    // dd('ada sub manager');
         //    $manager = Employee::where('position_id', $subManager->id)->first();
         //    // dd($manager->biodata->fullName());
         // } else {
         //    // dd($department->id);
         //    $deptManager = Position::where('designation_id', 6)->where('department_id', $department->id)->first();
         //    // $deptManager->employees()->first()
         //    // dd($department->id);
         //    $manager = $deptManager->employees()->first();
         //    // dd($manager->biodata->fullName());
         //    // dd('kosong');
      }


      // $pos = Position::where('designation_id', 6)->orWhere('designation_id', 7)->get();
      // $position = $pos->where('department_id', $department->id)->first();
      // // dd($position->name);
      // // dd($position->name);
      // // dd($position->employees()->first()->biodata->fullName());
      // // dd($employee->contract_id);
      // // $contract = Contract::find($employee->contract_id);
      // if (count($position->employees) > 0) {
      //    $employee->update([
      //       'manager_id' => $position->employees()->first()->id,
      //       'direct_leader_id' => null
      //    ]);
      // }
      // $pos = Position::where('designation_id', 6)->orWhere('designation_id', 7)->get();
      // $position = $pos->where('department_id', $department->id)->first();
      // // dd($position->name);
      // // dd($position->name);
      // // dd($position->employees()->first()->biodata->fullName());
      // // dd($employee->contract_id);
      // // $contract = Contract::find($employee->contract_id);
      // if (count($position->employees) > 0) {
      //    $employee->update([
      //       'manager_id' => $position->employees()->first()->id,
      //       'direct_leader_id' => null
      //    ]);
      // }
      // }




      $contracts = Contract::where('id_no', $employee->nik)->where('status', 0)->get();
      // dd($contracts);
      // $contract
      // foreach($contracts as $con){
      //    $con->update([
      //       'employee_id' => $employee->id
      //    ]);
      // }

      $departments = Department::where('unit_id', $employee->unit_id)->get();
      // dd($employee->id);
      $positions = Position::where('sub_dept_id', $employee->sub_dept_id)->get();
      $allPositions = Position::get();

      $panel = dekripRambo($enkripPanel);
      $designations = Designation::get();
      $roles = Role::where('id', '>', 1)->get();
      $shifts = Shift::get();
      $units = Unit::get();
      $socials = Social::get();
      $banks = Bank::get();

      // $managers = Employee::where('department_id', $employee->department_id)->where('designation_id', 6)->get();
      // $spvs = Employee::where('department_id', $employee->department_id)->where('designation_id', 4)->get();
      // $leaders = Employee::where('department_id', $employee->department_id)->where('designation_id', 3)->get();

      $managers = Employee::where('status', 1)->where('designation_id', 6)->get();
      $spvs = Employee::where('status', 1)->where('designation_id', 4)->where('department_id', $employee->department_id)->get();
      // $leaders = Employee::where('role', 4)->orWhere('role', 7)->orWhere('role', 8)->orWhere('role', 5)->orWhere('role', 9)->get();
      $leaders = Employee::where('designation_id', 3)->orWhere('designation_id', 4)->orWhere('designation_id', 5)->orWhere('designation_id', 6)->get();
      // dd($leaders);
      $finalLeaders = $leaders->where('status', 1);
      // dd($finalLeaders);
      $managers = Position::where('type', 'dept');
      // $managers = Position::where('');
      // dd($finalLeaders);
      // dd($employee->documents);
      // $panel = 'contract';
      // $tab = 'contract';

      $allManagers = Employee::where('designation_id', 6)->get();
      $allSpvs = Employee::where('designation_id', 4)->get();
      // dd($spvs);
      $allLeaders = Employee::where('designation_id', 3)->where('designation_id', 3)->get();
      $subdepts = SubDept::where('department_id', $employee->department_id)->get();
      $employeeLeaders = EmployeeLeader::where('employee_id', $employee->id)->get();
      // dd($employee->department_id);
      $department = Department::find($employee->department_id);
      $subdept = SubDept::find($employee->sub_dept_id);
      // // dd($department->id);
      // $myManagers = [];
      // dd($department->id);
      $myManagers = [];
      // dd($subdept->id);
      if ($department) {
         $managerPositions = Position::where('department_id', $department->id)->where('type', 'dept')->get();
      } else {
         $managerPositions = [];
      }

      // dd($myManagers);
      // dd($employee->department_id);
      if ($subdept) {
         $subManPositions = Position::where('department_id', $department->id)->where('sub_dept_id', $subdept->id)->where('type', 'subdept')->where('designation_id', '>', 4)->get();
         // dd($subManPositions);
         if (count($subManPositions) > 0) {
            // dd('ok');
            // dd($subman->id);
            // foreach ($subManPositions as $submanpos) {
            foreach ($subManPositions as $submanpos) {
               // dd($submanpos->employee);
               if ($submanpos->employee) {
                  $myManagers[] = $submanpos->employee;
               }


               // dd($submanpos->employee);
               // foreach($submanpos->employees as $subman){
               //    $myManagers[] = $subman;
               //    dd($subman->id);
               // }
            }
            // dd($myManagers);

         }
      } else {
         $subManPositions = null;
      }

      // dd($myManagers);

      // foreach($managerPositions as $manpos){
      //    foreach($manpos->employees as $man){
      //       $myManagers[] = $man;
      //    }
      // }

      // foreach($subManPositions as $submanpos){
      //    foreach($submanpos->employees as $subman){
      //       $myManagers[] = $subman;
      //    }
      // }



      // else {
      //    foreach($managerPositions as $manpos){


      //       foreach($manpos->employees as $man){
      //          // dd($man);
      //          $myManagers[] = $man;
      //       }
      //    }
      // }

      // dd($managerPositions);
      //  dd($myManagers);

      if (count($managerPositions) > 0) {
         foreach ($managerPositions as $manpos) {

            foreach ($manpos->employees as $man) {
               // dd($manpos->employees);
               $myManagers[] = $man;
            }
         }
      }

      // dd($subManPositions);




      // dd($myManagers);

      // if (auth()->user()->hasRole('HRD')) {
      //    # code...
      // }

      // dd($employee->position_id);
      // dd($employee->designation->name);  

      // dd($myManagers);

      return view('pages.employee.detail', [
         'employee' => $employee,
         'departments' => $departments,
         'designations' => $designations,
         'positions' => $positions,
         'allPositions' => $allPositions,
         'roles' => $roles,
         'shifts' => $shifts,
         'units' => $units,
         'socials' => $socials,
         'banks' => $banks,
         'panel' => $panel,

         'managers' => $managers,
         'spvs' => $spvs,
         'leaders' => $finalLeaders,

         'allManagers' => $allManagers,
         'allSpvs' => $allSpvs,
         'allLeaders' => $allLeaders,

         'subdepts' => $subdepts,
         'contracts' => $contracts,
         // 'tab' => $tab,
         'employeeLeaders' => $employeeLeaders,
         'myManagers' => $myManagers
      ]);
   }

   public function create()
   {
      $departments = Department::get();
      $subdepts = SubDept::get();
      $designations = Designation::get();
      $shifts = Shift::get();
      $units = Unit::get();
      $roles = Role::get();
      $positions = Position::get();

      return view('pages.employee.create', [
         'departments' => $departments,
         'subdepts' => $subdepts,
         'designations' => $designations,
         'shifts' => $shifts,
         'units' => $units,
         'roles' => $roles,
         'positions' => $positions
      ]);
   }

   public function store(Request $req)
   {
      $req->validate([
         'nik' => 'required|unique:employees',
         'first_name' => 'required',
         'last_name' => 'required',
         'department' => 'required',
         'email' => 'required|unique:users',
         'picture' => request('picture') ? 'image|mimes:jpg,jpeg,png|max:5120' : '',
      ]);

      // dd($req->department);
      try {
         $biodata = Biodata::create([
            'status' => 0,
            'first_name' => $req->first_name,
            'last_name' => $req->last_name,
            'gender' => $req->gender,
            'email' => $req->email,
            'phone' => $req->phone,
         ]);
      } catch (Exception $e) {
         return redirect()->back()->with('danger', $e->getMessage());
      }



      $contract = Contract::create([
         'id_no' => $req->nik,
         'type' => $req->type,


         'unit_id' => $req->unit,
         'department_id' => $req->department,
         'sub_dept_id' => $req->subdept,
         'designation_id' => $req->designation,
         'position_id' => $req->position,
         'shift_id' => $req->shift,
         'salary' => $req->salary,


         // 'hourly_rate' => $req->hourly_rate,
         // 'payslip' => $req->payslip,
         'start' => $req->start,
         'end' => $req->end,
         'determination' => $req->determination,
         'loc' => $req->loc,
         'desc' => $req->desc
      ]);

      $employee = Employee::create([
         'status' => 0,
         'nik' => $req->nik,
         'role' => $req->role,
         'unit_id' => $req->unit,
         'department_id' => $req->department,
         'sub_dept_id' => $req->subdept,
         'designation_id' => $req->designation,
         'position_id' => $req->position,
         'contract_id' => $contract->id,
         'biodata_id' => $biodata->id,
         'join' => $req->join,
         'picture' => request('picture') ? request()->file('picture')->store('employee/picture') : '',
      ]);

      $user = User::create([
         'name' => $employee->biodata->first_name . ' ' . $employee->biodata->last_name,
         'email' => $employee->biodata->email,
         'username' => $employee->nik,
         'password' => Hash::make('12345678')
      ]);

      $employee->update([
         'user_id' => $user->id
      ]);

      $employee->update([
         'user_id' => $user->id
      ]);

      if (auth()->user()->hasRole('Administrator')) {
         $departmentId = null;
      } else {
         $userNow = Employee::find(auth()->user()->getEmployeeId());
         $departmentId = $userNow->department_id;
      }


      Log::create([
         'department_id' => $departmentId,
         'user_id' => auth()->user()->id,
         'action' => 'Create',
         'desc' => 'Employee ' . $employee->nik . ' ' . $employee->biodata->fullname()
      ]);


      // Log::create([
      //    'department_id' => $departmentId,
      //    'user_id' => auth()->user()->id,
      //    'action' => 'Create',
      //    'desc' => 'Employee ' . $employee->nik . ' ' . $employee->biodata->fullname()
      // ]);




      // if ($req->designation == 1 || $req->designation == 2) {
      //    $employee->assignRole('Karyawan');
      // } else if ($employee->designation_id == 3) {
      //    $employee->assignRole('Leader');
      // } else if ($employee->designation_id == 4) {
      //    $employee->assignRole('Supervisor');
      // } else if ($employee->designation_id == 5) {
      //    $employee->assignRole('Asst. Manager');
      // } else if ($employee->designation_id == 6) {
      //    $employee->assignRole('Manager');
      // } else if ($employee->designation_id == 7) {
      //    $employee->assignRole('BOD');
      // }


      // return redirect()->route('employee.detail', [enkripRambo($employee->id), enkripRambo('contract')])->with('success', 'Employee successfully added');

      return redirect()->route('employee.draft')->with('success', 'Employee successfully added');
   }

   public function update(Request $req)
   {
      // $req->validate([]);
      $req->validate([]);

      $employee = Employee::find($req->employee);

      // dd($req->martial);


      $employee->biodata->update([
         'status' => $req->status,
         'first_name' => $req->first_name,
         'last_name' => $req->last_name,
         'birth_date' => $req->birth_date,
         'birth_place' => $req->birth_place,
         'religion' => $req->religion,
         'gender' => $req->gender,
         'marital' => $req->marital,
         'address' => $req->address,
         'email' => $req->email,
         'phone' => $req->phone,
         'post_code' => $req->post_code,
         'blood' => $req->blood,
         'citizenship' => $req->citizenship,
         'nationality' => $req->nationality,
         'state' => $req->state,
         'city' => $req->city,


      ]);

      $employee->update([
         'join' => $req->join
      ]);

      $user = User::where('username', $employee->nik)->first();
      $user->update([
         'email' => $req->email
      ]);

      if (auth()->user()->hasRole('Administrator')) {
         $departmentId = null;
      } else {
         $userNow = Employee::find(auth()->user()->getEmployeeId());
         $departmentId = $userNow->department_id;
      }
      Log::create([
         'department_id' => $departmentId,
         'user_id' => auth()->user()->id,
         'action' => 'Update',
         'desc' => 'Biodata ' . $employee->nik . ' ' . $employee->biodata->fullname()
      ]);

      return redirect()->route('employee.detail', [enkripRambo($employee->id), enkripRambo('basic')])->with('success', 'Employee successfully updated');
   }

   public function updateDoc(Request $req)
   {
      $req->validate([]);

      $employee = Employee::find($req->employee);
      $biodata = Biodata::find($employee->biodata_id);
      $biodata->update([
         'no_ktp' => $req->no_ktp,
         'no_kk' => $req->no_kk,
         'no_npwp' => $req->no_npwp,
         'status_pajak' => $req->status_pajak,
         'no_jamsostek' => $req->no_jamsostek,
         'no_bpjs_kesehatan' => $req->no_bpjs_kesehatan,
         'no_doc' => $req->no_doc
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
         'action' => 'Update',
         'desc' => 'Document Data ' . $employee->nik . ' ' . $employee->biodata->fullname()
      ]);

      return redirect()->route('employee.detail', [enkripRambo($employee->id), enkripRambo('basic')])->with('success', 'Employee Document successfully updated');
   }

   public function updateBio(Request $req)
   {
      $req->validate([]);

      $employee = Employee::find($req->employee);
      $employee->update([
         'bio' => $req->bio,
         'experience' => $req->experience
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
         'action' => 'Update',
         'desc' => 'Bio ' . $employee->nik . ' ' . $employee->biodata->fullname()
      ]);

      return redirect()->route('employee.detail', [enkripRambo($employee->id), enkripRambo('basic')])->with('success', 'Employee Bio successfully updated');
   }

   public function updatePicture(Request $req)
   {
      // dd(request('picture'));
      $req->validate([
         'picture' => 'required|image|mimes:jpg,jpeg,png|max:10240'
      ]);
      // dd('ok');

      // 'picture' => 'required|image|mimes:jpg,jpeg,png'

      $employee = Employee::find($req->employee);

      if (request('picture')) {
         Storage::delete($employee->picture);
         $picture = request()->file('picture')->store('images/employee/picture');
      } elseif ($employee->picture) {
         $picture = $employee->picture;
      } else {
         $picture = null;
      }

      $employee->update([
         'picture' => $picture
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
         'action' => 'Update',
         'desc' => 'Profile Picture ' . $employee->nik . ' ' . $employee->biodata->fullname()
      ]);

      return redirect()->route('employee.detail', [enkripRambo($employee->id), enkripRambo('basic')])->with('success', 'Employee successfully updated');
   }

   public function removePicture($id)
   {
      $employee = Employee::find(dekripRambo($id));

      if ($employee->picture) {
         Storage::delete($employee->picture);
      }

      $employee->update([
         'picture' => null
      ]);

      return redirect()->route('employee.detail', [enkripRambo($employee->id), enkripRambo('basic')])->with('success', 'Employee successfully updated');
   }


   public function updateRole(Request $req)
   {
      $employee = Employee::find($req->employee);
      $role = Role::find($req->role);
      // dd($role);
      $user = User::where('username', $employee->nik)->first();


      $user->roles()->detach();

      $employee->update([
         'role' => $req->role
      ]);
      $user->assignRole($role->name);

      if ($employee->department->slug == 'hrd') {
         $role2 = Role::find($req->role2);
         // dd($role2);
         $employee->update([
            'role2' => $req->role2
         ]);
         $user->assignRole($role2->name);
      }
      // dd($req->role);



      // $user = Employee::find(auth()->user()->getEmployeeId());
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
         'desc' => 'Role ' . $employee->nik . ' ' . $employee->biodata->fullname()
      ]);

      return redirect()->route('employee.detail', [enkripRambo($employee->id), enkripRambo('account')])->with('success', 'Employee successfully updated');
   }

   public function formExport()
   {
      $employees = Employee::where('status', 1)->get();
      $units = Unit::get();
      $locs = Location::get();

      $unit = 'All';
      $loc = 'All';
      $gender = 'All';
      $type = 'All';

      $export = false;

      return view('pages.employee.export-form', [
         'employees' => $employees,
         'units' => $units,
         'locs' => $locs,

         'unit' => $unit,
         'loc' => $loc,
         'gender' => $gender,
         'type' => $type,

         'export' => $export
      ])->with('i');
   }

   public function filter(Request $req)
   {
      if ($req->gender == 'All') {
         // dd('all');
         if ($req->type == 'All') {
            // dd('ok');
            $employees = Employee::join('biodatas', 'employees.biodata_id', '=', 'biodatas.id')
               ->join('contracts', 'employees.contract_id', '=', 'contracts.id')->where('contracts.loc', $req->loc)
               ->select('employees.*')->where('employees.unit_id', $req->unit)->where('employees.status', 1)->get();
         } else {
            // dd('okee');
            $employees = Employee::join('biodatas', 'employees.biodata_id', '=', 'biodatas.id')
               ->join('contracts', 'employees.contract_id', '=', 'contracts.id')->where('contracts.loc', $req->loc)
               ->where('contracts.type', $req->type)
               ->select('employees.*')->where('employees.unit_id', $req->unit)->where('employees.status', 1)->get();
            // dd($employees);
         }
      } else {
         if ($req->type == 'All') {
            $employees = Employee::join('biodatas', 'employees.biodata_id', '=', 'biodatas.id')->where('biodatas.gender', $req->gender)
               ->join('contracts', 'employees.contract_id', '=', 'contracts.id')->where('contracts.loc', $req->loc)
               ->select('employees.*')->where('employees.unit_id', $req->unit)->where('employees.status', 1)->get();
         } else {
            $employees = Employee::join('biodatas', 'employees.biodata_id', '=', 'biodatas.id')->where('biodatas.gender', $req->gender)
               ->join('contracts', 'employees.contract_id', '=', 'contracts.id')->where('contracts.loc', $req->loc)
               ->where('contracts.type', $req->type)
               ->select('employees.*')->where('employees.unit_id', $req->unit)->where('employees.status', 1)->get();
         }
      }

      // $pes = Pe::join('employees', 'pes.employe_id', '=', 'employees.id')
      //     ->where('employees.manager_id', $employee->id)
      //     ->where('pes.status', '>', '0')
      //     ->select('pes.*')
      //     ->orderBy('pes.release_at', 'desc')
      //     ->get();

      // dd($req->gender);
      // $employees = Employee::join('biodatas', 'employees.biodata_id', '=', 'biodatas.id')
      // ->where('biodatas.gender', $req->gender)         
      // ->join('contracts', 'employees.contract_id', '=', 'contracts.id')
      // ->where('contracts.loc', $req->loc)
      // ->where('contracts.type', $req->type)

      // ->select('employees.*')
      // ->where('employees.unit_id', $req->unit)
      // ->get();

      // dd($employees);
      $units = Unit::get();
      $locs = Location::get();

      $unit = $req->unit;
      $loc = $req->loc;
      $gender = $req->gender;
      $type = $req->type;

      $export = true;

      return view('pages.employee.export-form', [
         'employees' => $employees,
         'units' => $units,
         'locs' => $locs,

         'unit' => $unit,
         'loc' => $loc,
         'gender' => $gender,
         'type' => $type,

         'export' => $export
      ])->with('i');
   }

   public function export()
   {
      return Excel::download(new EmployeeExport, 'employee.xlsx');
   }

   public function exportSimple()
   {
      return Excel::download(new EmployeeSimpleExport, 'employee.xlsx');
   }

   public function formImport()
   {
      return view('pages.employee.import', [])->with('i');
   }

   public function formImportEdit()
   {
      return view('pages.employee.import-edit', [])->with('i');
   }

   public function import(Request $req)
   {
      // dd('ok');
      $req->validate([
         'excel' => 'required'
      ]);
      // dd('ok');
      $file = $req->file('excel');
      $fileName = $file->getClientOriginalName();
      $file->move('EmployeeData', $fileName);

      try {
         // Excel::import(new CargoItemImport($parent->id), $req->file('file-cargo'));
         Excel::import(new EmployeeImport, public_path('/EmployeeData/' . $fileName));
      } catch (Exception $e) {
         return redirect()->back()->with('danger', 'Import Failed ' . $e->getMessage());
      }

      // Excel::import(new EmployeeImport, public_path('/EmployeeData/' . $fileName));


      // if (auth()->user()->hasRole('Administrator')) {
      //    $departmentId = null;
      // } else {
      //    $user = Employee::find(auth()->user()->getEmployeeId());
      //    $departmentId = $user->department_id;
      // }
      // Log::create([
      //    'department_id' => $departmentId,
      //    'user_id' => auth()->user()->id,
      //    'action' => 'Import',
      //    'desc' => 'Data Karyawan
      // ]);

      return redirect()->route('employee.draft')->with('success', 'Employee Data successfully imported');
   }

   // public function export(){

   // }


   public function delete($id)
   {
      $dekripId = dekripRambo($id);
      $employee = Employee::find($dekripId);
      $user = User::where('username', $employee->nik)->first();
      $contract = Contract::find($employee->contract_id);
      $biodata = Biodata::find($employee->biodata_id);
      // dd($biodata->id);

      $nik = $employee->nik;
      $name = $employee->biodata->fullName();

      if ($contract) {
         $contract->delete();
      }

      if ($biodata) {
         $biodata->delete();
      }

      // if ($user) {
      if ($user) {
         $user->delete();
      }

      $employee->delete();

      if (auth()->user()->hasRole('Administrator')) {
         $departmentId = null;
      } else {
         $user = Employee::find(auth()->user()->getEmployeeId());
         $departmentId = $user->department_id;
      }
      Log::create([
         'department_id' => $departmentId,
         'user_id' => auth()->user()->id,
         'action' => 'Delete',
         'desc' => 'Employee ' . $nik . ' ' . $name
      ]);
      return redirect()->back()->with('success', 'Employee successfully deleted');
   }
}
