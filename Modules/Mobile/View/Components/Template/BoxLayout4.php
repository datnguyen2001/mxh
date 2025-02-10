<?php
namespace Modules\Mobile\View\Components\Template;
use Illuminate\View\Component;
class BoxLayout4 extends Component
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
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('mobile::components.template/boxlayout4');
    }
}
