<?php

namespace App\View\Components\Category;

use Illuminate\View\Component;

class BoxDocNhieu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $listNews;
    public function __construct($listNews)
    {
        $this->listNews = $listNews;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.category.box-doc-nhieu');
    }
}
