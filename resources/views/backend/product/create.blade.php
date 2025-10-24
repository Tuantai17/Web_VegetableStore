<x-layout-admin>
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="content-wrapper space-y-6">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-100 to-blue-50 border border-blue-200 rounded-xl p-4 shadow flex items-center justify-between">
                <h2 class="text-2xl font-bold text-blue-700">🛍️ Thêm Sản Phẩm</h2>
                <div class="space-x-2">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 px-5 py-2 rounded-xl text-white font-semibold shadow">
                        <i class="fa fa-save mr-1"></i> Lưu
                    </button>
                    <a href="{{ route('product.index') }}" class="bg-indigo-500 hover:bg-indigo-600 px-5 py-2 rounded-xl text-white font-semibold shadow">
                        <i class="fa fa-arrow-left mr-1"></i> Quay lại
                    </a>
                </div>
            </div>

            <!-- Form chính -->
            <div class="bg-white border border-blue-100 rounded-xl p-6 shadow space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tên sản phẩm -->
                    <div>
                        <label for="name" class="block font-medium text-gray-700">Tên sản phẩm</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full mt-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 outline-none"
                            placeholder="Nhập tên sản phẩm" required>
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Số lượng -->
                    <div>
                        <label for="qty" class="block font-medium text-gray-700">Số lượng</label>
                        <input type="number" name="qty" id="qty" value="1" min="1"
                            class="w-full mt-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 outline-none">
                    </div>

                    <!-- Giá bán -->
                    <div>
                        <label for="price_root" class="block font-medium text-gray-700">Giá bán</label>
                        <input type="number" name="price_root" id="price_root" value="{{ old('price_root', 100) }}"
                            class="w-full mt-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 outline-none" required>
                    </div>

                    <!-- Giá khuyến mãi -->
                    <div>
                        <label for="price_sale" class="block font-medium text-gray-700">Giá khuyến mãi</label>
                        <input type="number" name="price_sale" id="price_sale"
                            class="w-full mt-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 outline-none">
                        @error('price_sale') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Danh mục -->
                    <div>
                        <label for="category_id" class="block font-medium text-gray-700">Danh mục</label>
                        <select name="category_id" id="category_id"
                            class="w-full mt-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 outline-none">
                            <option value="">-- Chọn danh mục --</option>
                            @foreach ($list_category as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Thương hiệu -->
                    <div>
                        <label for="brand_id" class="block font-medium text-gray-700">Thương hiệu</label>
                        <select name="brand_id" id="brand_id"
                            class="w-full mt-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 outline-none">
                            <option value="">-- Chọn thương hiệu --</option>
                            @foreach ($list_brand as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Chi tiết sản phẩm -->
                <div>
                    <label for="detail" class="block font-medium text-gray-700">Chi tiết sản phẩm</label>
                    <textarea name="detail" id="detail" rows="4"
                        class="w-full mt-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 outline-none"
                        placeholder="Nhập chi tiết sản phẩm">{{ old('detail') }}</textarea>
                    @error('detail') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Mô tả -->
                <div>
                    <label for="description" class="block font-medium text-gray-700">Mô tả</label>
                    <textarea name="description" id="description"
                        class="w-full mt-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 outline-none"
                        placeholder="Nhập mô tả sản phẩm">{{ old('description') }}</textarea>
                </div>

                <!-- Hình ảnh -->
                <div>
                    <label for="thumbnail" class="block font-medium text-gray-700">Hình ảnh</label>
                    <input type="file" name="thumbnail" id="thumbnail"
                        class="w-full mt-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 outline-none">
                    @error('thumbnail') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Trạng thái -->
                <div>
                    <label for="status" class="block font-medium text-gray-700">Trạng thái</label>
                    <select name="status" id="status"
                        class="w-full mt-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 outline-none">
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Xuất bản</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Không xuất bản</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
</x-layout-admin>
