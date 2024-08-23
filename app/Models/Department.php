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

   public function positions(){
      return $this->hasMany(Position::class);
   }

   public function getManagers(){
      $managers = Employee::where('designation_id', 4)->orWhere('designation_id', 5)->orWhere('designation_id', 6)->orWhere('designation_id', 7)->get();
      // dd($managers);
      return $managers;
   }

   public function sps(){
      return $this->hasMany(Sp::class);
   }

   public function pes(){
      return $this->hasMany(Pe::class);
   }
}
