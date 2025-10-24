<x-layout-admin>
    <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="border border-blue-100 mb-3 rounded-lg p-3">
            <!-- Header -->
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-blue-600">THÊM BANNER</h2>
                <div class="text-right">
                    <button type="submit" class="bg-green-500 px-4 py-2 cursor-pointer rounded-xl text-white">
                        <i class="fa fa-save"></i> Lưu
                    </button>
                    <a href="{{ route('banner.index') }}" class="bg-sky-500 px-4 py-2 rounded-xl text-white">
                        <i class="fa fa-arrow-left"></i> Về danh sách
                    </a>
                </div>
            </div>

            <!-- Tên banner -->
            <div class="mb-3">
                <label class="font-semibold">Tên Banner</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <!-- Hình ảnh -->
            <div class="mb-3">
                <label class="font-semibold">Hình ảnh</label>
                <input type="file" name="image"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                @error('image') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <!-- Thứ tự -->
            <div class="mb-3">
                <label class="font-semibold">Thứ tự</label>
                <input type="number" name="order" value="1"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Vị trí -->
            <div class="mb-3">
                <label class="font-semibold">Vị trí</label>
                <select name="position" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                    <option value="slideshow" {{ old('position') == 'slideshow' ? 'selected' : '' }}>Slideshow</option>
                    <option value="sidebar" {{ old('position') == 'sidebar' ? 'selected' : '' }}>Sidebar</option>
                </select>
                @error('position') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>
    </form>
</x-layout-admin>
