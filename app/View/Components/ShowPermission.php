<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Spatie\Permission\Models\Permission;

class ShowPermission extends Component
{
  public $find = "";
  public $rolePermission;
  public $page = "";
    /**
     * Create a new component instance.
     */
    public function __construct($find,$page,$rolePermission = '')
    {
        $this->find = $find;
        $this->rolePermission = $rolePermission;
        $this->page = $page;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $permissions = Permission::all();
        return view('components.show-permission',compact('permissions'));
    }
}
