<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

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
