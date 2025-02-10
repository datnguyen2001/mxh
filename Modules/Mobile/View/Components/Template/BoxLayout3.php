<?php
namespace Modules\Mobile\View\Components\Template;
use Illuminate\View\Component;
class BoxLayout3 extends Component
{
    public $listNewsPapers;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($listNewsPapers)
    {
        $this->listNewsPapers = $listNewsPapers;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('mobile::components.template/boxlayout3');
    }
}
