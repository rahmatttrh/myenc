<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aggreement extends Model
{
   use HasFactory;

   protected $guarded = [];

   public function employee()
   {
      return $this->belongsTo(Employee::class);
   }

   public function department()
   {
      return $this->belongsTo(Department::class);
   }

   public function designation()
   {
      return $this->belongsTo(Designation::class);
   }

   public function shift()
   {
      return $this->belongsTo(Shift::class);
   }

   public function position()
   {
      return $this->belongsTo(Position::class);
   }

   public function unit()
   {
      return $this->belongsTo(Unit::class);
   }

   public function direct_leader()
   {
      return $this->belongsTo(Employee::class, 'direct_leader_id');
   }

   public function manager()
   {
      return $this->belongsTo(Employee::class, 'manager_id');
   }
}
