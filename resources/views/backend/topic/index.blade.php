<x-layout-admin>
    <x-slot:title>
        Quản Lí Chủ Đề
    </x-slot:title>

    <div class="content-wrapper">
        <!-- Thanh tiêu đề -->
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-pink-600">Danh Sách Chủ Đề</h2>
                <div>
                    <a href="{{ route('topic.create') }}" class="bg-green-500 px-3 py-2 rounded text-white">
                        <i class="fa fa-plus"></i> Thêm mới
                    </a>
                    <a href="{{ route('topic.trash') }}" class="bg-red-500 px-3 py-2 rounded text-white">
                        <i class="fa fa-trash"></i> Thùng rác
                    </a>
                </div>
            </div>
        </div>

        <!-- Bảng danh mục -->
        <div class="border border-blue-100 rounded-lg p-2">
            <table class="border-collapse border border-gray-400 w-full">
                <thead>
                    <tr>
                        <th class="border border-gray-300 p-2">ID</th>
                        <th class="border border-gray-300 p-2">Tên Chủ Đề</th>
                        <th class="border border-gray-300 p-2">Slug</th>
                        <th class="border border-gray-300 p-2">Trạng thái</th>
                        <th class="border border-gray-300 p-2">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr>
                            <td class="border border-gray-300 p-2">{{ $item->id }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->name }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->slug }}</td>
                            <td class="border border-gray-300 p-2">
                                @if ($item->status == 1)
                                    <span class="text-green-600">Xuất bản</span>
                                @else
                                    <span class="text-gray-400">Không xuất bản</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 p-2 flex justify-around items-center">
                                <!-- Nút thay đổi trạng thái -->
                                <a href="{{ route('topic.status', ['topic' => $item->id]) }}" title="Thay đổi trạng thái">
                                    @if ($item->status == 1)
                                        <i class="fa-solid fa-toggle-on text-green-500 text-2xl"></i>
                                    @else
                                        <i class="fa-solid fa-toggle-off text-red-500 text-2xl"></i>
                                    @endif
                                </a>
                                <!-- Nút sửa -->
                                <a href="{{ route('topic.edit', ['topic' => $item->id]) }}" title="Sửa">
                                    <i class="fa fa-edit text-blue-500 text-2xl"></i>
                                </a>
                                <!-- Nút xóa -->
                                <a href="{{ route('topic.delete', ['topic' => $item->id]) }}" title="Xóa">
                                    <i class="fa fa-trash text-red-500 text-2xl"></i>
                                </a>
                                <!-- Nút xem chi tiết -->
                                <a href="{{ route('topic.show', ['topic' => $item->id]) }}" title="Xem chi tiết">
                                    <i class="fa fa-eye text-2xl text-indigo-500"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Phân trang -->
            <div class="mt-4">
                {{ $list->links() }}
            </div>
        </div>
    </div>
</x-layout-admin>
