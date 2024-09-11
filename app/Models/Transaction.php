<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
   use HasFactory;
   protected $guarded = [];

   public function employee()
   {
   public function employee()
   {
      return $this->belongsTo(Employee::class);
   }

   public function details()
   {
   public function details()
   {
      return $this->hasMany(TransactionDetail::class);
   }

   public function reductions()
   {
   public function reductions()
   {
      return $this->hasMany(TransactionReduction::class);
   }

   public function overtimes()
   {
   public function overtimes()
   {
      return $this->hasMany(TransactionOvertime::class);
   }

<<<<<<< HEAD
   public function location(){
      return $this->belongsTo(Location::class);
   }

   
=======
   public function location()
   {
      return $this->belongsTo(Location::class);
   }

   public function payroll()
   {
      return $this->belongsTo(Payroll::class);
   }
>>>>>>> 5371422cd3838fa00e68679ea77f2f283da3fa49
}
