<?php

namespace App\Http\Controllers;

use App\Models\PekpiDetail;
use Illuminate\Http\Request;

class PekpiDetailController extends Controller
{
    public function store(Request $req)
    {

        $req->validate([
            'kpi_id' => 'required',
            'metode' => 'required',
            'objective' => 'required',
            'kpi' => 'required',
            'weight' => 'required',
            'target' => 'required',
            'priode_target' => 'required'
        ]);


        PekpiDetail::create([
            'kpi_id' => $req->kpi_id,
            'metode' => $req->metode,
            'objective' => $req->objective,
            'kpi' => $req->kpi,
            'weight' => $req->weight,
            'target' => $req->target,
            'priode_target' => $req->priode_target
        ]);

        return redirect()->back()->with('success', 'Objective KPI successfully added');
    }
}
