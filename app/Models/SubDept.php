<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PeKpa;

class SubDept extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function outstandingKPI($subDeptId = 2, $tahun = '2024')
    {
        // Memanggil ModelA dan salah satu metodenya
        $ModelEmployee = new Employee();

        $employee = $ModelEmployee->where('sub_dept_id', $subDeptId)
            ->where('status', '1')
            ->get();

        $jumlahKaryawan = $employee->count();

        $data = array();
        $currentMonth = date('m');

        for ($i = 1; $i <= 12; $i++) {

            if ($currentMonth >= $i) {
                # code...
                $peKpas = PeKpa::join('employees', 'pe_kpas.employe_id', '=', 'employees.id')
                    ->where('employees.sub_dept_id', $subDeptId)
                    ->whereYear('pe_kpas.date', $tahun)
                    ->whereMonth('pe_kpas.date', $i)
                    ->get();

                $totalKpa = $peKpas->count();

                $totalOut = $jumlahKaryawan - $totalKpa;
            } else {


                $totalOut = 'N/A';
            }



            $data[$i] = $totalOut;
        }

        return $data;
    }
}
