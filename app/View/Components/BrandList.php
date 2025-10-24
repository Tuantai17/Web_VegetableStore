<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Brand; // Assuming you have a Brand model

class BrandList extends Component
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
        $brand_list = Brand::select('id', 'name')
                          ->where('status', 1)
                          ->orderBy('sort_order')
                          ->get();

        return view('components.brand-list', [
            'brand_list' => $brand_list,
        ]);
    }
}