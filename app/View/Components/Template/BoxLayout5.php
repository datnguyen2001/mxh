<?php

namespace App\View\Components\Template;

use Illuminate\View\Component;

class BoxLayout5 extends Component
{
    public $listNewsPapers;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($listNewsPapers = [])
    {
        //
        $this->listNewsPapers = $listNewsPapers;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.template.box-layout5');
    }
}
