<?php

namespace Database\Seeders;

use App\Models\Contract;
use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Contract::create([
         'id_no' => 'EN-4-047',
         'unit_id' => 1,
         'department_id' => 2,
         'designation_id' => 1,
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);
    }
}
