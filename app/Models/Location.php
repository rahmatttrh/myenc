<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
   use HasFactory;
   protected $guarded = [];

<<<<<<< HEAD
   
=======
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
>>>>>>> 5371422cd3838fa00e68679ea77f2f283da3fa49
}
