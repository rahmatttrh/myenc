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

      // dd('ok');
      if (auth()->user()->hasRole('Administrator')) {
         $employee = null;
         // $employee = Employee::where('nik', auth()->user()->username)->first();
         $tasks = Task::where('status', '!=', 2)->orderBy('status', 'desc')->get();
         $historyTasks = Task::where('status', 2)->orderBy('status', 'desc')->get();
         $myteams = [];
         $myTasks = [];
      } elseif (auth()->user()->hasRole('Manager|Asst. Manager')) {
         // dd('manager');
         $employee = Employee::where('nik', auth()->user()->username)->first();
         $myteams = [];
         // $tasks = [];
         // $historyTasks = [];
         $tasks = Task::orderBy('status', 'asc')->where('employee_id', $employee->id)->get();
         $historyTasks = Task::where('status', 2)->orderBy('status', 'asc')->where('employee_id', $employee->id)->get();
         // dd('manager');
         if (count($employee->positions) > 0) {

            foreach ($employee->positions as $emPos) {
               // dd($emPos->department_id);
               // $tasks[] = Task::where('status', '!=', 2)->where('department_id', $emPos->department_id)->orderBy('status', 'asc')->get();
               $historyTasks[] = Task::where('status', 2)->where('department_id', $emPos->department_id)->orderBy('status', 'asc')->get();

               $getTasks = Task::where('status', '!=', 2)->where('department_id', $emPos->department_id)->orderBy('status', 'asc')->get();
               foreach ($getTasks as $gt) {
                  $tasks->push($gt);
               }
            }
         } else {
            // $tasks = Task::where('status', '!=', 2)->where('department_id', $employee->department_id)->orderBy('status', 'asc')->get();
            $getTasks = Task::where('status', '!=', 2)->where('department_id', $employee->department_id)->orderBy('status', 'asc')->get();
            foreach ($getTasks as $gt) {
               $tasks->push($gt);
            }

            $getHistoryTasks = Task::where('status', 2)->where('department_id', $employee->department_id)->orderBy('status', 'asc')->get();
            foreach ($getHistoryTasks as $ght) {
               $historyTasks->push($ght);
            }
            // $historyTasks = Task::where('status', 2)->where('department_id', $employee->department_id)->orderBy('status', 'asc')->get();
         }

         // dd($myTasks);
      } elseif (auth()->user()->hasRole('Karyawan')) {

         $employee = Employee::where('nik', auth()->user()->username)->first();
         // dd('karyawan');
         $tasks = Task::where('status', '!=', 2)->orderBy('status', 'asc')->where('employee_id', $employee->id)->get();
         $historyTasks = Task::where('status', 2)->where('employee_id', $employee->id)->orderBy('status', 'desc')->get();
         $myteams = [];
         $myTasks = [];
      } else {
         // dd('ok');
         $employee = Employee::where('nik', auth()->user()->username)->first();
         $myteams = EmployeeLeader::join('employees', 'employee_leaders.employee_id', '=', 'employees.id')
            ->join('biodatas', 'employees.biodata_id', '=', 'biodatas.id')
            ->where('leader_id', $employee->id)
            ->select('employees.*')
            ->orderBy('biodatas.first_name', 'asc')
            ->get();
         // dd($myteams);
         // $tasks = Task::where('status', '!=', 2)->orderBy('status', 'asc')->get();
         // $historyTasks = Task::where('status', 2)->orderBy('status', 'asc')->get();
         $tasks = Task::where('status', '!=', 2)->orderBy('status', 'asc')->where('employee_id', $employee->id)->get();
         $historyTasks = Task::where('status', 2)->orderBy('status', 'asc')->where('employee_id', $employee->id)->get();

         foreach ($myteams as $team) {
            $getTasks = Task::where('status', '!=', 2)->where('employee_id', $team->id)->orderBy('status', 'asc')->get();
            foreach ($getTasks as $ght) {
               $tasks->push($ght);
            }

            $getHistoryTasks = Task::where('status', 2)->where('employee_id', $team->id)->orderBy('status', 'asc')->get();
            foreach ($getHistoryTasks as $ght) {
               $historyTasks->push($ght);
            }
         }
      }




      return view('pages.task.index', [
         'employee' => $employee,
         'tasks' => $tasks,
         'historyTask' => $historyTasks,
         'myteams' => $myteams,
         // 'myTasks' => $myTasks,
         // 'myHistoryTasks' => $myHistoryTasks,
      ])->with('i');
   }

   public function history()
   {

      if (auth()->user()->hasRole('Administrator')) {
         // dd('ok');
         $employee = null;
         $historyTasks = Task::where('status', 2)->get();
         $myteams = [];
         $myTasks = [];
         // dd($historyTasks);
      } elseif (auth()->user()->hasRole('Karyawan')) {
         $employee = Employee::where('nik', auth()->user()->username)->first();
         $historyTasks = Task::where('status', 2)->where('employee_id', $employee->id)->get();

         $myteams = [];
         $myTasks = [];
      } elseif (auth()->user()->hasRole('Manager|Asst. Manager')) {
         $employee = Employee::where('nik', auth()->user()->username)->first();
         $myteams = [];
         // $tasks = [];
         // $historyTasks = [];
         // $tasks = Task::orderBy('status', 'asc')->where('employee_id', $employee->id)->get();
         $historyTasks = Task::where('status', 2)->orderBy('status', 'asc')->where('employee_id', $employee->id)->get();
         // dd('manager');
         if (count($employee->positions) > 0) {

            foreach ($employee->positions as $emPos) {
               // dd($emPos->department_id);
               // $tasks[] = Task::where('status', '!=', 2)->where('department_id', $emPos->department_id)->orderBy('status', 'asc')->get();
               $historyTasks[] = Task::where('status', 2)->where('department_id', $emPos->department_id)->orderBy('status', 'asc')->get();

               $getTasks = Task::where('status', 2)->where('department_id', $emPos->department_id)->orderBy('status', 'asc')->get();
               foreach ($getTasks as $gt) {
                  $historyTasks->push($gt);
               }
            }
         } else {
            // $tasks = Task::where('status', '!=', 2)->where('department_id', $employee->department_id)->orderBy('status', 'asc')->get();
            $getTasks = Task::where('status', 2)->where('department_id', $employee->department_id)->orderBy('status', 'asc')->get();
            foreach ($getTasks as $gt) {
               $historyTasks->push($gt);
            }

            $getHistoryTasks = Task::where('status', 2)->where('department_id', $employee->department_id)->orderBy('status', 'asc')->get();
            foreach ($getHistoryTasks as $ght) {
               $historyTasks->push($ght);
            }
            // $historyTasks = Task::where('status', 2)->where('department_id', $employee->department_id)->orderBy('status', 'asc')->get();
         }
      } else {
         $employee = Employee::where('nik', auth()->user()->username)->first();
         $myteams = EmployeeLeader::join('employees', 'employee_leaders.employee_id', '=', 'employees.id')
            ->join('biodatas', 'employees.biodata_id', '=', 'biodatas.id')
            ->where('leader_id', $employee->id)
            ->select('employees.*')
            ->orderBy('biodatas.first_name', 'asc')
            ->get();
         $tasks = Task::get();

         $historyTasks = Task::where('status', 2)->where('employee_id', $employee->id)->get();
         $getHistoryTasks = Task::where('status', 2)->orderBy('status', 'asc')->get();
         foreach ($getHistoryTasks as $ght) {
            $historyTasks->push($ght);
         }
      }


      return view('pages.task.history', [
         'employee' => $employee,
         // 'tasks' => $tasks,
         'myteams' => $myteams,
         // 'myTasks' => $myTasks,
         'historyTasks' => $historyTasks
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
