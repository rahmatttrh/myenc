<?php

namespace App\Http\Controllers;

use App\Models\PeComponent;
use App\Models\PeComponentFor;
use App\Models\PeComponentGroup;
use App\Http\Controllers\PeComponentForController;
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

    public function getComponentDesignation($designationId)
    {

        $pcf = PeComponentFor::where('designation_id', $designationId)->first();

        $pcs = PeComponent::where('group_id', $pcf->group_id)->get();

        return $pcs;
    }

    public function getWeightKpi($designationId)
    {

        $pcf = PeComponentFor::where('designation_id', $designationId)->first();

        $pc = PeComponent::select('weight')
            ->where('group_id', $pcf->group_id)
            ->where('name', 'KPI')
            ->first();

        return $pc->weight;
    }
}
