<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      Shift::create([
         'name' => 'Office',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);
   }
}
