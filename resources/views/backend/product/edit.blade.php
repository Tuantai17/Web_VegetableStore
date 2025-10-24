<x-layout-admin>
    <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="content-wrapper">
            <!-- Header -->
            <div class="border border-blue-100 mb-3 rounded-lg p-2 flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">CHỈNH SỬA SẢN PHẨM</h2>
                <div class="text-right">
                    <button type="submit" class="bg-green-500 px-4 py-2 cursor-pointer rounded-xl text-white">
                        <i class="fa fa-save"></i> Cập nhật
                    </button>
                    <a href="{{ route('product.index') }}" class="bg-sky-500 px-4 py-2 rounded-xl text-white">
                        <i class="fa fa-arrow-left"></i> Về danh sách
                    </a>
                </div>
            </div>

            <!-- Form chính -->
            <div class="border border-blue-100 rounded-lg p-3">
                <div class="flex gap-6">
                    <div class="basis-9/12">
                        <!-- Tên sản phẩm -->
                        <div class="mb-3">
                            <label for="name" class="font-semibold">Tên sản phẩm</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
                            @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Chi tiết sản phẩm -->
                        <div class="mb-3">
                            <label for="detail" class="font-semibold">Chi tiết sản phẩm</label>
                            <textarea name="detail" id="detail" rows="4"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">{{ old('detail', $product->detail) }}</textarea>
                            @error('detail') <p class="text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3">
                            <label for="description" class="font-semibold">Mô tả</label>
                            <textarea name="description" id="description"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <!-- Giá bán & Giá khuyến mãi -->
                        <div class="flex gap-5">
                            <div class="mb-3 flex-1">
                                <label for="price_root" class="font-semibold">Giá bán</label>
                                <input type="number" name="price_root" id="price_root" value="{{ old('price_root', $product->price_root) }}"
                                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div class="mb-3 flex-1">
                                <label for="price_sale" class="font-semibold">Giá khuyến mãi</label>
                                <input type="number" name="price_sale" id="price_sale"
                                    value="{{ old('price_sale', $product->price_sale) }}"
                                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                                @error('price_sale') <p class="text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Số lượng -->
                        <div class="mb-3">
                            <label for="qty" class="font-semibold">Số lượng</label>
                            <input type="number" name="qty" id="qty" value="{{ old('qty', $product->qty) }}" min="1"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Danh mục -->
                        <div class="mb-3">
                            <label for="category_id" class="font-semibold">Danh mục</label>
                            <select name="category_id" id="category_id"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                                <option value="">Chọn danh mục</option>
                                @foreach ($list_category as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Thương hiệu -->
                        <div class="mb-3">
                            <label for="brand_id" class="font-semibold">Thương hiệu</label>
                            <select name="brand_id" id="brand_id"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                                <option value="">Chọn thương hiệu</option>
                                @foreach ($list_brand as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('brand_id') <p class="text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Hình ảnh -->
                        <div class="mb-3">
                            <label for="thumbnail" class="font-semibold">Hình ảnh</label>
                            <input type="file" name="thumbnail" id="thumbnail"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                            @if ($product->thumbnail)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Ảnh sản phẩm" class="w-32 h-32 object-cover rounded-lg">
                            </div>
                            @endif
                            @error('thumbnail') <p class="text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3">
                            <label for="status" class="font-semibold">Trạng thái</label>
                            <select name="status" id="status"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                                <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : '' }}>Xuất bản</option>
                                <option value="0" {{ old('status', $product->status) == '0' ? 'selected' : '' }}>Không xuất bản</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layout-admin>