<?php
namespace Modules\Mobile\View\Components\Category;
use Illuminate\View\Component;
class BoxHighlight extends Component
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
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('mobile::components.category/boxhighlight');
    }
}
