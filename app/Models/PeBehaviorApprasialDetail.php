<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeBehaviorApprasialDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function behavior()
    {
        return $this->belongsTo(PeBehavior::class, 'behavior_id');
    }
}
