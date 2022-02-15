<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ImageInput extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$url= null ,$placeholder = '',$hint = null)
    {
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->hint = $hint;
        $this->url = $url;
        // $this->values = $values;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function($data){
            return view('components.image-input')->with([
                'name' => $this->name,
                'placeholder' => $this->placeholder,
                'url' => $this->url,
                'attributes' => $data['attributes']
            ])->render();
        };
     
    }
}
