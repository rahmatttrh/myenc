<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayslipBpjsKt extends Model
{
   use HasFactory;

   protected $guarded = [];

   public function unit_transaction()
   {
      return $this->belongsTo(UnitTransaction::class);
   }
}
