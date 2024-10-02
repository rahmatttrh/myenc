<?php

namespace App\Imports;

use App\Models\Biodata;
use App\Models\Contract;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Emergency;
use App\Models\Employee;
use App\Models\Position;
use App\Models\SubDept;
use App\Models\Unit;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;


class EmployeeImport implements ToCollection, WithHeadingRow
{
   public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            // if(!array_filter($row)) {
            //    return null;
            // } 
       
            if($row->filter()->isNotEmpty()){
               
               Biodata::create([
                  'first_name' => $row['first_name'],
                  'last_name' => $row['last_name'],
                  'email' => $row['email'],
              ]);
           }   
            
        }
    }
}
