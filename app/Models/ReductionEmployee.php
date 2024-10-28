<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReductionEmployee extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function reduction(){
        return $this->belongsTo(Reduction::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
