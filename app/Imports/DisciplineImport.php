<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\TempDiscipline;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DisciplineImport implements ToCollection, WithHeadingRow
{
    protected $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function collection(Collection $rows)
    {

        // DB::beginTransaction();

        // // // Insert
        // try {

        foreach ($rows as $key => $row) {


            $employee = Employee::where('nik', $row['nik'])->first();

            // Cek dulu apakah nemu karyawannya dengan nik

            if ($employee) {

                if (
                    (is_numeric($row['alpa']) || is_null($row['alpa'])) &&
                    (is_numeric($row['ijin']) || is_null($row['ijin'])) &&
                    (is_numeric($row['terlambat']) || is_null($row['terlambat']))
                ) {
                    // Kode yang dijalankan jika kondisi terpenuhi
                    # code...

                    $achievment = 1;

                    if ($row['alpa'] >= 2 || $row['ijin'] >= 3 || $row['terlambat'] > 5) {
                        # code...
                        $achievment = 1;
                        // 
                    } else if ($row['alpa'] == 1 || $row['ijin'] == 2 || in_array($row['terlambat'], [4, 5])) {
                        // 
                        $achievment = 2;
                        // 
                    } else if (($row['alpa'] == null || $row['alpa'] == 0) && ($row['ijin'] == 1 || in_array($row['terlambat'], [1, 2, 3]))) {
                        $achievment = 3;
                        // 
                    } else if (($row['alpa'] == null || $row['alpa'] == 0) && ($row['ijin'] == null || $row['ijin'] == 0) && ($row['terlambat'] == null || $row['terlambat'] == 0)) {
                        $achievment = 4;
                    } 
              
                    // dd($achievment);

                    $create = TempDiscipline::create([
                        'date' =>  $this->date,
                        'employe_id' => $employee->id,
                        'alpa' => $row['alpa'],
                        'ijin' => $row['ijin'],
                        'terlambat' => $row['terlambat'],
                        'achievement' => $achievment
                    ]);
                }
            }
        }

        //     DB::commit();


        //     return redirect()->route('success')->with('message', 'Data berhasil disimpan.');
        // } catch (\Exception $e) {
        //     // Jika terjadi kesalahan, kita rollback transaksi
        //     DB::rollback();

        //     // return back()->with('message', 'Terjadi kesalahan, data tidak dapat disimpan.');

        //     // Handle atau laporkan kesalahan
        // }
    }
}
