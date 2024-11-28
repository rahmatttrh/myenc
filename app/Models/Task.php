<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

   public function unit(){
      return $this->belongsTo(Unit::class);
   }

   public function department(){
      return $this->belongsTo(Department::class);
   }

   public function employee(){
      return $this->belongsTo(Employee::class);
   }

   public function employees(){
    return $this->belongsToMany(Employee::class);
   }

   public function newMessage(){
        $chat = Chat::where('task_id', $this->id)->orderBy('created_at', 'desc')->first();
    
        if ($chat != null) {
           
            if ($chat->type == 'leader') {
                $type = 'leader';
            } else {
                $type = 'user';
            }

            if (auth()->user()->hasRole('Karyawan')) {
                if ($type == 'leader') {
                    $alert = 1;
                } else if($type == 'user') {
                    $alert = 2;
                }
            } else {
                if ($type == 'user') {
                    $alert = 1;
                } else if ($type == 'leader') {
                    $alert = 2;
                }
            }
            
        } else {
            $alert = 2;
        }

        
        return $alert;
   }
}
