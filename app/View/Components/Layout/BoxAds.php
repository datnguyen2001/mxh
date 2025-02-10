<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class BoxAds extends Component
{
    /**
     * The alert type.
     *
     * @var string
     */
    public $nameAds;

    public $idAds;


    /**
     * Create the component instance.
     *
     * @param  string  $nameAds
     * @return void
     */
    public function __construct($nameAds)
    {
        $this->idAds = config('config-ads.NAME_ADS.'.$nameAds.'');

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout.box-ads');
    }
}
