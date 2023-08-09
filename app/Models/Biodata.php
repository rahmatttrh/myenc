<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
   use HasFactory;
   protected $guarded = [];

   public function employee()
   {
      return $this->hasOne(Employee::class);
   }




   // function custom
   public function fullName()
   {
      return $this->first_name . ' ' . $this->last_name;
   }
}
