<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Avaliation extends Component
{

    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $value = $this->value /2;
        $whole = floor($value); 
        $fraction = $value - $whole;
        $stars = array_fill(0, $whole, "-fill");
        if ($fraction > 0 ) {
            array_push($stars, '-half');
        };
        $stars = [...$stars, ...array_fill(0,  5 - count($stars), '')];
        return view('components.avaliation')->with(['stars'=>$stars]);
    }
}
