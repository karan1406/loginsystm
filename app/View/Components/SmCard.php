<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SmCard extends Component
{
    public $bgcolor = "";
    public $text = "";
    public $price = "";
    public $description = "";
    /**
     * Create a new component instance.
     */
    public function __construct($bgcolor,$text,$price,$description)
    {
     $this->bgcolor = $bgcolor;
     $this->text = $text;
     $this->price = $price;
     $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sm-card');
    }
}
