<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

   public function unit(){
      return $this->belongsTo(Unit::class);
   }

   public function department(){
      return $this->belongsTo(Department::class);
   }

   public function employee(){
      return $this->belongsTo(Employee::class);
   }
}
