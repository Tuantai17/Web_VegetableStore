<x-layout-admin>
    <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="content-wrapper p-6 bg-white shadow-md rounded-lg">
            <!-- Header -->
            <div class="mb-4 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg flex items-center justify-between">
                <h2 class="text-2xl font-semibold text-blue-600">THÊM DANH MỤC</h2>
                <div class="space-x-2">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition ease-in-out">
                        <i class="fa fa-save"></i> Lưu
                    </button>
                    <a href="{{ route('category.index') }}" class="bg-sky-500 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded-lg transition ease-in-out">
                        <i class="fa fa-arrow-left"></i> Về danh sách
                    </a>
                </div>
            </div>

            <!-- Form chính -->
            <div class="space-y-4">
                @foreach ([
                    ['name', 'Tên danh mục'],
                    ['slug', 'Slug'],
                    ['description', 'Mô tả']
                ] as [$id, $label])
                    <div>
                        <label for="{{ $id }}" class="block font-semibold text-gray-700">{{ $label }}</label>
                        <input type="text" name="{{ $id }}" id="{{ $id }}" value="{{ old($id) }}"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" placeholder="Nhập {{ strtolower($label) }}" required>
                        @error($id) <p class="text-red-500">{{ $message }}</p> @enderror
                    </div>
                @endforeach

                <div>
                    <label for="image" class="block font-semibold text-gray-700">Logo / Hình ảnh</label>
                    <input type="file" name="image" id="image" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                    @error('image') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="parent_id" class="block font-semibold text-gray-700">Danh mục cha</label>
                    <select name="parent_id" id="parent_id" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        <option value="0" {{ old('parent_id') == '0' ? 'selected' : '' }}>Không có</option>
                        @foreach ($list_category as $category)
                            <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('parent_id') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="status" class="block font-semibold text-gray-700">Trạng thái</label>
                    <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Hiển thị</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Ẩn</option>
                    </select>
                    @error('status') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </form>
</x-layout-admin>
