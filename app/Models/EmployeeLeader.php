<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeader extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function department(){
      return $this->belongsTo(Department::class);
    }

    public function employee(){
      return $this->belongsTo(Employee::class);
    }

    public function leader(){
      return $this->belongsTo(Employee::class);
    }
}
