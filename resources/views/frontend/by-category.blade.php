<x-layout-site>
    <x-slot:title>{{ isset($category) ? 'Danh mục: ' . $category->name : 'Tất cả sản phẩm' }}</x-slot:title>

    <main class="my-10">
        <div class="container mx-auto px-4">

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




                <!-- <select name="category"
                        class="border border-gray-300 rounded-lg px-4 py-2 min-w-[200px] text-gray-700 focus:ring-2 focus:ring-green-500">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach ($category_list as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                <select name="brand"
                        class="border border-gray-300 rounded-lg px-4 py-2 min-w-[200px] text-gray-700 focus:ring-2 focus:ring-green-500">
                    <option value="">-- Chọn thương hiệu --</option>
                    @foreach ($brand_list as $brand)
                        <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select> -->




                
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
            <section>
                <div class="mb-6">
                    <h1
                        class="text-2xl md:text-3xl font-bold text-gray-800 border-b-2 border-green-600 inline-block pb-1">
                        {{ isset($category) ? 'Danh mục: ' . $category->name : 'TẤT CẢ SẢN PHẨM' }}
                    </h1>
                </div>
                <div class="mb-4 text-sm text-gray-500">
                    <a href="{{ route('site.product') }}" class="text-blue-600 hover:underline">Trang chủ</a>
                    <span class="mx-1">/</span>
                    <span>{{ isset($category) ? $category->name : 'Tất cả sản phẩm' }}</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse ($products as $product)
                        <div
                            class="bg-white shadow-md rounded-lg overflow-hidden transition hover:shadow-lg hover:-translate-y-1">
                            <img src="{{ asset('assets/images/product/' . $product->thumbnail) }}"
                                class="w-full h-48 object-cover" alt="{{ $product->name }}">
                            <div class="p-4 text-center">
                                <h2 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h2>
                                <div class="flex justify-center items-center gap-2 my-2">
                                    @if ($product->price_sale > 0 && $product->price_sale < $product->price_root)
                                        <span class="text-red-500 font-bold text-lg">
                                            {{ number_format($product->price_sale) }}₫
                                        </span>
                                        <span class="line-through text-sm text-gray-400">
                                            {{ number_format($product->price_root) }}₫
                                        </span>
                                    @else
                                        <span class="text-gray-800 font-bold text-lg">
                                            {{ number_format($product->price_root) }}₫
                                        </span>
                                    @endif
                                </div>
                                <p class="text-gray-600 text-sm mb-3">
                                    {{ Str::limit($product->description, 50) }}
                                </p>
                                <a href="{{ url('san-pham/' . $product->slug) }}"
                                    class="inline-block bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition">
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
            </section>
        </div>
    </main>
</x-layout-site>
