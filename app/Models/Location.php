<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
   use HasFactory;
   protected $guarded = [];

   public function totalEmployee($id){
      $employees = Employee::where('location_id', $this->id)->where('unit_id', $id)->get();
      // dd($employees);
      $total = count($employees);
      // dd('ok');
      return $total;
   }

   public function getUnitTransaction($id, $unitTrans){
      $transactions = Transaction::where('location_id', $this->id)->where('unit_id', $id)->where('month', $unitTrans->month)->where('year', $unitTrans->year)->get();
      // dd(count($transactions));
      return $transactions;
   }

   public function getValue($id, $unitTrans, $desc){
      $value = 0;
      $transactions = Transaction::where('location_id', $this->id)->where('unit_id', $id)->where('month', $unitTrans->month)->where('year', $unitTrans->year)->get();
      foreach($transactions as $trans){
         $transDetail = TransactionDetail::where('transaction_id', $trans->id)->where('desc', $desc)->first();
         $value = $value + $transDetail->value;
      }
      
      return $value;

   }

   public function getValueGaji($id, $unitTrans){
      $value = 0;
      $transactions = Transaction::where('location_id', $this->id)->where('unit_id', $id)->where('month', $unitTrans->month)->where('year', $unitTrans->year)->get();
      foreach($transactions as $trans){
         $pokok = TransactionDetail::where('transaction_id', $trans->id)->where('desc', 'Gaji Pokok')->first()->value;
         $jabatan = TransactionDetail::where('transaction_id', $trans->id)->where('desc', 'Tunj. Jabatan')->first()->value;
         $ops = TransactionDetail::where('transaction_id', $trans->id)->where('desc', 'Tunj. OPS')->first()->value;
         $kinerja = TransactionDetail::where('transaction_id', $trans->id)->where('desc', 'Tunj. Kinerja')->first()->value;
         $total = $pokok + $jabatan + $ops + $kinerja ;
         $value = $value + $total;
      }

      return $value;
   }

   public function getValueBpjsKt($id, $unitTrans){
      $value = 0;
      $transactions = Transaction::where('location_id', $this->id)->where('unit_id', $id)->where('month', $unitTrans->month)->where('year', $unitTrans->year)->get();
      foreach($transactions as $trans){
         $pokok = TransactionDetail::where('transaction_id', $trans->id)->where('desc', 'Gaji Pokok')->first()->value;
         $jabatan = TransactionDetail::where('transaction_id', $trans->id)->where('desc', 'Tunj. Jabatan')->first()->value;
         $ops = TransactionDetail::where('transaction_id', $trans->id)->where('desc', 'Tunj. OPS')->first()->value;
         $kinerja = TransactionDetail::where('transaction_id', $trans->id)->where('desc', 'Tunj. Kinerja')->first()->value;
         $total = $pokok + $jabatan + $ops + $kinerja ;
         $value = $value + $total;
      }

      return $value;
   }

   public function getReduction($unitId, $unitTrans, $name){
      $value = 0;
      $transactions = Transaction::where('location_id', $this->id)->where('unit_id', $unitId)->where('month', $unitTrans->month)->where('year', $unitTrans->year)->get();
      foreach($transactions as $trans){
         $transReduction = TransactionReduction::where('transaction_id', $trans->id)->where('name', $name)->where('type', 'employee')->first();
         $value = $value + $transReduction->value;
      }  

      return $value;
   }

   public function getReductionBpjsKt($unitId, $unitTrans){
      $value = 0;
      $transactions = Transaction::where('location_id', $this->id)->where('unit_id', $unitId)->where('month', $unitTrans->month)->where('year', $unitTrans->year)->get();
      // dd($transactions);
      foreach($transactions as $trans){
         $jkk = TransactionReduction::where('transaction_id', $trans->id)->where('name', 'JKK')->where('type', 'company')->first()->value;
         $jkm = TransactionReduction::where('transaction_id', $trans->id)->where('name', 'JKM')->where('type', 'company')->first()->value;
         $total = $jkk + $jkm;
         $value = $value + $total;
      }  

      return $value;
   }



   public function payrolls(){
      return $this->hasMany(Payroll::class);
   }

   public function transactions(){
      return $this->hasMany(Transaction::class);
   }

   public function overtimes(){
      return $this->hasMany(Overtime::class);
   }

   public function reductions(){
      return $this->hasMany(Reduction::class);
   }
}
