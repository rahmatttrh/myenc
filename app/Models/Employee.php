<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
   use HasFactory;
   protected $guarded = [];

   public function tasks(){
      return $this->belongsToMany(Task::class);
   }

   public function biodata()
   {
      return $this->belongsTo(Biodata::class);
   }

   public function unit()
   {
      return $this->belongsTo(Unit::class);
   }

   public function department()
   {
      return $this->belongsTo(Department::class);
   }

   public function designation()
   {
      return $this->belongsTo(Designation::class);
   }

   public function contract()
   {
      return $this->belongsTo(Contract::class);
   }

   public function role()
   {
      return $this->belongsTo(Role::class, 'role');
   }

   public function socialAccounts()
   {
      return $this->hasMany(SocialAccount::class);
   }

   public function bankAccounts()
   {
      return $this->hasMany(BankAccount::class);
   }

   public function contactEmergencies()
   {
      return $this->hasMany(Emergency::class);
   }

   public function educationals()
   {
      return $this->hasMany(Educational::class);
   }

   public function emergency()
   {
      return $this->belongsTo(Emergency::class);
   }

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function position()
   {
      return $this->belongsTo(Position::class);
   }

   // Atasan Langsung
   public function direct_leader()
   {
      return $this->belongsTo(Employee::class, 'direct_leader_id');
   }

   public function manager()
   {
      return $this->belongsTo(Employee::class, 'manager_id');
   }



   // HASH MANY 

   public function documents()
   {
      return $this->hasMany(Document::class);
   }

   public function allowances()
   {
      return $this->hasMany(Allowance::class);
   }

   public function commissions()
   {
      return $this->hasMany(Commission::class);
   }

   public function deductions()
   {
      return $this->hasMany(Deduction::class);
   }

   public function reimbursements()
   {
      return $this->hasMany(Reimbursement::class);
   }

   public function kpa()
   {
      return $this->hasMany(PeKpa::class);
   }

   public function presences()
   {
      return $this->hasMany(Presence::class);
   }

   public function spkls()
   {
      return $this->hasMany(Spkl::class);
   }

   public function sps()
   {
      return $this->hasMany(Sp::class);
   }

   public function contracts()
   {
      return $this->hasMany(Contract::class);
   }

   public function mutations()
   {
      return $this->hasMany(Mutation::class);
   }

   public function sub_dept()
   {
      return $this->belongsTo(SubDept::class);
   }
   // public function shift()
   // {
   //    return $this->belongsTo(Shift::class);
   // }

   public function positions()
   {
      return $this->belongsToMany(Position::class);
   }

   public function getLeaders()
   {
      $leaders = EmployeeLeader::where('employee_id', $this->id)->get();
      return $leaders;
   }

   public function getKpi()
   {
      $kpi = PeKpi::find($this->kpi_id);
      return $kpi;
   }


   public function payroll()
   {
      return $this->belongsTo(Payroll::class);
   }

   public function absences()
   {
      return $this->hasMany(Absence::class);
   }

   public function getQpe($semester, $year)
   {
      $qpe = Pe::where('employe_id', $this->id)->where('semester', $semester)->where('tahun', $year)->first();

      return $qpe;
   }

   public function location(){
      return $this->belongsTo(Location::class);
   }
}
