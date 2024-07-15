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
use App\Models\Log;
use App\Models\Position;
use App\Models\Role;
use App\Models\Shift;
use App\Models\Social;
use App\Models\SocialAccount;
use App\Models\SubDept;
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
      // $employees = Employee::where('status', 1)
      //    ->orderBy('department_id')
      //    ->orderBy('sub_dept_id')
      //    ->orderBy('designation_id')
      //    ->orderBy('position_id')
      //    ->get();
         $employees = Employee::where('status', 1)
         ->orderBy('updated_at', 'desc')
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

   public function publishSingle($id){
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

         $employee->update([
            'status' => 1,
            // 'user_id' => $user->id
         ]);

         $employee->biodata->update([
            'status' => 1,
         ]);

         // $user->assignRole('Karyawan');

         // if (auth()->user()->hasRole('Administrator')) {
         //    $departmentId = null;
         // } else {
         //    $user = Employee::find(auth()->user()->getEmployeeId());
         //    $departmentId = $user->department_id;
         // }
         // Log::create([
         //    'department_id' => $departmentId,
         //    'user_id' => auth()->user()->id,
         //    'action' => 'Publish',
         //    'desc' => 'Employee ' . $employee->nik . ' ' . $employee->biodata->fullname()
         // ]);
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

      // if (auth()->user()->hasRole('Administrator')) {
      //    $departmentId = null;
      // } else {
      //    $user = Employee::find(auth()->user()->getEmployeeId());
      //    $departmentId = $user->department_id;
      // }
      // Log::create([
      //    'department_id' => $departmentId,
      //    'user_id' => auth()->user()->id,
      //    'action' => 'Publish',
      //    'desc' => 'Employees Data'
      // ]);
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

      $dekripId = dekripRambo($id);
      $employee = Employee::find($dekripId);
      $contracts = Contract::where('id_no', $employee->nik)->where('status', 0)->get();
      // dd($contracts);

      $departments = Department::where('unit_id', $employee->unit_id)->get();
      // dd($employee->id);
      $positions = Position::where('sub_dept_id', $employee->sub_dept_id)->get();
      $allPositions = Position::get();

      $panel = dekripRambo($enkripPanel);
      $designations = Designation::get();
      $roles = Role::get();
      $shifts = Shift::get();
      $units = Unit::get();
      $socials = Social::get();
      $banks = Bank::get();

      // $managers = Employee::where('department_id', $employee->department_id)->where('designation_id', 6)->get();
      // $spvs = Employee::where('department_id', $employee->department_id)->where('designation_id', 4)->get();
      // $leaders = Employee::where('department_id', $employee->department_id)->where('designation_id', 3)->get();

      $managers = Employee::where('designation_id', 6)->get();
      $spvs = Employee::where('designation_id', 4)->where('department_id', $employee->department_id)->get();
      $leaders = Employee::where('designation_id', 3)->where('department_id', $employee->department_id)->get();

      // dd($employee->documents);
      // $panel = 'contract';
      // $tab = 'contract';

      $allManagers = Employee::where('designation_id', 6)->get();
      $allSpvs = Employee::where('designation_id', 4)->get();
      // dd($spvs);
      $allLeaders = Employee::where('designation_id', 3)->get();
      $subdepts = SubDept::where('department_id', $employee->department_id)->get();


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
         'leaders' => $leaders,

         'allManagers' => $allManagers,
         'allSpvs' => $allSpvs,
         'allLeaders' => $allLeaders,

         'subdepts' => $subdepts,
         'contracts' => $contracts
         // 'tab' => $tab
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
         'picture' => request('picture') ? request()->file('picture')->store('employee/picture') : '',
      ]);

      $user = User::create([
         'name' => $employee->biodata->first_name . ' ' . $employee->biodata->last_name,
         'email' => $employee->biodata->email,
         'username' => $employee->nik,
         'password' => Hash::make('12345678')
      ]);

      // if (auth()->user()->hasRole('Administrator')) {
      //    $departmentId = null;
      // } else {
      //    $userNow = Employee::find(auth()->user()->getEmployeeId());
      //    $departmentId = $userNow->department_id;
      // }
      //    Log::create([
      //       'department_id' => $departmentId,
      //       'user_id' => auth()->user()->id,
      //       'action' => 'Create',
      //       'desc' => 'Employee ' . $employee->nik . ' ' . $employee->biodata->fullname()
      //    ]);

      

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
      $req->validate([

      ]);

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

      $employee->update([
         'join' => $req->join
      ]);

      $user = User::where('username', $employee->nik)->first();
      $user->update([
         'email' => $req->email
      ]);

      // if (auth()->user()->hasRole('Administrator')) {
      //    $departmentId = null;
      // } else {
      //    $userNow = Employee::find(auth()->user()->getEmployeeId());
      //    $departmentId = $userNow->department_id;
      // }
      // Log::create([
      //    'department_id' => $departmentId,
      //    'user_id' => auth()->user()->id,
      //    'action' => 'Update',
      //    'desc' => 'Biodata ' . $employee->nik . ' ' . $employee->biodata->fullname()
      // ]);

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
         'no_bpjs_kesehatan' => $req->no_bpjs_kesehatan
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

   public function updateRole(Request $req){
      $employee = Employee::find($req->employee);
      $role = Role::find($req->role);
      $user = User::where('username', $employee->nik)->first();
      $employee->update([
         'role' => $req->role
      ]);
      $user->roles()->detach();
      $user->assignRole($role->name);
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




      return redirect()->route('employee.draft')->with('success', 'Employee Data successfully imported');
   }

   public function delete($id){
      $dekripId = dekripRambo($id);
      $employee = Employee::find($dekripId);
      $user = User::where('username', $employee->nik)->first();
      $contract = Contract::find($employee->contract_id);
      $biodata = Biodata::find($employee->biodata_id);
      // dd($biodata->id);

      if ($contract) {
         $contract->delete();
      }

      if ($biodata) {
         $biodata->delete();
      }

      if($user){
         $user->delete();
      }

      $employee->delete();
      return redirect()->back()->with('success', 'Employee successfully deleted');
   }
}
