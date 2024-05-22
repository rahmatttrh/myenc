<?php

namespace App\Http\Controllers;

use App\Models\Composition;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Position;
use App\Models\SubDept;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompositionController extends Controller
{
    //
    function komposisi()
    {
        $compositions = Composition::orderBy('bisnis_unit')
            ->orderBy('departemen')
            ->orderBy('sub_dept')
            ->orderBy('jabatan')
            ->get();

        $sukses = 0;
        // $compositions = DB::select('SELECT * FROM compositions');
        foreach ($compositions as $key => $data) {
            // Bisnis Unit 

            $bisnisUnit = Unit::where('name', $data->bisnis_unit)->first();

            // JIKA BELUM ADA BISNIS UNIT TERSEBUT
            if ($bisnisUnit == null) {
                $bisnisUnit = Unit::create([
                    'name' => $data->bisnis_unit,
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ]);
            }

            $departemen = Department::where('name', $data->departemen)->first();
            // Jika belum ada departemn
            if ($departemen == null) {
                $departemen = Department::create([
                    'unit_id' => $bisnisUnit->id,
                    'name' => $data->departemen,
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ]);
            }

            // jika belum ada sub departement
            $subDept = SubDept::where('name', $data->sub_dept)->first();

            if ($subDept == null) {
                $subDept = SubDept::create([
                    'department_id' => $departemen->id,
                    'name' => $data->sub_dept,
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ]);
            }

            $designation = Designation::where('golongan', $data->golongan)->first();

            $insert = Position::create([
                'name' => $data->jabatan,
                'ideal' => $data->ideal,
                'fulfillment' => $data->fulfillment,
                'vacant' => $data->vacant,
                'report_to' => $data->report_to,
                'sub_dept_id' => $subDept->id,
                'designation_id' => $designation->id,
            ]);

            if ($insert) {
                $sukses++;
            }
        }
        // ECHO 
        dd($sukses);
    }
}
