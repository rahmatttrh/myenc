<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeKpi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function departement()
    {
        return $this->belongsTo(Department::class);
    }
}
