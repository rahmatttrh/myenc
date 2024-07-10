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
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;


class EmployeeImport implements ToModel, WithHeadingRow, WithValidation
{
   private $request;

   //  public function __construct($request) 
   //  {
   //      $this->request = $request;
        
   //  }
    public function model(array $row)
    {
      // $requestUser = Request::find($this->request);
      dd('ok');
         $biodata = Biodata::create([
               'status' => 0,
               'first_name' => $row['first_name'],
               'last_name' => $row['last_name'],
               'email' => $row['email'],
               'phone' => $row['phone'],
               'gender' => $row['gender'],
         ]);
      //   return new CargoItem([
      //    'status' => 0,
      //    'request_id' => $requestUser->id,
      //    'bcm' => $row['bcm'],
      //    'mtd'    => $row['mtd'],
      //    'contract'    => $row['po'],
      //    'desc'    => $row['descriptive'],
      //    'qty'    => $row['qty'],
      //    'unit'    => $row['unit'],
      //    'weight' => $row['weight']
      //   ]);
    }

    public function rules(): array
    {
        return [
            'mtd' => 'required'
        ];
    }
}
