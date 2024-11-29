<?php

namespace App\Http\Controllers;

use App\Models\ReductionEmployee;
use Illuminate\Http\Request;

class ReductionEmployeeController extends Controller
{
   public function update(Request $req)
   {
      $reductionEmployee = ReductionEmployee::find($req->redEmp);

      $reductionEmployee->update([
         'status' => $req->status
      ]);

      return redirect()->back()->with('status', 'Potongan Karyawan berhasil diubah');
   }

   public function delete(Request $req)
   {
      // dd('ok');
      $req->validate([]);

      $redEmp = ReductionEmployee::find($req->redempId);

      $redEmp->delete();
      return redirect()->back()->with('status', 'Potongan Karyawan berhasil dihapus');
   }
}
