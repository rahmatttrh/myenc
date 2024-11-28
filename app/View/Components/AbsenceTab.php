<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AbsenceTab extends Component
{
    public $activeTab;

    public function __construct($activeTab = '')
    {
        $this->activeTab = $activeTab;
    }


    public function render()
    {
        return view('components.absence.absence-tab');
    }
}
