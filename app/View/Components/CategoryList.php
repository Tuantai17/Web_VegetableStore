<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category; // Assuming you have a Category model

class CategoryList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|string
    {
        $category_list = Category::select('id', 'name')
                             ->where('status', 1)
                             ->orderBy('sort_order')
                             ->get();

        return view('components.category-list', [
            'category_list' => $category_list,
        ]);
    }
}