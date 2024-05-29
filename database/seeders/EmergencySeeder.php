<?php

namespace Database\Seeders;

use App\Models\Emergency;
use Illuminate\Database\Seeder;

class EmergencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Emergency::create([
         'name' => 'Sujana',
         'phone' => '0869696969',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);
    }
}
