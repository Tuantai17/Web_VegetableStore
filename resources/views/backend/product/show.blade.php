<x-layout-admin>
    <div class="card bg-white shadow-xl rounded-2xl overflow-hidden">
        <!-- Header -->
        <div class="card-header bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-8 py-5">
            <h2 class="text-2xl font-bold flex items-center gap-2">
                <i class="fas fa-info-circle"></i>
                Chi tiết sản phẩm, danh mục sản phẩm
            </h2>
        </div>

         <!-- Nút quay lại -->
         <div class="pt-6">
                <a href="{{ route('product.index') }}"
                   class="inline-flex items-center bg-gradient-to-r from-yellow-600 to-indigo-600 text-white px-5 py-2.5 rounded-lg shadow hover:brightness-110 transition">
                    <i class="fa fa-arrow-left mr-2"></i> Quay về danh sách
                </a>
            </div>
        <!-- Nội dung -->
        <div class="card-body px-8 py-6 space-y-6 text-gray-800 text-base">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <p><strong>ID:</strong> {{ $product->id }}</p>
                <p><strong>Slug:</strong> {{ $product->slug }}</p>
                <p><strong>Tên sản phẩm:</strong> {{ $product->name }}</p>
                <p><strong>Mô tả:</strong> {{ $product->description }}</p>
            </div>

            @php
                $customPrice = 199000;
            @endphp
            <p>
                <strong>Giá:</strong> 
                <span class="text-xl font-bold text-green-700">
                    {{ number_format($customPrice, 0, ',', '.') }} VNĐ
                </span>
            </p>

            <!-- Thông tin phụ -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Thương hiệu -->
                <div class="bg-indigo-100 p-5 rounded-xl shadow border border-indigo-300">
                    <h3 class="text-lg font-semibold text-indigo-800 mb-2 border-b pb-1">🛍️ Thương hiệu</h3>
                    <p><strong>Tên:</strong> {{ $product->brand->name ?? 'Không có' }}</p>
                    <p><strong>Trạng thái:</strong> 
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                            {{ $product->status ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                            {{ $product->status ? 'Hiển thị' : 'Ẩn' }}
                        </span>
                    </p>
                </div>

                <!-- Danh mục -->
                <div class="bg-yellow-100 p-5 rounded-xl shadow border border-yellow-300">
                    <h3 class="text-lg font-semibold text-yellow-800 mb-2 border-b pb-1">📂 Danh mục</h3>
                    <p><strong>Tên:</strong> {{ $product->category->name ?? 'Chưa phân loại' }}</p>
                    <p><strong>Slug:</strong> {{ $product->category->slug ?? 'Chưa phân loại' }}</p>
                    <p><strong>Mô tả:</strong> {{ $product->category->description ?? 'Chưa có mô tả' }}</p>
                    <p><strong>Trạng thái:</strong> 
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                            {{ $product->category && $product->category->status ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                            {{ $product->category && $product->category->status ? 'Hiển thị' : 'Ẩn' }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Hình ảnh -->
            <div>
                <p><strong>Hình ảnh:</strong></p>
                <img src="{{ asset('assets/images/product/' . $product->thumbnail) }}"
                    class="w-full max-w-md h-auto rounded-xl shadow-lg object-cover transition-transform duration-300 hover:scale-105 border"
                    alt="{{ $product->name }}">
            </div>

            <!-- Ngày tạo, cập nhật -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <p><strong>Ngày tạo:</strong> {{ optional($product->created_at)->format('d/m/Y H:i') }}</p>
                <p><strong>Ngày cập nhật:</strong> {{ optional($product->updated_at)->format('d/m/Y H:i') }}</p>
            </div>

           
        </div>
    </div>
</x-layout-admin>
