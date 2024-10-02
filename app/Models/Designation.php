<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
   use HasFactory;
   protected $guarded = [];

   public function employees()
   {
      return $this->hasMany(Employee::class);
   }

   public function contracts()
   {
      return $this->hasMany(Contract::class);
   }

   public function kpi()
   {
      return $this->hasMany(PeKpi::class);
   }
}
