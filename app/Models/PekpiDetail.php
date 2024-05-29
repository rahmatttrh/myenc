<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PekpiDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kpadetail()
    {
        return $this->hasMany(PekpaDetail::class);
    }

    public function points()
    {
        return $this->hasMany(PekpiPoint::class);
    }
}
