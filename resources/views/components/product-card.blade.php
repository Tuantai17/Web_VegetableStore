<div class="border rounded-2xl overflow-hidden bg-gray-50 shadow-md hover:shadow-xl transition duration-300 ease-in-out">
    <div class="overflow-hidden">
        <a href="{{ route('site.product.detail', ['slug' => $product->slug]) }}">
            <img src="{{ asset('assets/images/product/' . $product->thumbnail) }}" class="w-full h-48 object-cover" alt="{{ $product->name }}">

        </a>
    </div>

    <div class="text-center p-4 border-t border-gray-200">
        <p class="text-xs text-gray-400 uppercase tracking-wider font-medium">DIAMOND ZONE</p>

        <h2 class="text-base font-semibold text-gray-800 my-2 hover:text-primary transition">
            <a href="{{ route('site.product.detail', ['slug' => $product->slug]) }}">
                {{ $product->name }}
            </a>
        </h2>

        {{-- Giá --}}
        <div class="flex justify-center items-center gap-2 mb-2">
            @if ($product->price_sale > 0 && $product->price_sale < $product->price_root)
                <span class="text-red-500 font-bold text-lg">{{ number_format($product->price_sale) }}₫</span>
                <span class="line-through text-gray-400 text-sm">{{ number_format($product->price_root) }}₫</span>
                @else
                <span class="text-gray-700 font-bold text-lg">{{ number_format($product->price_root) }}₫</span>
                @endif
        </div>

        {{-- Tính giảm giá nếu có --}}
        @if ($product->price_sale > 0 && $product->price_sale < $product->price_root)
            @php
            $discountPercent = round((($product->price_root - $product->price_sale) / $product->price_root) * 100);
            $savedAmount = $product->price_root - $product->price_sale;
            @endphp

            <div class="flex justify-center items-center gap-2 mt-1">
                <span class="bg-gradient-to-r from-red-600 to-pink-500 text-white text-xs font-semibold px-2 py-1 rounded-full shadow-sm">
                    -{{ $discountPercent }}%
                </span>
                <span class="text-sm text-gray-500">
                    Tiết kiệm:
                    <span class="text-red-500 font-medium">{{ number_format($savedAmount) }}₫</span>
                </span>
            </div>
            @endif

    </div>
</div>