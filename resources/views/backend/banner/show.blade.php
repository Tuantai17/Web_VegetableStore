<x-layout-admin>
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl overflow-hidden mt-6">
        <!-- Tiêu đề -->
        <div class="bg-gradient-to-r from-indigo-500 to-pink-500 text-white px-6 py-4">
            <h2 class="text-2xl font-bold">Chi tiết Banner</h2>
        </div>

        <!-- Nội dung chi tiết -->
        <div class="px-6 py-5 space-y-4 text-gray-800">
            <p><strong class="text-gray-700">ID:</strong> {{ $banner->id }}</p>
            <p><strong class="text-gray-700">Tên banner:</strong> {{ $banner->name }}</p>
            <p><strong class="text-gray-700">Liên kết:</strong> <a href="{{ $banner->link }}" class="text-blue-500 underline" target="_blank">{{ $banner->link }}</a></p>
            
            <p>
                <strong class="text-gray-700">Trạng thái:</strong>
                @if ($banner->status)
                    <span class="text-green-600 font-semibold">Hiển thị</span>
                @else
                    <span class="text-red-500 font-semibold">Ẩn</span>
                @endif
            </p>

            <div>
                <strong class="text-gray-700 block mb-1">Hình ảnh:</strong>
                <img src="{{ asset('assets/images/banner/' . $banner->image) }}" 
                     class="w-full max-w-md h-auto object-cover mx-auto border rounded-md" 
                     alt="{{ $banner->name }}">
            </div>

            <p><strong class="text-gray-700">Ngày tạo:</strong> {{ optional($banner->created_at)->format('d/m/Y H:i') }}</p>
            <p><strong class="text-gray-700">Ngày cập nhật:</strong> {{ optional($banner->updated_at)->format('d/m/Y H:i') }}</p>

            <!-- Nút quay về -->
            <div class="pt-4">
                <a href="{{ route('banner.index') }}"
                   class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Quay về danh sách
                </a>
            </div>
        </div>
    </div>
</x-layout-admin>
