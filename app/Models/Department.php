<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
   use HasFactory;
   protected $guarded = [];


   public function unit()
   {
      return $this->belongsTo(Unit::class);
   }

   public function sub_depts()
   {
      return $this->hasMany(SubDept::class);
   }


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
