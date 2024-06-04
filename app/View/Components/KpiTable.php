<?php

namespace App\View\Components;

use Illuminate\View\Component;

class KpiTable extends Component
{
    public $datas;
    public $kpa;
    public $addtional;
    public $i;

    public function __construct($datas, $kpa, $addtional, $i)
    {
        $this->datas = $datas;
        $this->kpa = $kpa;
        $this->addtional = $addtional;
        $this->i = $i;
    }

    public function render()
    {
        return view('components.qpe.kpi-table');
    }
}
