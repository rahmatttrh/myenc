<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpApproval extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sp(){
      return $this->belongsTo(Sp::class);
    }

    public function employee(){
      return $this->belongsTo(Employee::class);
    }
}
