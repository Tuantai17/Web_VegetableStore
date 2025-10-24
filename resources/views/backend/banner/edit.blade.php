<x-layout-admin>
    <form action="{{ route('banner.update', $banner->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="content-wrapper">
            <!-- Header -->
            <div class="border border-blue-100 mb-3 rounded-lg p-2 flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">CHỈNH SỬA BANNER</h2>
                <div class="text-right">
                    <button type="submit" class="bg-green-500 px-4 py-2 cursor-pointer rounded-xl text-white">
                        <i class="fa fa-save"></i> Cập nhật
                    </button>
                    <a href="{{ route('banner.index') }}" class="bg-sky-500 px-4 py-2 rounded-xl text-white">
                        <i class="fa fa-arrow-left"></i> Về danh sách
                    </a>
                </div>
            </div>

            <!-- Form chính -->
            <div class="border border-blue-100 rounded-lg p-3">
                <div class="mb-3">
                    <label for="name" class="font-semibold">Tiêu đề Banner</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $banner->name) }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                    @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="mb-3">
                    <label for="link" class="font-semibold">Liên kết</label>
                    <input type="text" name="link" id="link" value="{{ old('link', $banner->link) }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                    @error('link') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="mb-3">
                    <label for="position" class="font-semibold">Vị trí</label>
                    <select name="position" id="position"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        <option value="main" {{ old('position', $banner->position) == 'main' ? 'selected' : '' }}>Main</option>
                        <option value="sidebar" {{ old('position', $banner->position) == 'sidebar' ? 'selected' : '' }}>Sidebar</option>
                    </select>
                    @error('position') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="mb-3">
                    <label for="sort_order" class="font-semibold">Thứ tự hiển thị</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $banner->sort_order) }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                    @error('sort_order') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="font-semibold">Trạng thái</label>
                    <select name="status" id="status"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        <option value="1" {{ old('status', $banner->status) == 1 ? 'selected' : '' }}>Xuất bản</option>
                        <option value="0" {{ old('status', $banner->status) == 0 ? 'selected' : '' }}>Không xuất bản</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="font-semibold">Hình ảnh</label>
                    <input type="file" name="image" id="image"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                    @if ($banner->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="Ảnh banner" class="w-64 h-36 object-cover rounded-lg">
                    </div>
                    @endif
                    @error('image') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </form>
</x-layout-admin>
