<?php

namespace App\Http\Controllers;

use App\Models\PeComponent;
use App\Models\PeComponentGroup;
use Illuminate\Http\Request;

class PeComponentController extends Controller
{
    public function index()
    {
        $components = PeComponent::orderBy('group_id', 'asc')->get();

        $groups = PeComponentGroup::get();

        return view('pages.pe-component.pe-component', [
            'components' => $components,
            'groups' => $groups
        ])->with('i');
    }
}
