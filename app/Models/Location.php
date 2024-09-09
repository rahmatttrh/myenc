<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
   use HasFactory;
   protected $guarded = [];

   public function transactions()
   {
      return $this->hasMany(Transaction::class);
   }

   public function payrolls()
   {
      return $this->hasMany(Payroll::class);
   }

   public function overtimes()
   {
      return $this->hasMany(Overtime::class);
   }

   public function reductions()
   {
      return $this->hasMany(TransactionReduction::class);
   }

   public function totalEmployee()
   {
      $totalEmployee = Contract::where('status', 1)->where('loc', $this->code)->get()->count();

      return $totalEmployee;
   }
}
