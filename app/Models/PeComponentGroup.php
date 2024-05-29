<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeComponentGroup extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function components()
    {
        return $this->hasMany(PeComponent::class, 'group_id');
    }
}
