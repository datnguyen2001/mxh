<?php

namespace App\View\Components\Template;

use Illuminate\View\Component;

class BoxLayout9 extends Component
{
    public $listNews;
    public $zoneInfo;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($listNews = [],$zoneInfo=[])
    {
        //
        $this->listNews = $listNews;
        $this->zoneInfo = $zoneInfo;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.template.box-layout9');
    }
}
