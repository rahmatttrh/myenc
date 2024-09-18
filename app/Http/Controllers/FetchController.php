<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeLeader;
use App\Models\Position;
use App\Models\Sp;
use App\Models\SubDept;
use Illuminate\Http\Request;

class FetchController extends Controller
{
   public function fetchSpActive($id){
      $employee = Employee::find($id);
      $spActives = Sp::where('employee_id', $employee->id)->where('status', '>=', 1)->get();
      $result = array();

      $result[] = "
         <tr class='bg-danger text-white'> 
            <th  colspan='4'  >SP " . $employee->biodata->first_name  . " &nbsp " . $employee->biodata->last_name  . " </th>
         </tr>
      ";

      foreach ($spActives as $row) {
            
         $result[] = '<tr>
         <td> ' . $row->code . '  </td>
         <td>SP ' . $row->level . ' </td>
            <td>
              Pelanggaran ' . $row->rule . ' 
            </td>
            
            
            <td>Active until ' . \Carbon\Carbon::parse($row->date_to)->format('d-m-Y')  .'</td>
            
         </tr>';
      }

      if (count($spActives) > 0) {
         $success = true;
      } else {
         $success = false;
      }

      return response()->json([
         'success' => $success,
         'msg' => 'success fetch',
         'result' => $result
      ]);
   }

   public function fetchDepartment($id){
      $departments = Department::where('unit_id', $id)->get();

      // Masukin ke array
      $result = array();
      $result[] = '<option selected disabled value="">Select</option>';
      foreach ($departments as $row) {
         $result[] = '<option value="' . $row->id . '">' .  $row->name . '</option>';
      }

      // Kirim balik ke ajax
      return response()->json([
         'success' => true,
         'result' => $result

      ]);
   }

   public function fetchSubdept($id){
      $subdepts = SubDept::where('department_id', $id)->get();
      $managers = Employee::where('department_id', $id)->where('designation_id', 6)->get();
      $leaders = Employee::where('designation_id', 3)->orWhere('designation_id', 4)->where('department_id', $id)->get();
      // Masukin ke array
      $result = array();
      $result[] = '<option selected disabled value="">Select</option>';
      foreach ($subdepts as $row) {
         $result[] = '<option value="' . $row->id . '">' .  $row->name . '</option>';
      }

      $resultManager = array();
      $resultManager[] = '<option selected disabled value="">Select</option>';
      foreach ($managers as $row) {
         $resultManager[] = '<option value="' . $row->id . '">' .  $row->biodata->first_name  . ' ' . $row->biodata->last_name . '</option>';
      }

      $resultLeader = array();
      $resultLeader[] = '<option selected disabled value="">Select</option>';
      foreach ($leaders as $row) {
         $resultLeader[] = '<option value="' . $row->id . '">' .  $row->biodata->first_name  . ' ' . $row->biodata->last_name . '</option>';
      }



      // Kirim balik ke ajax
      return response()->json([
         'success' => true,
         'result' => $result,
         'manager' => $resultManager,
         'leader' => $resultLeader
      ]);
   }

   public function fetchPosition($id){
      $positions = Position::where('sub_dept_id', $id)->get();

      // Masukin ke array
      $result = array();
      $result[] = '<option selected disabled value="">Select</option>';
      foreach ($positions as $row) {
         $result[] = '<option value="' . $row->id . '">' .  $row->name . '</option>';
      }

      // Kirim balik ke ajax
      return response()->json([
         'success' => true,
         'result' => $result

      ]);
   }

   public function fetchLeader($id)
   {
      $employee = Employee::find($id);
      // dd($employee);
      $leaders = EmployeeLeader::where('employee_id', $employee->id)->get();

      // Masukin ke array
      $result = array();
      $result[] = '<option selected disabled value="">Select</option>';
      foreach ($leaders as $row) {
         $result[] = '<option value="' . $row->leader_id . '">' . $row->leader->nik . ' ' . $row->leader->biodata->fullName() . '</option>';
      }

      // Kirim balik ke ajax
      return response()->json([
         'success' => true,
         'result' => $result

      ]);
   }
}
