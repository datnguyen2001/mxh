<?php

namespace App\View\Components\Template;

use Illuminate\View\Component;

class BoxNewPaper extends Component
{
    public $listPaper;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($listPaper = [])
    {
        $this->listPaper = $listPaper;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.template.box-new-paper');
    }
}
