<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;


class ProductSale extends Component
{
   
    public function __construct()
    {
        //
    }

    
    public function render(): View|Closure|string
    {
        $argc_product_sale = [
            ['status','=',1],
            ['pricesale','>',0],
        ];
        
        $product_sale = Product::where('status','=',1)
            ->orderBy('created_at','desc') //mới nhất
            ->limit(4)
            ->get();
        return view('components.product-sale',compact('product_sale'));
    }
}
