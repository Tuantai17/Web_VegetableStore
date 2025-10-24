<x-layout-admin title="Cập Nhật Bài Viết">
    <div class="max-w-4xl mx-auto p-6 bg-gradient-to-br from-pink-50 via-white to-purple-50 rounded-2xl shadow-lg">

        {{-- Nút quay về --}}
        <div class="mb-6">
            <a href="{{ route('post.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-pink-100 hover:bg-pink-200 text-pink-800 font-semibold rounded-md shadow-sm transition">
                ⬅️ Quay về danh sách
            </a>
        </div>

        <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Tiêu đề --}}
            <div>
                <label class="block mb-1 font-semibold text-pink-800">📝 Tiêu đề</label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}" required
                    class="w-full px-4 py-2 border-2 border-pink-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:outline-none bg-white text-pink-900">
                @error('title')
                    <div class="text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Mô tả --}}
            <div>
                <label class="block mb-1 font-semibold text-pink-800">🧾 Mô tả</label>
                <textarea name="description" rows="3"
                    class="w-full px-4 py-2 border-2 border-purple-300 rounded-lg focus:ring-2 focus:ring-purple-400 focus:outline-none bg-white text-purple-900">{{ old('description', $post->description) }}</textarea>
                @error('description')
                    <div class="text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Chi tiết --}}
            <div>
                <label class="block mb-1 font-semibold text-pink-800">📄 Chi tiết</label>
                <textarea name="detail" rows="4"
                    class="w-full px-4 py-2 border-2 border-pink-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:outline-none bg-white text-pink-900">{{ old('detail', $post->detail) }}</textarea>
                @error('detail')
                    <div class="text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Nội dung --}}
            <div>
                <label class="block mb-1 font-semibold text-purple-800">📚 Nội dung</label>
                <textarea name="content" rows="5"
                    class="w-full px-4 py-2 border-2 border-purple-300 rounded-lg focus:ring-2 focus:ring-purple-400 focus:outline-none bg-white text-purple-900">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Thumbnail --}}
            <div>
                <label class="block mb-1 font-semibold text-pink-800">🖼️ Ảnh Thumbnail</label>
                <input type="file" name="thumbnail"
                    class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:bg-gradient-to-r file:from-pink-100 file:to-purple-100 file:text-pink-700
                    hover:file:bg-pink-200 transition">
                @error('thumbnail')
                    <div class="text-red-500 mt-1">{{ $message }}</div>
                @enderror

                @if ($post->thumbnail)
                    <div class="mt-3">
                        <img src="{{ asset($post->thumbnail) }}" alt="Thumbnail"
                             class="w-32 h-32 object-cover rounded-xl border border-pink-300 shadow-md">
                    </div>
                @endif
            </div>

            {{-- Trạng thái --}}
            <div>
                <label class="block mb-1 font-semibold text-pink-800">⚙️ Trạng thái</label>
                <select name="status"
                    class="w-full px-4 py-2 border-2 border-pink-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:outline-none bg-white text-pink-900">
                    <option value="1" {{ old('status', $post->status) == 1 ? 'selected' : '' }}>✅ Hiển thị</option>
                    <option value="0" {{ old('status', $post->status) == 0 ? 'selected' : '' }}>❌ Ẩn</option>
                </select>
                @error('status')
                    <div class="text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Nút submit --}}
            <div class="text-center pt-4">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2 bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white font-semibold rounded-xl shadow-md transition">
                    💾 Cập nhật bài viết
                </button>
            </div>
        </form>
    </div>
</x-layout-admin>
