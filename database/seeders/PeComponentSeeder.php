<?php

namespace Database\Seeders;

use App\Models\PeComponent;
use Illuminate\Database\Seeder;

class PeComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PeComponent::create([
            'name' => 'Discipline',
            'weight' => 10,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeComponent::create([
            'name' => 'KPI',
            'weight' => 70,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeComponent::create([
            'name' => 'Behavior',
            'weight' => 20,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);
    }
}
