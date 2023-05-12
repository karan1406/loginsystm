<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $total = " ";
    public $text = "";
    public $bgcolor = "";
    public $title = "";
    /**
     * Create a new component instance.
     */
    public function __construct($total,$text,$bgcolor,$title)
    {
            $this->total = $total;
            $this->text = $text;
            $this->bgcolor = $bgcolor;
            $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
