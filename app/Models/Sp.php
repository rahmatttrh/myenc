<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sp extends Model
{
  use HasFactory;
  protected $guarded = [];

  public function employee()
  {
    return $this->belongsTo(Employee::class, 'employee_id');
  }

  public function created_by()
  {
    return $this->belongsTo(Employee::class, 'by_id');
  }

  public function department()
  {
    return $this->belongsTo(Department::class);
  }
}
