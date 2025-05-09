<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $id;
    public $label;
    public $name;
    public $type;
    public $value;
    public $placeholder;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $id,
        $name,
        $placeholder,
        $type = 'text',
        $label = null,
        $value = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
