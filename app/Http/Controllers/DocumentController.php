<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
   public function store(Request $req)
   {
      $req->validate([
         // 'file' => request('file') ? 'image|mimes:jpg,jpeg,png|max:5120' : '',
      ]);

      Document::create([
         'employee_id' => $req->employee,
         'name' => $req->name,
         'type' => $req->type,
         'file' => request('file') ? request()->file('file')->store('employee/document') : ''
      ]);

      return redirect()->route('employee.detail', [enkripRambo($req->employee), enkripRambo('document')])->with('success', 'Employee Document successfully added');
   }

   public function update(Request $req)
   {
      $req->validate([]);

      $document = Document::find($req->document);

      if (request('file')) {
         Storage::delete($document->file);
         $file = request()->file('file')->store('employee/document');
      } elseif ($document->file) {
         $file = $document->file;
      } else {
         $file = null;
      }

      $document->update([
         'name' => $req->name,
         'type' => $req->type,
         'file' => $file
      ]);

      return redirect()->route('employee.detail', [enkripRambo($document->employee_id), enkripRambo('document')])->with('success', 'Employee Document successfully updated');
   }

   public function delete($id)
   {
      $dekripId = dekripRambo($id);
      $document = Document::find($dekripId);
      $id = $document->employee_id;
      $document->delete();

      return redirect()->route('employee.detail', [enkripRambo($id), enkripRambo('document')])->with('success', 'Employee Document successfully deleted');
   }
}
