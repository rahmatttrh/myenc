<?php

namespace Database\Seeders;

use App\Models\Biodata;
use Illuminate\Database\Seeder;

class BiodataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Biodata::create([
         'status' => 1,
         'first_name' => 'Dareza',
         'last_name' => 'Arvian',
         'email' => 'dareza@example.com',
         'created_at' => NOW(),
         'updated_at' => NOW()
      ]);
    }
}
