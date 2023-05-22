<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddRole extends Component
{
    public $idname = '';
    public $title = '';
    public $btnid = '';
    public $name = '';
    public $id = '';
    public $role;
    /**
     * Create a new component instance.
     */
    public function __construct($idname,$title,$btnid,$name,$id,$role)
    {
        $this->idname = $idname;
        $this->title = $title;
        $this->btnid = $btnid;
        $this->name = $name;
        $this->id = $id;
        $this->role = $role;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.add-role');
    }
}
