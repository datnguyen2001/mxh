<?php
namespace Modules\Mobile\View\Components\Template;
use Illuminate\View\Component;
class BoxLayout1 extends Component
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
        return view('mobile::components.template/box-layout1');
    }
}
