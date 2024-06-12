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
use App\Models\Position;
use App\Models\Role;
use App\Models\Shift;
use App\Models\Social;
use App\Models\SocialAccount;
use App\Models\Unit;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
   public function index($enkripTab)
   {
      $tab = dekripRambo($enkripTab);
      // dd($tab);
      $employees = Employee::where('status', 1)
         ->orderBy('department_id')
         ->orderBy('sub_dept_id')
         ->orderBy('designation_id')
         ->orderBy('position_id')
         ->get();
      $draftEmployees = Employee::where('status', 0)->get();
      return view('pages.employee.index', [
         'employees' => $employees,
         'draftEmployees' => $draftEmployees,
         'tab' => $tab,
         'departments' => Department::get()
      ])->with('i');
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

   public function publish(Request $req)
   {
      $req->validate([
         'id_item' => 'required',
      ]);

      $arrayItem = $req->id_item;
      $jumlah = count($arrayItem);

      for ($i = 0; $i < $jumlah; $i++) {
         $employee = Employee::find($arrayItem[$i]);

         try {
            $user = User::create([
               'name' => $employee->biodata->first_name . ' ' . $employee->biodata->last_name,
               'email' => $employee->biodata->email,
               'password' => Hash::make('12345678')
            ]);
         } catch (Exception $e) {
            return redirect()->back()->with('danger', 'Can not activate employee  ' . $employee->biodata->first_name . ' ' . $employee->biodata->last_name . ', Error log : ' . $e->getMessage());
         }

         $employee->update([
            'status' => 1,
            'user_id' => $user->id
         ]);

         $employee->biodata->update([
            'status' => 1,
         ]);

         $user->assignRole($employee->role);

         // Cek email apakah ada atau belum 

         $emailEnv = env('MAIL_FROM_ADDRESS');
         if ($emailEnv != null) {
            // jika ada kirim email
            // $user->sendEmailVerificationNotification();
         }
      }
      return redirect()->route('employee', enkripRambo('active'))->with('success', 'Employee successfully activated and Email Verification has ben sent.');
   }

   public function detail($id, $enkripPanel)
   {
      // $employee = auth()->user()->getEmployee();
      // // Data KPI
      // if (auth()->user()->hasRole('Administrator|HRD')) {

      //    // 
      // } else if (auth()->user()->hasRole('Leader|Manager')) {
      // }

      $dekripId = dekripRambo($id);
      $employee = Employee::find($dekripId);

      $departments = Department::get();
      $positions = Position::where('sub_dept_id', $employee->sub_dept_id)->get();

      $panel = dekripRambo($enkripPanel);
      $designations = Designation::get();
      $roles = Role::get();
      $shifts = Shift::get();
      $units = Unit::get();
      $socials = Social::get();
      $banks = Bank::get();

      $managers = Employee::where('department_id', $employee->department_id)->where('designation_id', 6)->get();
      $spvs = Employee::where('department_id', $employee->department_id)->where('designation_id', 4)->get();
      // dd($spvs);
      $leaders = Employee::where('department_id', $employee->department_id)->where('designation_id', 3)->get();

      // dd($employee->documents);
      // $panel = 'contract';
      // $tab = 'contract';


      return view('pages.employee.detail', [
         'employee' => $employee,
         'departments' => $departments,
         'designations' => $designations,
         'positions' => $positions,
         'roles' => $roles,
         'shifts' => $shifts,
         'units' => $units,
         'socials' => $socials,
         'banks' => $banks,
         'panel' => $panel,

         'managers' => $managers,
         'spvs' => $spvs,
         'leaders' => $leaders
         // 'tab' => $tab
      ]);
   }

   public function create()
   {
      $departments = Department::get();
      $designations = Designation::get();
      $shifts = Shift::get();
      $units = Unit::get();
      $roles = Role::get();

      return view('pages.employee.create', [
         'departments' => $departments,
         'designations' => $designations,
         'shifts' => $shifts,
         'units' => $units,
         'roles' => $roles
      ]);
   }

   public function store(Request $req)
   {
      $req->validate([
         'id' => 'required',
         'first_name' => 'required',
         'last_name' => 'required',
         'department' => 'required',
         'email' => 'required|unique:users',
         'picture' => request('picture') ? 'image|mimes:jpg,jpeg,png|max:5120' : '',
      ]);

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
         'id_no' => $req->id,
         'unit_id' => $req->unit,
         'department_id' => $req->department,
         'designation_id' => $req->designation,
         'shift_id' => $req->shift,
         'salary' => $req->salary,
         'hourly_rate' => $req->hourly_rate,
         'payslip' => $req->payslip,
         'desc' => $req->desc
      ]);

      $employee = Employee::create([
         'status' => 0,
         'role' => $req->role,
         'contract_id' => $contract->id,
         'biodata_id' => $biodata->id,
         'picture' => request('picture') ? request()->file('picture')->store('employee/picture') : '',
      ]);



      return redirect()->route('employee.detail', [enkripRambo($employee->id), enkripRambo('contract')])->with('success', 'Employee successfully saved');
   }

   public function update(Request $req)
   {
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
         'no_ktp' => $req->no_ktp,
         'no_kk' => $req->no_kk
      ]);

      $user = User::where('username', $employee->nik)->first();
      $user->update([
         'email' => $req->email
      ]);

      return redirect()->route('employee.detail', [enkripRambo($employee->id), enkripRambo('basic')])->with('success', 'Employee successfully updated');
   }

   public function updateBio(Request $req)
   {
      $req->validate([]);

      $employee = Employee::find($req->employee);
      $employee->update([
         'bio' => $req->bio,
         'experience' => $req->experience
      ]);

      return redirect()->route('employee.detail', [enkripRambo($employee->id), enkripRambo('personal')])->with('success', 'Employee Bio successfully updated');
   }

   public function updatePicture(Request $req)
   {
      $req->validate([
         // 'picture' => request('picture') ? 'image|mimes:jpg,jpeg,png|max:5120' : '',
      ]);

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

      return redirect()->route('employee.detail', [enkripRambo($employee->id), enkripRambo('basic')])->with('success', 'Employee successfully updated');
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

   public function import(Request $req)
   {
      $req->validate([
         'excel' => 'required'
      ]);
      $file = $req->file('excel');
      $fileName = $file->getClientOriginalName();
      $file->move('EmployeeData', $fileName);

      // try {
      //    Excel::import(new EmployeeImport, public_path('/EmployeeData/' . $fileName));
      // } catch (Exception $e) {
      //    return redirect()->back()->with('danger', 'Import Failed ' . $e->getMessage());
      // }

      Excel::import(new EmployeeImport, public_path('/EmployeeData/' . $fileName));




      return redirect()->route('employee.draft')->with('success', 'Employee Data successfully imported');
   }
}
