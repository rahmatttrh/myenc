<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Employee;
use App\Models\EmployeeLeader;
use App\Models\PeKpi;
use App\Models\Position;
use App\Models\SubDept;
use Illuminate\Http\Request;

class FuncController extends Controller
{
    public function updatePosition(){
        $subdept = SubDept::find(9);
        // dd($subdept->name);
        // $positions = Position::where('sub_dept_id', $subdept->id)->get();
        // foreach($positions as $pos){
        //     $pos->update([
        //         'department_id'
        //     ])
        // }

        $employees = Employee::where('sub_dept_id', 9)->get();
        $contract = Contract::where('sub_dept_id', 9)->get();
        $kpis = PeKpi::where('sub_dept_id', 9)->get();
        $employeeLeaders = EmployeeLeader::where('sub_dept_id', 9)->get();
        foreach($employees as $emp){
            $emp->update([
                'department_id' => $subdept->department_id
            ]);
        }
        foreach($contract as $con){
            $con->update([
                'department_id' => $subdept->department_id
            ]);
        }
        foreach($kpis as $kpi){
            $kpi->update([
                'departement_id' => $subdept->department_id
            ]);
        }
        foreach($employeeLeaders as $empLeader){
            $empLeader->update([
                'department_id' => $subdept->department_id
            ]);
        }

        dd('data updated');

    }
}
