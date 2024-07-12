<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DesignationController extends Controller
{
   public function index()
   {
      $designations = Designation::get();
      return view('pages.designation.index', [
         'designations' => $designations
      ])->with('i');
   }

   public function store(Request $req)
   {
      $req->validate([]);

      Designation::create([
         'name' => $req->name,
         'golongan' => $req->gol,
         'slug' => Str::slug($req->name)
      ]);

      return redirect()->back()->with('success', 'Position successfully added');
   }

   public function edit($id)
   {
      $dekripId = dekripRambo($id);
      $designation = Designation::find($dekripId);

      $designations = Designation::get();
      return view('pages.designation.edit', [
         'designations' => $designations,
         'designation' => $designation
      ])->with('i');
   }

   public function update(Request $req)
   {
      $designation = Designation::find($req->designation);
      $designation->update([
         'name' => $req->name,
         'slug' => Str::slug($req->name)
      ]);

      return redirect()->route('designation')->with('success', 'Position successfully updated');
   }

   public function delete($id)
   {
      $dekripId = dekripRambo($id);
      $designation = Designation::find($dekripId);

      $designation->delete();
      return redirect()->route('designation')->with('success', 'Position successfully deleted');
   }
}
   