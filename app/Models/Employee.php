<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
   use HasFactory;
   protected $guarded = [];

   public function biodata()
   {
      return $this->belongsTo(Biodata::class);
   }

   // public function department()
   // {
   //    return $this->belongsTo(Department::class);
   // }

   // public function designation()
   // {
   //    return $this->belongsTo(Designation::class);
   // }

   public function contract()
   {
      return $this->belongsTo(Contract::class);
   }

   public function role()
   {
      return $this->belongsTo(Role::class);
   }

   // public function shift()
   // {
   //    return $this->belongsTo(Shift::class);
   // }
}
