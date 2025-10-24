<x-layout-admin>
@if (session('success'))
    <div class="p-4 mb-6 bg-green-100 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="p-4 mb-6 bg-red-100 text-red-800 rounded">
        {{ session('error') }}
    </div>
@endif

<div class="container mx-auto mt-8 p-6 bg-white rounded shadow-md">

    <h2 class="text-2xl font-bold text-pink-600 mb-6">➕ Thêm bài viết mới</h2>

    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Tiêu đề -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-semibold mb-2">Tiêu đề bài viết</label>
            <input type="text" id="title" name="title" class="w-full p-3 border rounded focus:outline-pink-500" value="{{ old('title') }}" required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nội dung chi tiết -->
        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-semibold mb-2">Nội dung chi tiết</label>
            <textarea id="content" name="content" rows="6" class="w-full p-3 border rounded focus:outline-pink-500" required>{{ old('content') }}</textarea>
            @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Mô tả ngắn -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-semibold mb-2">Mô tả ngắn</label>
            <textarea id="description" name="description" rows="4" class="w-full p-3 border rounded focus:outline-pink-500">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Ảnh thumbnail -->
        <div class="mb-4">
            <label for="thumbnail" class="block text-gray-700 font-semibold mb-2">Ảnh đại diện</label>
            <input type="file" id="thumbnail" name="thumbnail" accept="image/*" class="w-full p-2 border rounded focus:outline-pink-500">
            @error('thumbnail')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Trạng thái -->
        <div class="mb-6">
            <label for="status" class="block text-gray-700 font-semibold mb-2">Trạng thái</label>
            <select id="status" name="status" class="w-full p-3 border rounded focus:outline-pink-500">
                <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Ẩn</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-6 rounded shadow transition">
                Lưu bài viết
            </button>
        </div>
    </form>

</div>
</x-layout-admin>
