<?php

namespace App\Imports;

use App\Models\Employee;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;


class EmployeeImport implements ToModel, WithHeadingRow
{
   /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */



   public function model(array $row)
   {
      return new Employee([
         'id_no' => $row['id'],
         'name' => $row['name'],
         'email' => $row['email'],
         'phone' => $row['phone'],
         'religion' => $row['religion'],
         'gender' => $row['gender'],
         'birth_date' =>  Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['birth_date'])),
         'birth_place' => $row['birth_place'],
         'address' => $row['address']
      ]);
   }
}
