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

    public $username = '';
    public $userid = '';
    public $emialinput = '';

    public $emailid = '';
    public $passwordinput = '';
    public $passowrdid = '';
    public $page = '';
    public $rolename = '';


    /**
     * Create a new component instance.
     */
    public function __construct($idname,$title,$rolename,$btnid,$Username,$userid,$emialinput,$emailid,$page,$roles,$passwordinput = '',$passowrdid = '')
    {
        $this->idname = $idname;
        $this->title = $title;
        $this->btnid = $btnid;
        $this->roles = $roles;
        $this->username = $Username;
        $this->userid = $userid;
        $this->emialinput = $emialinput;
        $this->emailid = $emailid;
        $this->passwordinput = $passwordinput;
        $this->passowrdid = $passowrdid;
        $this->page = $page;
        $this->roles = $roles;
        $this->rolename = $rolename;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-modal');
    }
}
