<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
   use HasFactory;
   protected $guarded = [];

   public function employee()
   {
      return $this->belongsTo(Employee::class);
   }

   public function bank()
   {
      return $this->belongsTo(Bank::class);
   }
}
