<x-layout-admin>
    <div class="content-wrapper p-6">
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <h2 class="text-3xl font-semibold text-indigo-600">Chi tiết bài viết</h2>
            <a href="{{ route('post.index') }}" class="text-white bg-blue-600 hover:bg-blue-700 px-5 py-2 rounded-full mt-4 inline-block transition duration-300 ease-in-out transform hover:scale-105">
                <i class="fa fa-arrow-left"></i> Quay lại danh sách
            </a>
        </div>

        <div class="bg-white p-6 shadow-md rounded-lg">
            <div class="space-y-4">
                <p><strong class="text-lg font-medium">ID:</strong> <span class="text-gray-600">{{ $list->id }}</span></p>
                <p><strong class="text-lg font-medium">Tiêu đề:</strong> <span class="text-gray-700">{{ $list->title }}</span></p>
                <p><strong class="text-lg font-medium">Slug:</strong> <span class="text-gray-700">{{ $list->slug }}</span></p>
                <p><strong class="text-lg font-medium">Mô tả:</strong> <span class="text-gray-700">{{ $list->description }}</span></p>
                <p><strong class="text-lg font-medium">Chi tiết:</strong> <span class="text-gray-700">{{ $list->detail }}</span></p>
                <p><strong class="text-lg font-medium">Nội dung:</strong> <span class="text-gray-700">{!! $list->content !!}</span></p>
                <p><strong class="text-lg font-medium">Trạng thái:</strong> 
                    <span class="{{ $list->status == 1 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $list->status == 1 ? 'Hiển thị' : 'Ẩn' }}
                    </span>
                </p>
                <p><strong class="text-lg font-medium">Ngày tạo:</strong> 
                    <span class="text-gray-600">{{ $list->created_at ? $list->created_at->format('d/m/Y H:i') : 'Không xác định' }}</span>
                </p>
                <p><strong class="text-lg font-medium">Ngày cập nhật:</strong>
                    <span class="text-gray-600">{{ $list->updated_at ? $list->updated_at->format('d/m/Y H:i') : 'Chưa cập nhật' }}</span>
                </p>
                <p><strong class="text-lg font-medium">Người tạo:</strong> 
                    <span class="text-gray-600">{{ $list->created_by ?? 'Không rõ' }}</span>
                </p>
            </div>
            <div class="mt-6">
                <strong class="text-lg font-medium">Ảnh đại diện:</strong>
                <div class="mt-2">
                    @if($list->thumbnail)
                    <img 
                        src="{{ asset('asset/image/post/' . $list->thumbnail) }}" 
                        alt="{{ $list->title }}"
                        class="rounded-xl shadow-md w-full max-w-md h-auto object-cover"
                    >
                    @else
                        <p class="text-gray-500 italic">Không có ảnh</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout-admin>
