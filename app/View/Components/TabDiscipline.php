<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TabDiscipline extends Component
{
    public $activeTab;

    public function __construct($activeTab = '')
    {
        $this->activeTab = $activeTab;
    }


    public function render()
    {
        return view('components.tab-discipline');
    }
}
