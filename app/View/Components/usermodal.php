<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class usermodal extends Component
{
    public $idname = '';
    public $title = '';
    public $btnid = '';
    public $roles;

    public $nameinput1 = '';
    public $nameinput2 = '';
    public $idinput1 = '';

    public $idinput2 = '';

    /**
     * Create a new component instance.
     */
    public function __construct($idname,$title,$btnid,$roles,$nameinput1,$nameinput2,$idinput1,$idinput2)
    {
        $this->idname = $idname;
        $this->title = $title;
        $this->btnid = $btnid;
        $this->roles = $roles;
        $this->nameinput1 = $nameinput1;
        $this->nameinput2 = $nameinput2;
        $this->idinput1 = $idinput1;
        $this->idinput2 = $idinput2;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-modal');
    }
}
