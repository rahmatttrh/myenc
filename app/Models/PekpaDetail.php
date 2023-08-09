<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PekpaDetail extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function kpa()
    {
        return $this->belongsTo(PeKpa::class);
    }

    public function kpidetail()
    {
        return $this->belongsTo(PekpiDetail::class);
    }
}
