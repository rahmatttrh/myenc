<?php

namespace App\Http\Controllers;

use App\Models\PeComponent;
use Illuminate\Http\Request;

class PeComponentController extends Controller
{
    public function index()
    {
        $components = PeComponent::get();
        return view('pages.pe-component.pe-component', [
            'components' => $components
        ])->with('i');
    }
}
