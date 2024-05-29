<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Position::create([
         'name' => 'IT Staff',
         'sub_dept_id' => 1,
         'designation_id' => 1,
         'created_at' => NOW(),
         'updated_at' => NOW()
     ]);
    }
}
