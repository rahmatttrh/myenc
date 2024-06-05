<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeDiscipline extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function employe()
    {
        return $this->belongsTo(Employee::class);
    }

    public function pdds()
    {
        return $this->hasMany(PeDisciplineDetail::class, 'pd_id');
    }
}
