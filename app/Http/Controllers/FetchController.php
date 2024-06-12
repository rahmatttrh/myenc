<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Sp;
use Illuminate\Http\Request;

class FetchController extends Controller
{
   public function fetchSpActive($id){
      $employee = Employee::find($id);
      $spActives = Sp::where('employee_id', $employee->id)->where('status', 1)->get();
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
}
