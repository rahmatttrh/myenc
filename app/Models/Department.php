<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
   use HasFactory;
   protected $guarded = [];


   public function unit()
   {
      return $this->belongsTo(Unit::class);
   }

   public function sub_depts()
   {
      return $this->hasMany(SubDept::class);
   }


   public function employees()
   {
      return $this->hasMany(Employee::class);
   }

   public function contracts()
   {
      return $this->hasMany(Contract::class);
   }

   public function kpi()
   {
      return $this->hasMany(PeKpi::class);
   }

   public function positions()
   {
      return $this->hasMany(Position::class);
   }

   public function getManagers(){
      $managers = Employee::where('designation_id', 4)->orWhere('designation_id', 5)->orWhere('designation_id', 6)->orWhere('designation_id', 7)->get();
      // dd($managers);
      return $managers;
   }

   public function sps()
   {
      return $this->hasMany(Sp::class);
   }

   public function pes()
   {
      return $this->hasMany(Pe::class);
   }

   public function getEmptyQpe($semester, $year)
   {
      $employees = $this->employees;

      $qpes = Pe::where('semester', $semester)->where('tahun', $year)->get();

      $employeeQpe = 0;
      foreach ($employees as $employee) {
         foreach ($qpes as $qpe) {
            if ($qpe->employe_id == $employee->id) {
               $employeeQpe = $employeeQpe + 1;
            }
         }
      }

      $employeeEmptyQpe = count($employees) - $employeeQpe;

      return $employeeEmptyQpe;
   }


   public function getQpe($semester, $year)
   {
      $employees = $this->employees;

      $qpes = Pe::where('semester', $semester)->where('tahun', $year)->get();

      $employeeQpe = 0;
      foreach ($employees as $employee) {
         foreach ($qpes as $qpe) {
            if ($qpe->employe_id == $employee->id) {
               $employeeQpe = $employeeQpe + 1;
            }
         }
      }

      return $employeeQpe;
   }

   public function getPendingQpe($semester, $year)
   {
      $employees = $this->employees->where('status', 1);

      $qpes = Pe::where('semester', $semester)->where('tahun', $year)->get();
      $pendings = [];
      // $employeeQpe = 0;
      foreach ($employees as $employee) {
         if ($employee->getQpe($semester, $year) == null) {
            $pendings[] = $employee;
         }
      }

      // dd($pendings);


      return $pendings;
   }

   public function getCompleteQpe($semester, $year)
   {
      $employees = $this->employees->where('status', 1);

      $qpes = Pe::where('semester', $semester)->where('tahun', $year)->get();
      $completes = [];
      // $employeeQpe = 0;
      foreach ($employees as $employee) {
         if ($employee->getQpe($semester, $year) != null) {
            $completes[] = $employee;
         }
      }

      // dd($completes);


      return $completes;
   }
}
