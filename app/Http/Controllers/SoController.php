<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoController extends Controller
{
    public function index()
    {
        return view('pages.so.so', [])->with('i');
    }
}
