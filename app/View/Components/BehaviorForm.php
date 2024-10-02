<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BehaviorForm extends Component
{
    public $kpa;
    public $pba;
    public $behaviors;
    public $pbads;

    public function __construct($kpa, $pba = null, $behaviors = [], $pbads = [])
    {
        $this->kpa = $kpa;
        $this->pba = $pba;
        $this->behaviors = $behaviors;
        $this->pbads = $pbads;
    }

    public function render()
    {
        return view('components.qpe.behavior-form');
    }
}
