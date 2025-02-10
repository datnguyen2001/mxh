<?php
namespace Modules\Mobile\View\Components\Home;
use Illuminate\View\Component;
class BoxHomeFocus extends Component
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
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('mobile::components.home/box-home-focus');
    }
}
