<?php

namespace App\View\Components\Template;

use Illuminate\View\Component;

class BoxLayout16 extends Component
{



    public $listNews;
    public $zoneInfo;
    public $listSubZone;
    public $dataSubChild;
    public $zoneSub;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($listNews,$zoneInfo,$listSubZone,$dataSubChild,$zoneSub)
    {
        $this->listNews = $listNews;
        $this->zoneInfo = $zoneInfo;
        $this->listSubZone = $listSubZone;
        $this->dataSubChild = $dataSubChild;
        $this->zoneSub = $zoneSub;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.template.box-layout16');
    }
}
