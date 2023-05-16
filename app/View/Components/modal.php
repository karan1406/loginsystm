<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modal extends Component
{
    public $idname = '';
    public $title = '';
    public $btnid = '';

    /**
     * Create a new component instance.
     */
    public function __construct($idname,$title,$btnid)
    {
        $this->idname = $idname;
        $this->title = $title;
        $this->btnid = $btnid;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}
