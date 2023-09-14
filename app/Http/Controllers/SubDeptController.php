<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\SubDept;
use Illuminate\Http\Request;

class SubDeptController extends Controller
{
    // Fetch Data
    public function fetchData($id)
    {
        // Mengambil data dari database menggunakan model
        $data = SubDept::where('id', $id)->first();
        $positions = Position::where('sub_dept_id', $id)->orderBy('name')->get();

        // Mengembalikan data dalam format JSON
        return response()->json([
            'data' => $data,
            'positions' => $positions
        ]);
    }
}
