<x-layout-site>
    <x-slot:title>{{ isset($category) ? 'Danh mục: ' . $category->name : 'Tất cả sản phẩm' }}</x-slot:title>

    <main class="my-10">
        <!-- FORM LỌC -->
        <section class="mb-10">
            <form method="GET"
                  action="{{ isset($category) ? route('site.product.byCategory', $category->slug) : route('site.product') }}"
                  class="bg-white shadow-md rounded-xl p-6 flex flex-wrap gap-4 items-center justify-start">
                <!-- Giá từ -->
                <input type="number" name="min_price" placeholder="Giá từ"
                       value="{{ request('min_price') }}"
                       class="border border-gray-300 rounded-lg px-4 py-2 w-36 focus:ring-2 focus:ring-green-500" />

                <!-- Giá đến -->
                <input type="number" name="max_price" placeholder="Đến"
                       value="{{ request('max_price') }}"
                       class="border border-gray-300 rounded-lg px-4 py-2 w-36 focus:ring-2 focus:ring-green-500" />

                <!-- Danh mục -->
                <select name="category"
                        class="border border-gray-300 rounded-lg px-4 py-2 min-w-[200px] text-gray-700 focus:ring-2 focus:ring-green-500">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach ($category_list as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Thương hiệu -->
                <select name="brand"
                        class="border border-gray-300 rounded-lg px-4 py-2 min-w-[200px] text-gray-700 focus:ring-2 focus:ring-green-500">
                    <option value="">-- Chọn thương hiệu --</option>
                    @foreach ($brand_list as $brand)
                        <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Nút lọc -->
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow transition-all duration-200">
                    Lọc
                </button>

                <!-- Nút reset -->
                <a href="{{ isset($category) ? route('site.product.byCategory', $category->slug) : route('site.product') }}"
                   class="text-blue-600 hover:underline transition text-sm ml-2">
                    Đặt lại
                </a>
            </form>
        </section>

        <!-- DANH SÁCH SẢN PHẨM -->
        <div class="container mx-auto px-2 md:px-4">
            <div class="w-full">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">
                        {{ isset($category) ? 'Danh mục: ' . $category->name : 'Tất cả sản phẩm' }}
                    </h1>

                    @php
                        $filters = [];

                        if (request('min_price') || request('max_price')) {
                            $min = number_format(request('min_price') ?? 0);
                            $max = number_format(request('max_price') ?? 0);
                            $filters[] = "Giá từ {$min}₫ đến {$max}₫";
                        }

                        if (request('category')) {
                            $cat = $category_list->firstWhere('id', request('category'));
                            if ($cat) $filters[] = "Danh mục: " . $cat->name;
                        }

                        if (request('brand')) {
                            $brand = $brand_list->firstWhere('id', request('brand'));
                            if ($brand) $filters[] = "Thương hiệu: " . $brand->name;
                        }
                    @endphp

                    @if (count($filters))
    <div class="bg-green-50 border border-green-300 p-5 rounded-2xl shadow-lg text-sm text-green-800">
        <h2 class="font-bold text-green-900 text-base mb-3 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zM3 16a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" />
            </svg>
            Đang lọc theo:
        </h2>
        <ul class="list-disc list-inside space-y-1">
            @foreach ($filters as $f)
                <li>{{ $f }}</li>
            @endforeach
        </ul>
    </div>
@endif


                </div>

                <!-- GRID SẢN PHẨM -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse ($products as $product)
                        <div class="bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-lg transition duration-300 overflow-hidden">
                            <img src="{{ asset('assets/images/product/' . $product->thumbnail) }}"
                                 class="w-full h-48 object-cover" alt="{{ $product->name }}">
                            <div class="p-4 text-center">
                                <h2 class="text-base md:text-lg font-semibold text-gray-900 mb-1">{{ $product->name }}</h2>

                                <!-- Giá -->
                                <div class="flex justify-center items-center gap-2 mb-2">
                                    @if ($product->price_sale > 0 && $product->price_sale < $product->price_root)
                                        <span class="text-red-500 font-bold text-lg">{{ number_format($product->price_sale) }}₫</span>
                                        <span class="line-through text-gray-400 text-sm">{{ number_format($product->price_root) }}₫</span>
                                    @else
                                        <span class="text-gray-700 font-bold text-lg">{{ number_format($product->price_root) }}₫</span>
                                    @endif
                                </div>

                                <p class="text-gray-500 text-sm h-[40px] overflow-hidden">{{ Str::limit($product->description, 50) }}</p>

                                <a href="{{ route('site.product.detail', $product->slug) }}"
                                   class="mt-4 inline-block bg-pink-500 hover:bg-pink-600 text-white px-5 py-2 rounded-full transition-all duration-200">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="col-span-full text-center text-gray-500">Không có sản phẩm phù hợp.</p>
                    @endforelse
                </div>

                <!-- PHÂN TRANG -->
                <div class="mt-10 flex justify-center">
                    {{ $products->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </main>
</x-layout-site>
