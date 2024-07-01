<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutation extends Model
{
   use HasFactory;
   protected $guarded = [];

   public function employee()
   {
      return $this->belongsTo(Employee::class);
   }

   public function before()
   {
      return $this->belongsTo(Aggreement::class);
   }

   public function become()
   {
      return $this->belongsTo(Aggreement::class);
   }
}
