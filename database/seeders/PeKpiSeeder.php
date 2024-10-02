<?php

namespace Database\Seeders;

use App\Models\PeKpi;
use Illuminate\Database\Seeder;

class PeKpiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PeKpi::create([
            'departement_id' => 2,
            'position_id' => 3,
            'title' => 'KPI IT Hardware',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);
    }
}
