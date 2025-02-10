<?php

namespace App\View\Components\Template;

use Illuminate\View\Component;

class BoxLayout17 extends Component
{
    public $listNews;
    public $zoneInfo;
    public $listSubZone;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($listNews,$zoneInfo,$listSubZone)
    {
        $this->listNews = $listNews;
        $this->zoneInfo = $zoneInfo;
        $this->listSubZone = $listSubZone;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.template.box-layout17');
    }
}
