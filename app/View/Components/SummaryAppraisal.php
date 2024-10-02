<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SummaryAppraisal extends Component
{
    public $pdAchievement;
    public $datas;
    public $kpa;
    public $behaviors;
    public $pba;
    public $pe;

    public function __construct($pdAchievement, $datas, $kpa, $behaviors, $pba, $pe)
    {
        $this->pdAchievement = $pdAchievement;
        $this->datas = $datas;
        $this->kpa = $kpa;
        $this->behaviors = $behaviors;
        $this->pba = $pba;
        $this->pe = $pe;
    }

    public function render()
    {
        return view('components.qpe.summary-appraisal');
    }
}
