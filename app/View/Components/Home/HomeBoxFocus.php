<?php


namespace App\View\Components\Home;

use Illuminate\View\Component;

class HomeBoxFocus extends Component
{
    public $listNews;
    /**
     * Create a new component instance.
     *
     * @return void
     */
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
        return view('components.home.home-box-focus');
    }
}
