<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Referensi dari 

    public function employee(){
      return $this->hasOne(Employee::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function subdept()
    {
        return $this->belongsTo(SubDept::class, 'sub_dept_id');
    }

    public function department(){
      return $this->belongsTo(Department::class);
    }

    public function getDepartmentNameAttribute()
    {
        return $this->subdept->department->name;
    }

    public function getUnitNameAttribute()
    {
        return $this->subdept->department->unit->name;
    }

    public function getEmployees(){
      $employees = Employee::where('position_id', $this->id)->get();
      return $employees;
      // return $this->hasMany(Employee::class);
    }

   //  public function getEmployeeName(){
      
   //    $emp = Employee::where('position_id', 164)->first();
   //    dd($emp->biodata->fullName());
   //    return $this->id;
   //  }

    public function employees(){
      return $this->belongsToMany(Employee::class);
    }
}
