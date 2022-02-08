<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $placeholder = '', $hint = null, $icon = null)
    {
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->hint = $hint;
        $this->icon = $icon;
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
            $data['attributes']->merge([
                'type' => 'text'
            ]);

            return view('components.input-component')->with([
                'name' => $this->name,
                'placeholder' => $this->placeholder,
                'hint' => $this->hint,
                'icon' => $this->icon,
                'attributes' => $data['attributes']
            ])->render();
        };
     
    }
}
