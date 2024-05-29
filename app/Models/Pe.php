<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pe extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function employe()
    {
        return $this->belongsTo(Employee::class);
    }

    // one to one
    public function kpa()
    {
        return $this->hasOne(PeKpa::class);
    }
}
