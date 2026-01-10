<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Avatar extends Component
{
    public $user;
    public $size;
    public $name;
    public $avatar;

    public function __construct($user = null, $size = 50, $name = null, $avatar = null)
    {
        $this->user = $user;
        $this->size = $size;
        $this->name = $name ?? ($user->name ?? 'User');
        $this->avatar = $avatar ?? ($user->avatar ?? null);
    }

    public function render()
    {
        return view('components.avatar');
    }
}