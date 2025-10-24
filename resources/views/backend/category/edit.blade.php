<x-layout-admin>
    <x-slot:title>
        Chỉnh sửa danh mục
    </x-slot:title>

    <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="content-wrapper">
            <!-- Thanh tiêu đề -->
            <div class="border border-blue-100 mb-3 rounded-lg p-2 flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">CHỈNH SỬA DANH MỤC</h2>
                <div class="text-right">
                    <button type="submit" class="bg-green-500 px-4 py-2 rounded-xl text-white">
                        <i class="fa fa-save"></i> Cập nhật
                    </button>
                    <a href="{{ route('category.index') }}" class="bg-sky-500 px-4 py-2 rounded-xl text-white">
                        <i class="fa fa-arrow-left"></i> Về danh sách
                    </a>
                </div>
            </div>

            <!-- Form chính -->
            <div class="border border-blue-100 rounded-lg p-4 w-full max-w-2xl">
                <!-- Tên danh mục -->
                <div class="mb-4">
                    <label for="name" class="block font-semibold mb-1">Tên danh mục</label>
                    <input type="text" name="name" id="name"
                        value="{{ old('name', $category->name) }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Slug -->
                <div class="mb-4">
                    <label for="slug" class="block font-semibold mb-1">Slug</label>
                    <input type="text" name="slug" id="slug"
                        value="{{ old('slug', $category->slug) }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                    @error('slug') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Mô tả -->
                <div class="mb-4">
                    <label for="description" class="block font-semibold mb-1">Mô tả</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">{{ old('description', $category->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

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

                <!-- Trạng thái -->
                <div class="mb-4">
                    <label for="status" class="block font-semibold mb-1">Trạng thái</label>
                    <select name="status" id="status"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        <option value="1" {{ old('status', $category->status) == '1' ? 'selected' : '' }}>Xuất bản</option>
                        <option value="0" {{ old('status', $category->status) == '0' ? 'selected' : '' }}>Không xuất bản</option>
                    </select>
                    @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </form>
</x-layout-admin>