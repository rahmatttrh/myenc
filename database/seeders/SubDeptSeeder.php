<?php

namespace Database\Seeders;

use App\Models\SubDept;
use Illuminate\Database\Seeder;

class SubDeptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      SubDept::create([
         'department_id' => 2,
         'name' => 'IT',
         'created_at' => NOW(),
         'updated_at' => NOW()
     ]);
    }
}
