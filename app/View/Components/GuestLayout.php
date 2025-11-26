<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Laravolt\Avatar\Avatar;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function __construct(public $title = null){
        
    }
    public function render(): View
    {
        return view('layouts.guest');
    }
}
