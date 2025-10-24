<x-layout-site title="{{ $product_item->name }}">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ $product_item->name }}</h1>

        {{-- Nút quay lại --}}
        <a href="{{ route('site.product') }}" class="inline-block mb-4 text-sm text-blue-600 hover:underline">
            ← Quay lại danh sách sản phẩm
        </a>

        <img src="{{ asset('assets/images/product/' . $product_item->thumbnail) }}" alt="{{ $product_item->name }}" class="mb-4 max-w-sm rounded shadow">

        <p class="text-gray-700">{{ $product_item->description }}</p>

        {{-- Hiển thị giá (nếu có giảm giá) --}}
        <p class="mt-2 text-red-500 font-semibold text-lg">
            Giá: 
            {{ number_format($product_item->price_sale > 0 ? $product_item->price_sale : $product_item->price_root, 0, ',', '.') }}₫
        </p>

        {{-- Nút thêm vào giỏ hàng --}}
        <form action="{{ route('site.cart.add') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product_item->id }}">
            <button type="submit" class="px-5 py-2 bg-green-600 text-white font-semibold rounded hover:bg-green-700 transition duration-200">
                🛒 Thêm vào giỏ hàng
            </button>
        </form>
    </div>

    {{-- Sản phẩm liên quan --}}
    @if ($product_list->count())
        <h2 class="text-xl font-semibold mt-8 mb-4 text-green-700">Sản phẩm liên quan</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($product_list as $item)
                <div class="border rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                    <a href="{{ route('site.product.detail', $item->slug) }}">
                        <img src="{{ asset('assets/images/product/' . $item->thumbnail) }}" class="w-full h-40 object-cover" alt="{{ $item->name }}">
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-800 mb-1 truncate">{{ $item->name }}</h4>
                            <p class="text-green-600 font-bold">
                                {{ number_format($item->price_sale > 0 ? $item->price_sale : $item->price_root, 0, ',', '.') }}₫
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</x-layout-site>
