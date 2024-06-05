<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeDisciplineDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pd()
    {
        return $this->belongsTo(PeDiscipline::class, 'pd_id');
    }
}
