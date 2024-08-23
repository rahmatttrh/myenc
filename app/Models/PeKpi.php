<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeKpi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function departement()
    {
        return $this->belongsTo(Department::class);
    }

    public function employees(){
      return $this->hasMany(Employee::class, 'kpi_id');
    }

    public function pes(){
      return $this->hasMany(Pe::class, 'kpi');
    }
    public function kpas(){
      return $this->hasMany(PeKpa::class, 'kpi_id');
    }
}
