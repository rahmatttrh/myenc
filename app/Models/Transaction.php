<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
   use HasFactory;
   protected $guarded = [];

   public function employee(){
      return $this->belongsTo(Employee::class);
   }

   public function details(){
      return $this->hasMany(TransactionDetail::class);
   }

   public function reductions(){
      return $this->hasMany(TransactionReduction::class);
   }

   public function overtimes(){
      return $this->hasMany(TransactionOvertime::class);
   }

   
}
