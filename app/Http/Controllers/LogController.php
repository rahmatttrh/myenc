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
      $logs = Log::where('action', 'Login')->orWhere('action', 'Logout')->orderBy('created_at', 'desc')->get();
      return view('pages.log.auth', [
         'logs' => $logs
      ])->with('i');
   }
}
