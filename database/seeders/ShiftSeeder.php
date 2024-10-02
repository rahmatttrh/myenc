<?php

namespace Database\Seeders;

use App\Models\Shift;
use Carbon\Carbon;
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
         'name' => 'Office HW',
         'in' => new Carbon('08:00:00'),
         'out' => new Carbon('17:00:00'),
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);

      Shift::create([
         'name' => 'Office KJ',
         'in' => new Carbon('07:00:00'),
         'out' => new Carbon('16:00:00'),
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);

      // Shift::create([
      //    'name' => 'Shift',
      //    'total' => new Carbon('12:00:00'),
      //    'created_at' => NOW(),
      //    'updated_at' => NOW()
      // ]);
   }
}
