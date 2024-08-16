<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function employees(){
      return $this->hasMany(Employee::class);
    }

    public function reductions(){
      return $this->hasMany(Reduction::class);
    }

    public function totalSubDept($unitId = 2)
    {
        // Memanggil ModelA dan salah satu metodenya
        $ModelDepartments = new Department();
        $departments = $ModelDepartments->where('unit_id', $unitId)->get();
        $totalSubDept = 0;

        foreach ($departments as $key => $dept) {
            $totalSubDept += $dept->sub_depts->count();
        }
        return $totalSubDept;
    }
}
