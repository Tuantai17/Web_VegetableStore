<x-layout-admin>
    <form action="{{ route('brand.update', $brand->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="content-wrapper">
            <!-- Header -->
            <div class="border border-blue-100 mb-3 rounded-lg p-2 flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">CHỈNH SỬA THƯƠNG HIỆU</h2>
                <div class="text-right">
                    <button type="submit" class="bg-green-500 px-4 py-2 cursor-pointer rounded-xl text-white">
                        <i class="fa fa-save"></i> Cập nhật
                    </button>
                    <a href="{{ route('brand.index') }}" class="bg-sky-500 px-4 py-2 rounded-xl text-white">
                        <i class="fa fa-arrow-left"></i> Về danh sách
                    </a>
                </div>
            </div>

            <!-- Form chỉnh sửa -->
            <div class="border border-blue-100 rounded-lg p-3">
                <div class="flex gap-6">
                    <div class="basis-full">
                        <!-- Tên thương hiệu -->
                        <div class="mb-3">
                            <label for="name" class="font-semibold">Tên thương hiệu</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $brand->name) }}"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
                            @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3">
                            <label for="description" class="font-semibold">Mô tả</label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">{{ old('description', $brand->description) }}</textarea>
                            @error('description') <p class="text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Hình ảnh -->
                        <div class="mb-3">
                            <label for="image" class="font-semibold">Logo / Hình ảnh</label>
                            <input type="file" name="image" id="image"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                            @if ($brand->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $brand->image) }}" alt="Logo thương hiệu"
                                     class="w-32 h-32 object-cover rounded-lg">
                            </div>
                            @endif
                            @error('image') <p class="text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3">
                            <label for="status" class="font-semibold">Trạng thái</label>
                            <select name="status" id="status"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                                <option value="1" {{ old('status', $brand->status) == '1' ? 'selected' : '' }}>Xuất bản</option>
                                <option value="0" {{ old('status', $brand->status) == '0' ? 'selected' : '' }}>Không xuất bản</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layout-admin>
