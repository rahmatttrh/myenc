<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\PeKpa;
use App\Models\PekpaDetail;
use App\Models\PeKpi;
use App\Models\PekpiDetail;
use Illuminate\Http\Request;

class PeKpaController extends Controller
{
    public function index()
    {

        $kpis = PeKpi::get();
        $kpas = PeKpa::orderBy('date', 'desc')
            ->orderBy('employe_id')
            ->get();

        $designations = Designation::orderBy('name')->get();
        $departements = Department::orderBy('name')->get();

        $employes = Employee::where('status', '1')
            ->whereNotNull('kpi_id')
            ->get();



        return view('pages.kpa.kpa', [
            'designations' => $designations,
            'departements' => $departements,
            'kpis' => $kpis,
            'kpas' => $kpas,
            'employes' => $employes
        ])->with('i');
    }

    // Store Apprasial
    public function store(Request $req)
    {
        $req->validate([
            'kpi_id' => 'required',
            'employe_id' => 'required',
            'date' => 'required'
        ]);

        // Validasi KPA
        $cek = PeKpa::where([
            'employe_id' => $req->employe_id,
            'date' => $req->date
        ])->first();



        if ($cek) {
            return redirect()->back()->with('danger', 'KPA Karyawan di bulan tersebut sudah ada');
        }

        $kpa = PeKpa::create([
            'kpi_id' => $req->kpi_id,
            'employe_id' => $req->employe_id,
            'date' => $req->date,
        ]);

        $acvTotal = 0;

        $arrays = $req->qty;
        foreach ($arrays as $kpidetail_id => $value) {

            $pdfFile = $req->attachment[$kpidetail_id];

            $pdfFileName = time() . '_' . $kpidetail_id . '.pdf';
            $pdfFile->storeAs('kpa-evidence', $pdfFileName, 'public');

            // Cek KPI Detail
            $kpiDetail = PekpiDetail::find($kpidetail_id);

            // dd($kpiDetail);

            $achievement = round(($value / $kpiDetail->target) * $kpiDetail->weight);

            $kpaDetail = PekpaDetail::create([
                'kpa_id' => $kpa->id,
                'kpidetail_id' => $kpidetail_id,
                'value' => $value,
                'achievement' => $achievement,
                'evidence' => 'kpa-evidence/' . $pdfFileName
            ]);

            $acvTotal += $achievement;
        }

        $kpa = PeKpa::where('id', $kpa->id)
            ->update([
                'achievement' => $acvTotal
            ]);

        return redirect()->back()->with('success', 'KPI successfully added');
    }

    public function edit($id)
    {

        $kpa = PeKpa::find(dekripRambo($id));
        $datas = PekpaDetail::where('kpa_id', $kpa->id)->get();
        $employes = Employee::where('status', '1')
            ->whereNotNull('kpi_id')
            ->get();

        // dd($datas);


        if (!isset($kpa)) {
            return back()->with('danger', 'Id KPA Anda Salah');
        }

        return view('pages.kpa.kpa-edit', [
            'kpa' => $kpa,
            'employes' => $employes,
            'datas' => $datas
        ])->with('i');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id' => 'required',
            'value' => 'required',
            'achievement' => 'required'
        ]);


        if ($request->attachment) {
            # code...
            $pdfFile = $request->attachment;

            $pdfFileName = time() . '_' . $request->id . '.pdf';
            $pdfFile->storeAs('kpa-evidence', $pdfFileName, 'public');

            $return = PekpaDetail::where('id', $request->id)
                ->update([
                    'value' => $request->value,
                    'achievement' => $request->achievement,
                    'evidence' => 'kpa-evidence/' . $pdfFileName
                ]);
        } else {

            $return = PekpaDetail::where('id', $request->id)
                ->update([
                    'value' => $request->value,
                    'achievement' => $request->achievement
                ]);
        }

        $acvTotal = PekpaDetail::where('kpa_id', $request->kpa_id)->sum('achievement');

        $updateKpa = PeKpa::where('id', $request->kpa_id)
            ->update([
                'achievement' => $acvTotal
            ]);

        if ($updateKpa) {
            return redirect()->back()->with('success', 'Data successfully Updated');
        } else {
            return redirect()->back()->with('danger', 'Failed');
        }
    }
}
