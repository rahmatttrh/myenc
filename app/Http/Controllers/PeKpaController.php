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
use Illuminate\Support\Facades\DB;

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
        $datas = PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '0')->get();
        // Additional 
        $addtional = PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '1')->first();
        // dd($addtional);

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
            'addtional' => $addtional,
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

        // Untuk mengakomodir jika semua achievment di tambah lebih dari 100
        if ($acvTotal > 100) {
            $acvTotal = 100;
        }

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



    public function storeAddtional(Request $request, $id)
    {
        $request->validate([
            'kpa_id' => 'required',
            'objective' => 'required',
            'weight' => 'required',
            'target' => 'required',
            'value' => 'required',
            'achievement' => 'required'
        ]);

        $pdfFile = $request->attachment;

        $pdfFileName = time() . '_addtional_' . $request->kpa_id . '.pdf';
        $pdfFile->storeAs('kpa-evidence', $pdfFileName, 'public');

        // KPI Utama
        $acv = PekpaDetail::where('kpa_id', $request->kpa_id)
            ->where('addtional', '0')
            ->sum('achievement');

        // Bobot
        $totalWeight = 100 + $request->weight;

        // 

        // Jika Achivemnet main kurang dari 100
        if ($acv < 100) {
            // Lakukan penambahan dengan request achievement
            $acvTotal = round($acv + $request->achievement);

            // Jika achievment total lebih dari >100
            if ($acvTotal > 100) {

                // Jadikan nilai nya menjadi 100
                $acvTotal = 100;
            }

            // dd($acvTotal);  
            # code...
        } else {
            $acvTotal = 100;
        }


        $insert = PekpaDetail::create([
            'kpa_id' => $request->kpa_id,
            'kpidetail_id' => NULL,
            'value' => $request->value,
            'achievement' => $request->achievement, //Achievment Addtional
            'addtional' => '1',
            'addtional_objective' => $request->objective,
            'addtional_target' => $request->target,
            'addtional_weight' => $request->weight,
            'evidence' => 'kpa-evidence/' . $pdfFileName
        ]);



        $update = PeKpa::where('id', $request->kpa_id)
            ->update([
                'achievement' => $acvTotal
            ]);


        if ($insert && $update) {
            return back()->with('success', 'Data successfully Created');
        } else {
            return back()->with('danger', 'Failed');
        }
    }


    public function updateAddtional(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'id' => 'required',
            'kpa_id' => 'required',
            'objective' => 'required',
            'weight' => 'required',
            'target' => 'required',
            'value' => 'required',
            'achievement' => 'required',
        ]);


        if ($request->attachment) {
            echo 'ada document';
            # code...
            $pdfFile = $request->attachment;

            $pdfFileName = time() . '_' . $request->id . '.pdf';
            $pdfFile->storeAs('kpa-evidence', $pdfFileName, 'public');

            $update = PekpaDetail::where('id', $request->id)
                ->update([
                    'value' => $request->value,
                    'achievement' => $request->achievement, //Achievment Addtional
                    'addtional_objective' => $request->objective,
                    'addtional_target' => $request->target,
                    'addtional_weight' => $request->weight,
                    'evidence' => 'kpa-evidence/' . $pdfFileName
                ]);
        } else {
            echo 'ga ada document';
            $update = PekpaDetail::where('id', $request->id)
                ->update([
                    'value' => $request->value,
                    'achievement' => $request->achievement, //Achievment Addtional
                    'addtional_objective' => $request->objective,
                    'addtional_target' => $request->target,
                    'addtional_weight' => $request->weight,
                ]);
        }

        $acv = PekpaDetail::where('kpa_id', $request->kpa_id)
            ->where('addtional', '0')
            ->sum('achievement');
        // Jika Achivemnet main kurang dari 100
        if ($acv < 100) {
            // Lakukan penambahan dengan request achievement
            $acvTotal = round($acv + $request->achievement);

            // Jika achievment total lebih dari >100
            if ($acvTotal > 100) {

                // Jadikan nilai nya menjadi 100
                $acvTotal = 100;
            }

            // dd($acvTotal);  
            # code...
        } else {
            $acvTotal = 100;
        }

        $updateKpa = PeKpa::where('id', $request->kpa_id)
            ->update([
                'achievement' => $acvTotal
            ]);

        if ($update && $updateKpa) {
            return redirect()->back()->with('success', 'Data successfully Updated');
        } else {
            return redirect()->back()->with('danger', 'Failed');
        }
    }

    public function delete($id)
    {
        $dekripId = dekripRambo($id);

        $kpa = PeKpa::find($dekripId);

        $kpa->delete();
        return redirect()->route('kpa')->with('success', 'KPA successfully deleted');
    }

    public function submit(Request $request, $id)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $result = PeKpa::where('id', $request->id)
            ->update(['status' => '1']);

        if ($result) {
            return redirect()->back()->with('success', 'Data successfully Submit');
        } else {
            return redirect()->back()->with('danger', 'Failed');
        }
    }


    public function summary()
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



        return view('pages.kpa.kpa-summary', [
            'designations' => $designations,
            'departements' => $departements,
            'kpis' => $kpis,
            'kpas' => $kpas,
            'employes' => $employes
        ])->with('i');
    }

    // public function summaryDetail(Request $request)
    // {
    //     dd($request);
    // }

    public function summaryDetail(Request $request)
    {

        $semester = $request->semester;
        $tahun = $request->tahun;


        if ($semester == 'I') {
            # JIKA SEMESTER I
            $startMonth = 1; // Bulan Mei
            $endMonth = 6; // Bulan Agustus

            // $products = Product::
            //     ->get();

        } else if ($semester == 'II') {
            # JIKA SEMSESTER II

            $startMonth = 7; // Bulan Mei
            $endMonth = 12; // Bulan Agustus
        }

        $kpas = PeKpa::where('employe_id', $request->employe_id)
            ->where('status', '>', 0)
            ->whereYear('date', $tahun)
            ->whereMonth('date', '>=', $startMonth)
            ->whereMonth('date', '<=', $endMonth)
            ->orderBy('date', 'desc')
            ->orderBy('employe_id')
            ->get();

        // $results = PeKpa::selectRaw('MONTH(date) as month, COALESCE(SUM(achievement), 0) as total_achievement')
        //     ->whereMonth('date', '>=', $startMonth)
        //     ->whereMonth('date', '<=', $endMonth)
        //     ->groupBy(DB::raw('MONTH(date)'))
        //     ->get();

        // $achievementData = [];
        // foreach ($results as $result) {
        //     $achievementData[$result->month] = $result->total_achievement;
        // }

        // dd($results);

        $months = range($startMonth, $endMonth);


        $achievementData = array_fill_keys($months, 0);

        $achievements = PeKpa::selectRaw('MONTH(date) as month, achievement')
            ->whereIn(DB::raw('MONTH(date)'), $months)
            ->where('employe_id', $request->employe_id)
            ->where('status', '>', 0)
            ->whereYear('date', $tahun)
            ->get();

        $index = 0;
        foreach ($achievements as $achievement) {
            $month = $achievement->month;
            $achievementData[$month] = $achievement->achievement;

            $index++;
        }

        // dd($achievementData);


        // mencari nilai rating persemester
        $rating = PeKpa::where('employe_id', $request->employe_id)
            ->where('status', '>', 0)
            ->whereYear('date', $tahun)
            ->whereMonth('date', '>=', $startMonth)
            ->whereMonth('date', '<=', $endMonth)
            ->avg('achievement');

        $employes = Employee::where('status', '1')
            ->whereNotNull('kpi_id')
            ->get();

        $karyawan = Employee::find($request->employe_id);


        return view('pages.kpa.kpa-summary-detail', [
            'kpas' => $kpas,
            'employes' => $employes,
            'karyawan' => $karyawan,
            'semester' => $semester,
            'tahun' => $tahun,
            'rating' => intval($rating),
            'achievementData' => $achievementData
        ])->with('i');
    }


    public function deleteAddtional($id)
    {
        $dekripId = dekripRambo($id);
        $kpadetail = PekpaDetail::find($dekripId);
        // dd($kpadetail->kpa_id);
        $acvTotal = PekpaDetail::where('kpa_id', $kpadetail->kpa_id)->where('addtional', '0')->sum('achievement');

        $update = PeKpa::where('id', $kpadetail->kpa_id)->update([
            'achievement' => $acvTotal
        ]);

        $delete = $kpadetail->delete();


        if ($update && $delete) {
            return back()->with('success', 'Addtional successfully deleted');
        } else {
            return back()->with('danger', 'Addtional fail deleted!');
        }
    }
}
