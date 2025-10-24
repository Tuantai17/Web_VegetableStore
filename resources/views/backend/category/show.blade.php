<x-layout-admin>
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="bg-gradient-to-r from-green-500 to-lime-500 text-white px-6 py-4">
            <h2 class="text-2xl font-bold">Chi tiết danh mục</h2>
        </div>

        <div class="px-6 py-5 space-y-4">
            <p><strong class="text-gray-700">ID:</strong> {{ $category->id }}</p>

            <p><strong class="text-gray-700">Tên danh mục:</strong> {{ $category->name }}</p>

            <p><strong class="text-gray-700">Slug:</strong> {{ $category->slug }}</p>

            <p>
                <strong class="text-gray-700">Mô tả:</strong>
                <span class="text-gray-600">
                    {{ $category->description ?? 'Chưa có mô tả' }}
                </span>
            </p>

            <p>
                <strong class="text-gray-700">Trạng thái:</strong>
                @if ($category->status)
                    <span class="text-green-600 font-semibold">Hiển thị</span>
                @else
                    <span class="text-red-500 font-semibold">Ẩn</span>
                @endif
            </p>

           <!-- Hình ảnh -->
           <div class="mb-4">
                    <label for="image" class="block font-semibold mb-1">Hình ảnh hiện tại</label>
                    @if ($category->image)
<img src="{{ asset('assets/images/category/' . $category->image) }}" alt="{{ $category->name }}" class="w-32 h-auto mb-2">
                    @endif
                    <input type="file" name="image" id="image"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                    @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>


                
            <p><strong class="text-gray-700">Ngày tạo:</strong> {{ optional($category->created_at)->format('d/m/Y H:i') }}</p>
            <p><strong class="text-gray-700">Ngày cập nhật:</strong> {{ optional($category->updated_at)->format('d/m/Y H:i') }}</p>

            <div class="pt-4">
                <a href="{{ route('category.index') }}" 
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow">
                    ← Quay về danh sách
                </a>
            </div>
        </div>
    </div>
</x-layout-admin>
