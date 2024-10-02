<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\Flysystem\Adapter\Local;

class Perdin extends Model
{
   use HasFactory;
   protected $guarded = [];

   public function unit()
   {
      return $this->belongsTo(Unit::class);
   }

   public function employee()
   {
      return $this->belongsTo(Employee::class);
   }

   public function location()
   {
      return $this->belongsTo(Location::class);
   }
}
