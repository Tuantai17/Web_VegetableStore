<x-layout-admin>
    <form action="{{ route('topic.update', $topic->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="content-wrapper">
            <!-- Header -->
            <div class="border border-blue-100 mb-3 rounded-lg p-2 flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">CHỈNH SỬA CHỦ ĐỀ</h2>
                <div class="text-right">
                    <button type="submit" class="bg-green-500 px-4 py-2 cursor-pointer rounded-xl text-white">
                        <i class="fa fa-save"></i> Cập nhật
                    </button>
                    <a href="{{ route('topic.index') }}" class="bg-sky-500 px-4 py-2 rounded-xl text-white">
                        <i class="fa fa-arrow-left"></i> Về danh sách
                    </a>
                </div>
            </div>

            <!-- Form chính -->
            <div class="border border-blue-100 rounded-lg p-3">
                <!-- Tên chủ đề -->
                <div class="mb-3">
                    <label for="name" class="font-semibold">Tên chủ đề</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $topic->name) }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
                    @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Mô tả -->
                <div class="mb-3">
                    <label for="description" class="font-semibold">Mô tả</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">{{ old('description', $topic->description) }}</textarea>
                    @error('description') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Trạng thái -->
                <div class="mb-3">
                    <label for="status" class="font-semibold">Trạng thái</label>
                    <select name="status" id="status"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        <option value="1" {{ old('status', $topic->status) == 1 ? 'selected' : '' }}>Xuất bản</option>
                        <option value="0" {{ old('status', $topic->status) == 0 ? 'selected' : '' }}>Không xuất bản</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
</x-layout-admin>
