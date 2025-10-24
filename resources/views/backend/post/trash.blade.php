<x-layout-admin>
    <div class="content-wrapper">
        <!-- Tiêu đề -->
        <div class="border border-blue-100 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">THÙNG RÁC BÀI VIẾT</h2>
                <a href="{{ route('post.index') }}" class="bg-sky-500 px-3 py-2 rounded-xl text-white hover:bg-sky-600">
                    <i class="fa fa-arrow-left"></i> Về danh sách
                </a>
            </div>
        </div>

        <!-- Danh sách bài viết đã xóa -->
        <div class="border border-blue-100 rounded-lg p-2 mt-4 overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 text-sm">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 p-2 w-32">Hình ảnh</th>
                        <th class="border border-gray-300 p-2">Tiêu đề</th>
                        <th class="border border-gray-300 p-2">Mô tả</th>
                        <th class="border border-gray-300 p-2 text-center w-48">Thao tác</th>
                        <th class="border border-gray-300 p-2 w-12">ID</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($list as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 p-2 text-center">
                                @if ($item->thumbnail)
                                    <img src="{{ asset('asset/image/post/' . $item->thumbnail) }}"
                                         class="w-20 h-16 object-cover rounded shadow" alt="{{ $item->title }}">
                                @else
                                    <span class="italic text-gray-400">Không có ảnh</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 p-2">{{ $item->title }}</td>
                            <td class="border border-gray-300 p-2 text-gray-700">
                                {{ Str::limit($item->description, 60) }}
                            </td>
                            <td class="border border-gray-300 p-2 text-center">
                                <a href="{{ route('post.restore', $item->id) }}"
                                   class="inline-block text-green-600 hover:text-green-800 mx-1" title="Khôi phục">
                                    <i class="fa-solid fa-rotate-left"></i> Khôi phục
                                </a>

                                <form action="{{ route('post.delete', $item->id) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn bài viết này?');">
@csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-800 ml-2">
                                        <i class="fa-solid fa-trash-can"></i> Xoá vĩnh viễn
                                    </button>
                                </form>
                            </td>
                            <td class="border border-gray-300 p-2 text-center">{{ $item->id }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-4">Không có bài viết nào trong thùng rác.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout-admin>
