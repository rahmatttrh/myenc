<?php

namespace App\Imports;

use App\Models\Biodata;
use App\Models\Contract;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Emergency;
use App\Models\Employee;
use App\Models\Unit;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;


class EmployeeImport implements ToCollection, WithHeadingRow
{
   public function collection(Collection $rows)
   {
      foreach ($rows as $row) {

         $department = Department::where('name', $row['department'])->first();
         $designation = Designation::where('name', $row['designation'])->first();
         $unit = Unit::where('name', $row['business_unit'])->first();
         // dd($row['first_name']);


         // echo ($row['no_ktp']);
         // dd($rows);
         // $agama = $row['agama'];

         // dd($row['agama']);

         $biodata = Biodata::create([
            'status' => 0,
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'gender' => $row['gender'],
            'religion' => $row['agama'], //agama
            'birth_place' => $row['tempat_lahir'], //
            'birth_date' => $row['tanggal_lahir'], //tanggal lahir
            'no_ktp' => $row['no_ktp'],
            'no_npwp' => $row['no_npwp'], //
            'no_kk' => $row['no_kk'], //
            'no_bpjs_kesehatan' => $row['no_bpjs_kesehatan'], // bpjs
            'no_jamsostek' => $row['no_jamsostek'], //
            'marital' => $row['status_nikah'], // status nikah 
            'last_education' => $row['pendidikan_terakhir'], //pendidikan terakhir
            'institution_name' => $row['nama_institusi'], // nama institusi
            'vocational' => $row['jurusan'], //jurusan
            'status_pajak' => $row['status_pajak'], //
            'blood' => $row['gol_darah'], //golongan darah
            'address' => $row['alamat_domisili'], //alamat domisili
            'alamat_ktp' => $row['alamat_ktp'], //alamat ktp
            'status' => $row['status'],
            'created_at' => NOW(),
            'updated_at' => NOW() //

         ]);

         $contract = Contract::create([
            'id_no' => $row['nik'],
            'unit_id' => $unit->id,
            'department_id' => $department->id,
            'designation_id' => $designation->id,
            'location' => $row['lokasi'],
            'project' => $row['project'],
            'start' => $row['tanggal_awal_kontrak'],
            'end' => $row['tanggal_akhir_kontrak'],
            'salary' => $row['salary'],
            'payslip' => $row['payslip_type'],
            'created_at' => NOW(),
            'updated_at' => NOW()
         ]);

         // Insert Contract udah Oke
         $emergency = Emergency::create([
            'name' => $row['nama_kontak_darurat'],
            'phone' => $row['kontak_darurat'],
            'hubungan' => $row['hubungan'],
            'created_at' => NOW(),
            'updated_at' => NOW()
         ]);

         Employee::create([
            'status' => 0,
            'role' => $row['role'],
            'department_id' => $department->id,
            'biodata_id' => $biodata->id,
            'contract_id' => $contract->id,
            'emergency_id' => $emergency->id,
            'nik' => $row['nik'],
            'entry_date' => $row['tanggal_masuk'],
            'determination_date' => $row['tanggal_penetapan'],
            'created_at' => NOW(),
            'updated_at' => NOW()

         ]);
      }
   }
}
