<x-layout-admin>
    <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="content-wrapper">
            <!-- Header -->
            <div class="border border-blue-300 mb-6 rounded-lg p-4 flex items-center justify-between bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md">
                <h2 class="text-2xl font-semibold">THÊM NHÃN HÀNG</h2>
                <div class="text-right">
                    <button type="submit" class="bg-green-600 px-6 py-3 cursor-pointer rounded-xl text-white hover:bg-green-700 transition duration-300 ease-in-out">
                        <i class="fa fa-save"></i> Lưu
                    </button>
                    <a href="{{ route('brand.index') }}" class="bg-sky-600 px-6 py-3 rounded-xl text-white hover:bg-sky-700 transition duration-300 ease-in-out">
                        <i class="fa fa-arrow-left"></i> Về danh sách
                    </a>
                </div>
            </div>

            <!-- Form chính -->
            <div class="border border-blue-200 rounded-lg p-6 bg-white shadow-lg">
                <div class="mb-5">
                    <label for="name" class="font-semibold text-xl text-gray-700">Tên nhãn hàng</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="w-full border border-gray-300 rounded-lg p-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Nhập tên nhãn hàng" required>
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-5">
                    <label for="description" class="font-semibold text-xl text-gray-700">Mô tả</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full border border-gray-300 rounded-lg p-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-5">
                    <label for="image" class="font-semibold text-xl text-gray-700">Logo / Hình ảnh</label>
                    <input type="file" name="image" id="image"
                        class="w-full border border-gray-300 rounded-lg p-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-5">
                    <label for="status" class="font-semibold text-xl text-gray-700">Trạng thái</label>
                    <select name="status" id="status"
                        class="w-full border border-gray-300 rounded-lg p-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Hiển thị</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Ẩn</option>
                    </select>
                    @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </form>
</x-layout-admin>
