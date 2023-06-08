<?php

namespace App\Imports;

use App\Models\Biodata;
use Maatwebsite\Excel\Concerns\ToModel;

class BiodataImport implements ToModel
{
   /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   public function model(array $row)
   {
      return new Biodata([
         'name' => $row[2]
      ]);
   }
}
