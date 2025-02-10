<?php

namespace App\View\Components\layout;

use Illuminate\View\Component;

class BoxCategoryItem extends Component
{
    public $dataItem;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($dataItem)
    {
        //
        $this->dataItem = $dataItem;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout.box-category-item');
    }
}
