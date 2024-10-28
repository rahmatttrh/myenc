<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
   use HasFactory;
   protected $guarded = [];

   public function totalEmployee(){
      $employees = Employee::where('location_id', $this->id)->get();
      // dd($employees);
      $total = count($employees);
      // dd('ok');
      return $total;
   }


   public function payrolls(){
      return $this->hasMany(Payroll::class);
   }

   public function transactions(){
      return $this->hasMany(Transaction::class);
   }

   public function overtimes(){
      return $this->hasMany(Overtime::class);
   }

   public function reductions(){
      return $this->hasMany(Reduction::class);
   }
}
