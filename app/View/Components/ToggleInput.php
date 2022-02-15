<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ToggleInput extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $value = false,$placeholder = '', $hint = null)
    {
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->hint = $hint;
        $this->value = $value;
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

            return view('components.toggle-input')->with([
                'name' => $this->name,
                'placeholder' => $this->placeholder,
                'hint' => $this->hint,
                'value' => $this->value,
                'attributes' => $data['attributes']
            ])->render();
        };
    }
}
