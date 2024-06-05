<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Discipline extends Component
{
    public $pd;

    public function __construct($pd)
    {
        $this->pd = $pd;
    }

    public function render()
    {
        return view('components.qpe.discipline');
    }
}
