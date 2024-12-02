<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Employee;
use App\Models\EmployeeLeader;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   public function index()
   {
      // $tasks = Task::get();
      // foreach($tasks as $task){
      //     $task->employees()->attach($task->employee_id);
      // }


      if (auth()->user()->hasRole('Administrator')) {
         $employee = null;
         // $employee = Employee::where('nik', auth()->user()->username)->first();
         $tasks = Task::orderBy('status', 'desc')->get();
         $myteams = [];
         $myTasks = [];
      } elseif (auth()->user()->hasRole('Karyawan')) {
         $employee = Employee::where('nik', auth()->user()->username)->first();
         // dd($empeloyee);
         $tasks = Task::orderBy('status', 'asc')->where('employee_id', $employee->id)->get();
         $myteams = [];
         $myTasks = [];
      } elseif (auth()->user()->hasRole('Manager')) {
         $employee = Employee::where('nik', auth()->user()->username)->first();
         $myteams = [];
         $tasks = Task::where('department_id', $employee->department_id)->orderBy('status', 'asc')->get();
         $myTasks = Task::orderBy('status', 'asc')->where('employee_id', $employee->id)->get();
      } else {
         $employee = Employee::where('nik', auth()->user()->username)->first();
         $myteams = EmployeeLeader::join('employees', 'employee_leaders.employee_id', '=', 'employees.id')
            ->join('biodatas', 'employees.biodata_id', '=', 'biodatas.id')
            ->where('leader_id', $employee->id)
            ->select('employees.*')
            ->orderBy('biodatas.first_name', 'asc')
            ->get();
         $tasks = Task::orderBy('status', 'asc')->get();
         $myTasks = Task::orderBy('status', 'asc')->where('employee_id', $employee->id)->get();
      }




      return view('pages.task.index', [
         'employee' => $employee,
         'tasks' => $tasks,
         'myteams' => $myteams,
         'myTasks' => $myTasks
      ])->with('i');
   }

   public function history()
   {

      if (auth()->user()->hasRole('Administrator')) {
         $employee = null;
         $tasks = Task::get();
         $myteams = [];
         $myTasks = [];
      } elseif (auth()->user()->hasRole('Karyawan')) {
         $employee = Employee::where('nik', auth()->user()->username)->first();
         $tasks = Task::where('employee_id', $employee->id)->get();

         $myteams = [];
         $myTasks = [];
      } else {
         $employee = Employee::where('nik', auth()->user()->username)->first();
         $myteams = EmployeeLeader::join('employees', 'employee_leaders.employee_id', '=', 'employees.id')
            ->join('biodatas', 'employees.biodata_id', '=', 'biodatas.id')
            ->where('leader_id', $employee->id)
            ->select('employees.*')
            ->orderBy('biodatas.first_name', 'asc')
            ->get();
         $tasks = Task::get();
         $myTasks = Task::where('employee_id', $employee->id)->get();
      }


      return view('pages.task.history', [
         'employee' => $employee,
         'tasks' => $tasks,
         'myteams' => $myteams,
         'myTasks' => $myTasks
      ])->with('i');
   }

   public function addPic(Request $req)
   {
      $task = Task::find($req->task);
      $task->employees()->attach($req->employee);

      return redirect()->back()->with('success', 'PIC successfully added');
   }

   public function create()
   {
      // dd('ok');
      $task = Task::get();

      if (auth()->user()->hasRole('Administrator')) {
         $employee = Employee::where('nik', 'EN-4-095')->first();

         $myteams = Employee::get();
         $myTasks = [];
         $myteams = EmployeeLeader::join('employees', 'employee_leaders.employee_id', '=', 'employees.id')
            ->join('biodatas', 'employees.biodata_id', '=', 'biodatas.id')
            ->where('leader_id', 10)
            ->select('employees.*')
            ->orderBy('biodatas.first_name', 'asc')
            ->get();
         //   dd($myteams);
      } elseif (auth()->user()->hasRole('Karyawan')) {
         $employee = Employee::where('nik', auth()->user()->username)->first();

         $myteams = [];
         $myTasks = [];
      } else {
         $employee = Employee::where('nik', auth()->user()->username)->first();
         $myteams = EmployeeLeader::join('employees', 'employee_leaders.employee_id', '=', 'employees.id')
            ->join('biodatas', 'employees.biodata_id', '=', 'biodatas.id')
            ->where('leader_id', $employee->id)
            ->select('employees.*')
            ->orderBy('biodatas.first_name', 'asc')
            ->get();
      }

      return view('pages.task.create', [
         'task' => $task,
         'employee' => $employee,
         'myteams' => $myteams
      ])->with('i');
   }

   public function store(Request $req)
   {
      $req->validate([]);
      // dd($req->pic);

      $employee = Employee::where('nik', auth()->user()->username)->first();

      $task = Task::create([
         'unit_id' => $employee->unit_id,
         'department_id' => $employee->department_id,
         'employee_id' => $req->pic,
         'category' => $req->kategori,
         'plan' => $req->plan,
         'target' => $req->target,
         'status' => 0
      ]);

      $task->employees()->attach($employee->id);

      return redirect()->route('task')->with('success', 'Task List successfully added');
   }

   public function detail($id)
   {
      $task = Task::find(dekripRambo($id));
      if (auth()->user()->hasRole('Karyawan|Leader|Asst. Manager|Manafer|Supervisor')) {
         $currentEmployee = Employee::where('nik', auth()->user()->username)->first();
         $employees = Employee::where('unit_id', $currentEmployee->unit_id)->get();
      } else {
         $employees = Employee::get();
      }
      $chats = Chat::where('task_id', $task->id)->get();
      return view('pages.task.detail', [
         'task' => $task,
         'chats' => $chats,
         'employees' => $employees
      ]);
   }

   public function update(Request $req)
   {
      $task = Task::find($req->task);
      $req->validate([
         'desc' => 'required',
         // 'evidence' => 'required'
      ]);

      if ($req->evidence) {
         $evidence = request()->file('evidence')->store('images/task');
      } else {
         $evidence = null;
      }
      // $evidence = request()->file('evidence')->store('images/task');

      if ($req->status == 2) {
         $task->update([
            'status' => 2,
            'closed' => $req->date,
            'evidence' => $evidence,
            'desc' => $req->desc
         ]);
      } else {
         $task->update([
            'status' => $req->status,
            'evidence' => $evidence,
            'desc' => $req->desc
         ]);
      }

      return redirect()->back()->with('success', 'Task successfully updated');
   }

   public function delete($id)
   {
      $task = Task::find(dekripRambo($id));
      $task->delete();

      return redirect()->route('task')->with('success', 'Task successfully deleted');
   }
}
