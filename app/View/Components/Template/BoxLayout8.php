<?php

namespace App\View\Components\Template;

use Illuminate\View\Component;

class BoxLayout8 extends Component
{
    public $listNews;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($listNews = [])
    {
        //
        $this->listNews = $listNews;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.template.box-layout8');
    }
}
