<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function task(){
      return $this->belongsTo(Task::class);
    }

    public function employee(){
      return $this->belongsTo(Employee::class);
    }
}
