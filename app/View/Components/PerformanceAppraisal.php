<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PerformanceAppraisal extends Component
{
    public $kpa;

    public function __construct($kpa)
    {
        $this->kpa = $kpa;
    }

    public function render()
    {
        return view('components.performance-appraisal');
    }
}
