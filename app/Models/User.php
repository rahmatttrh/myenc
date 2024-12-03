<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
   use HasApiTokens, HasFactory, Notifiable, HasRoles;

   /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
      'name',
      'username',
      'email',
      'password',
   ];

   /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
   protected $hidden = [
      'password',
      'remember_token',
   ];

   /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
   protected $casts = [
      'email_verified_at' => 'datetime',
   ];

   public function employee()
   {
      return $this->hasOne(Employee::class);
   }

   public function getRoleName()
   {
      if ($this->hasRole('Administrator')) {
         $name = 'Administrator';
      } else if ($this->hasRole('Staff')) {
         $name = 'Staff';
      } else if ($this->hasRole('HRD')) {
         $name = 'HRD';
      } else if ($this->hasRole('Karyawan')) {
         $name = 'Karyawan';
      } else if ($this->hasRole('Leader')) {
         $name = 'Leader';
      } else if ($this->hasRole('Manager')) {
         $name = 'Manager';
      } else if ($this->hasRole('BOD')) {
         $name = 'BOD';
      }
      return $name;
   }

   public function getEmployee()
   {
      $biodata = Biodata::where('email', $this->email)->first();
      $employee = Employee::where('biodata_id', $biodata->id)->first();
      // return Employee::where('user_id', auth()->user()->id)->first() ?? null;
      return $employee;
   }
   // auth()->user()->id

   public function getEmployeeId()
   {
      // dd($this->email);
      // dd($this->id);
      // $biodata = Biodata::where('email', $this->email)->first();
      // dd($biodata->id);
      // $employee = Employee::where('biodata_id', $biodata->id)->first();

      $employee = Employee::where('nik', $this->username)->first();
      // dd($biodata->email);
      return $employee->id;
   }

   public function getGender()
   {
      $employee = Employee::where('nik', $this->username)->first();
      if ($employee->biodata->gender == 'Male') {
         $value = 'Mr. ';
      } elseif ($employee->biodata->gender == 'Female') {
         $value = 'Ms. ';
      } else {
         $value = ' ';
      }

      return $value;
   }
}
