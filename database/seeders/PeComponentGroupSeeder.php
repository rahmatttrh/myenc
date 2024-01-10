<?php

namespace Database\Seeders;

use App\Models\PeComponent;
use App\Models\PeComponentGroup;
use Illuminate\Database\Seeder;

class PeComponentGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $group1 = PeComponentGroup::create([
            'name' => 'Komponen Staff',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeComponent::create([
            'name' => 'Discipline',
            'weight' => 10,
            'group_id' => $group1->id,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeComponent::create([
            'name' => 'KPI',
            'weight' => 70,
            'group_id' => $group1->id,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeComponent::create([
            'name' => 'Behavior',
            'weight' => 20,
            'group_id' => $group1->id,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        $group2 = PeComponentGroup::create([
            'name' => 'Komponen Leader',
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeComponent::create([
            'name' => 'Discipline',
            'weight' => 10,
            'group_id' => $group2->id,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeComponent::create([
            'name' => 'KPI',
            'weight' => 50,
            'group_id' => $group2->id,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        PeComponent::create([
            'name' => 'Behavior',
            'weight' => 40,
            'group_id' => $group2->id,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);
    }
}
