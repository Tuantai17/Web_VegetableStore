<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostItem extends Component
{
    public $post_row;

    public function __construct($postitem)
    {
        $this->post_row = $postitem;
    }

    public function render(): View|Closure|string
    {
        return view('components.post-item', [
            'post' => $this->post_row
        ]);
    }
}