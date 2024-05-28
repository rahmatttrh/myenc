<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Pe;
use App\Models\PeBehavior;
use App\Models\PeBehaviorApprasial;
use App\Models\PeBehaviorApprasialDetail;
use App\Models\PeKpa;
use App\Models\PekpaDetail;
use App\Models\PeKpi;
use App\Models\PekpiDetail;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuickPEController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = auth()->user()->getEmployee();
        // Data KPI
        if (auth()->user()->hasRole('Administrator|HRD')) {
            $kpas = PeKpa::where('status', '!=', '0')
                ->orderBy('employe_id')
                ->get();


            $employes = Employee::where('status', '1')
                ->whereNotNull('kpi_id')
                ->get();
            // 

            $outAssesments = $this->outstandingAssessment();

            // 
        } else if (auth()->user()->hasRole('Leader|Manager')) {

            $kpas = DB::table('pe_kpas')
                ->join('pe_kpis', 'pe_kpas.kpi_id', '=', 'pe_kpis.id')
                ->where('pe_kpis.departement_id', $employee->department_id)
                ->select('pe_kpas.*') 
                ->orderBy('pe_kpas.status', 'asc')
                ->get();

            // Convert the query builder result to Order model instances
            $kpas = PeKpa::hydrate($kpas->toArray());

            $employes = Employee::where('department_id', $employee->department_id)
                ->where('status', '1')
                ->whereNotNull('kpi_id')
                ->get();
            // 
            $outAssesments = $this->outstandingAssessment($employee->department_id);
            // 
        }

        $designations = Designation::orderBy('name')->get();
        $departements = Department::orderBy('name')->get();


        return view('pages.qpe.qpe', [
            'designations' => $designations,
            'departements' => $departements,
            'kpas' => $kpas,
            'employes' => $employes,
            'outAssesments' =>  $outAssesments
        ])->with('i');
    }

    public function create()
    {
        $employee = auth()->user()->getEmployee();

        // Menggunakan request() helper
        $fullUrl = request()->fullUrl();

        $empId  = NULL;

        if (isset($_GET['empId'])) {
            # code...
            $empId = $_GET['empId'];
        }

        // Data KPI
        if (auth()->user()->hasRole('Administrator|HRD')) {
            $kpas = PeKpa::orderBy('date', 'desc')
                ->where('status', '!=', '0')
                ->orderBy('employe_id')
                ->get();


            $employes = Employee::where('status', '1')
                ->whereNotNull('kpi_id')
                ->get();
            // 

            $outAssesments = $this->outstandingAssessment();

            // 
        } else if (auth()->user()->hasRole('Leader|Manager')) {

            $kpas = DB::table('pe_kpas')
                ->join('pe_kpis', 'pe_kpas.kpi_id', '=', 'pe_kpis.id')
                ->where('pe_kpis.departement_id', $employee->department_id)
                ->select('pe_kpas.*')
                ->orderBy('pe_kpas.date', 'desc')
                ->orderBy('pe_kpas.status', 'asc')
                ->get();

            // Convert the query builder result to Order model instances
            $kpas = PeKpa::hydrate($kpas->toArray());

            $employes = Employee::where('department_id', $employee->department_id)
                ->where('status', '1')
                ->whereNotNull('kpi_id')
                ->get();
            // 
            $outAssesments = $this->outstandingAssessment($employee->department_id);
            // 
        }

        // Berikut Behavior  Staff
        $behaviors = PeBehavior::where('level', 's')->get();

        $designations = Designation::orderBy('name')->get();
        $departements = Department::orderBy('name')->get();


        return view('pages.qpe.qpe-create', [
            'designations' => $designations,
            'departements' => $departements,
            'kpas' => $kpas,
            'employes' => $employes,
            'behaviors' => $behaviors,
            'empId' => 'empId',
            'outAssesments' =>  $outAssesments
        ])->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Store Apprasial
    public function store(Request $req)
    {
        $req->validate([
            'kpi_id' => 'required',
            'employe_id' => 'required',
            'semester' => 'required',
            'tahun' => 'required',
            'date' => 'required'
        ]);

        // dd($req);

        // Validasi KPA OLD
        // $cek = PeKpa::where([
        //     'employe_id' => $req->employe_id,
        //     'date' => $req->date
        // ])->first();

        // Validasi New
        $cek = PeKpa::where([
            'employe_id' => $req->employe_id,
            'semester' => $req->semester,
            'tahun' => $req->tahun
        ])->first();



        if ($cek) {
            return redirect()->back()->with('danger', 'KPA Karyawan di bulan tersebut sudah ada');
        }


        // Insert PE

        $pe = Pe::create([
            'employe_id' => $req->employe_id,
            'date' => $req->date,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);



        // Insert KPA
        $kpa = PeKpa::create([
            'pe_id' => $pe->id,
            'kpi_id' => $req->kpi_id,
            'employe_id' => $req->employe_id,
            'date' => $req->date,
            'is_semester' => '1',
            'semester' => $req->semester,
            'tahun' => $req->tahun
        ]);


        $kpaId = enkripRambo($kpa->id);

        $acvTotal = 0;

        // Insert KPI Detail
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


        return redirect('/qpe/edit/' . $kpaId)->with('success', 'KPI successfully added');
    }

    public function edit($id)
    {
        $kpa = PeKpa::find(dekripRambo($id));
        // dd(dekripRambo($id));
        $datas = PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '0')->get();
        // Additional 
        $addtional = PekpaDetail::where('kpa_id', $kpa->id)->where('addtional', '1')->first();
        // dd($addtional);

        $employes = Employee::where('status', '1')
            ->whereNotNull('kpi_id')
            ->get();

        // Berikut Behavior  Staff
        $behaviors = PeBehavior::where('level', 's')->get();


        $isDone = false;
        $isReject = false;

        if ($kpa->status == '2') {
            # code...

            $dataOpen = PekpaDetail::where('kpa_id', $kpa->id)->where('status', '0')->get();
            if ($dataOpen->count() == 0) {
                $dataReject = PekpaDetail::where('kpa_id', $kpa->id)->where('status', '202')->get();

                if ($dataReject->count() == 0) {
                    // Valid Semua
                    $isDone = true;
                } else {
                    // ada yang belum valid
                    $isReject = true;
                }
            }
        }
        // dd($datas);


        if (!isset($kpa)) {
            return back()->with('danger', 'Id KPA Anda Salah');
        }

        $pba = PeBehaviorApprasial::where('pe_id', $kpa->pe_id)->first();

        if (isset($pba)) {
            $pbads = PeBehaviorApprasialDetail::where('pba_id', $pba->id)->get();
        } else {
            $pbads = null;
        }

        // dd($employes);

        return view('pages.qpe.qpe-edit', [
            'kpa' => $kpa,
            // 'employes' => $employes,
            'addtional' => $addtional,
            'behaviors' => $behaviors,
            'isDone' => $isDone,
            'isReject' => $isReject,
            'pba' => $pba,
            'pbads' => $pbads,
            'kpaAchievement' => 0,
            'pbaAchievement' => 0,
            'datas' => $datas
        ])->with('i');
    }

    public function storeBehavior(Request $req)
    {
        // dd($req);

        $req->validate([
            'kpa_id' => 'required',
            'employe_id' => 'required',
            'pe_id' => 'required'
        ]);

        // Validasi New
        $cek = PeBehaviorApprasial::where([
            'pe_id' => $req->pe_id
        ])->first();



        if ($cek) {
            return redirect()->back()->with('danger', 'Behavior Karyawan dengan PE tersebut sudah ada');
        }

        // DB::beginTransaction(); // Mulai transaksi database

        // try {

        $pba = PeBehaviorApprasial::create([
            'pe_id' => $req->pe_id
        ]);

        $achievement = 0;

        foreach ($req->valBehavior as $behavior_id => $value) {

            PeBehaviorApprasialDetail::create([
                'pba_id' => $pba->id,
                'behavior_id' => $behavior_id,
                'value' => $value,
                'achievement' => $req->acvBehavior[$behavior_id]
            ]);

            $achievement += $req->acvBehavior[$behavior_id];
        }

        $updatePba = $pba->update([
            'achievement' => $achievement
        ]);

        return back()->with('success', 'Behavior berhasil di Create');
        // } catch (\Exception $e) {
        //     DB::rollback(); // Rollback transaksi jika terjadi kesalahan

        //     // Tangani kesalahan, bisa redirect ke halaman sebelumnya atau tampilkan pesan error
        //     return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        // }
    }

    public function updateBehavior(Request $request, $id)
    {
        $pbda = PeBehaviorApprasialDetail::find($id);

        $update = $pbda->update([
            'value' => $request->valBv,
            'achievement' => $request->achievement
        ]);

        $totalAchievement = PeBehaviorApprasialDetail::where('pba_id', $request->pba_id)->sum('achievement');

        PeBehaviorApprasial::where('id', $request->pba_id)->update([
            'achievement' => $totalAchievement
        ]);

        return redirect()->back()->with('success', 'Behavior Karyawan Berhasil di Update');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    private function outstandingAssessment($departmentId = 'All')
    {
        // Outstanding Query
        // Membuat array untuk menyimpan hasil query
        $outAssesment = array();

        $bulanMulai = 7;   // Bulan untuk mulai atau mengetahui ouststanding assesment

        $bulanSekarang = date('n');


        $tahun = date('Y');

        // Loop dari bulan 1 hingga 12
        for ($bulan = $bulanSekarang; $bulan >= $bulanMulai; $bulan--) {
            // Mengambil data untuk bulan saat ini

            if ($departmentId == 'All') {
                # code...
                $employees = Employee::where('designation_id', '<=', '4')
                    ->get();
            } else {
                # code...
                $employees = Employee::where('department_id', $departmentId)
                    ->where('designation_id', '<=', '4')
                    ->get();
            }

            // mencari data karyawan pada departemen ini 


            // looping karywanya
            foreach ($employees as $key => $karyawan) {
                # cek apakah ada penilai kpi di bulan ini
                $kpa = PeKpa::where('employe_id', $karyawan->id)
                    ->whereMonth('date', $bulan)
                    ->whereYear('date', $tahun)
                    ->first();

                if (!$kpa) {
                    # jika tidak ada mauskan kedalam oustanding

                    $outAssesment[$bulan][$karyawan->id] = [
                        'employe_id' => $karyawan->id,
                        'employe' => $karyawan->biodata->fullName(),
                        'bulan' => $bulan,
                        'tahun' => $tahun,
                        'status' => 'Belum ada data!'
                    ];
                }
            }
        }

        return $outAssesment;
    }
}
