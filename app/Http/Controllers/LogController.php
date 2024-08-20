<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
   public function index(){
      $logs = Log::orderBy('created_at', 'desc')->get();
      return view('pages.log.index', [
         'logs' => $logs
      ])->with('i');
   }
   public function auth(){
      $logs = Log::where('department_id', '!=', null)->orderBy('created_at', 'desc')->paginate(500);
      return view('pages.log.auth', [
         'logs' => $logs
      ])->with('i');
   }
}
