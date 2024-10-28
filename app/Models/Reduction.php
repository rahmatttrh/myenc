<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reduction extends Model
{
   use HasFactory;
   protected $guarded = [];

   public function unit(){
      return $this->belongsTo(Unit::class);
   }

   public function location(){
      return $this->belongsTo(Location::class);
    }
   
}
