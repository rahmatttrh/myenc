<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
{
    use HasFactory;
    protected $table = 'employee_position';
    protected $guarded = [];

    public function employee(){
      return $this->belongsTo(Employee::class);
    }
}
