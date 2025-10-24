<x-layout-admin>

    <x-slot:title>
        Trang Quản Lý Danh Mục
    </x-slot:title>

    <div class="content-wrapper p-4">
        <!-- Thanh tiêu đề -->
        <div class="mb-6 rounded-lg p-4 bg-green-100 shadow-md">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-green-700">Quản Lí Danh Mục</h2>
                <div class="space-x-2">
                    <a href="{{ route('category.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500 transition">
                        <i class="fa fa-plus mr-2"></i> Thêm
                    </a>
                    <a href="{{ route('category.trash') }}" 
                       class="inline-flex items-center px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-500 transition">
                        <i class="fa fa-trash mr-2"></i> Thùng rác
                    </a>
                </div>
            </div>
        </div>

        <!-- Bảng danh mục -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full border border-green-300 rounded-lg">
                <thead class="bg-green-200">
                    <tr>
                        <th class="p-3 text-left text-sm font-semibold text-green-900 border-b">ID</th>
                        <th class="p-3 text-left text-sm font-semibold text-green-900 border-b">Hình</th>
                        <th class="p-3 text-left text-sm font-semibold text-green-900 border-b">Tên danh mục</th>
                        <th class="p-3 text-left text-sm font-semibold text-green-900 border-b">Slug</th>
                        <th class="p-3 text-center text-sm font-semibold text-green-900 border-b">Trạng thái</th>
                        <th class="p-3 text-center text-sm font-semibold text-green-900 border-b">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr class="hover:bg-green-50">
                            <td class="p-3 text-green-700">{{ $item->id }}</td>
                            <td class="p-3">
                                <img src="{{ asset('assets/images/category/' . $item->image) }}" 
                                     class="w-16 h-16 object-cover rounded-md mx-auto shadow-md"
                                     alt="{{ $item->name }}">
                            </td>
                            <td class="p-3 text-green-700">{{ $item->name }}</td>
                            <td class="p-3 text-green-700">{{ $item->slug }}</td>
                            <td class="p-3 text-center">
                                <a href="{{ route('category.status', ['category' => $item->id]) }}">
                                    @if ($item->status == 1)
                                        <i class="fa-solid fa-toggle-on text-green-600 text-2xl"></i>
                                    @else
                                        <i class="fa-solid fa-toggle-off text-red-600 text-2xl"></i>
                                    @endif
                                </a>
                            </td>
                            <td class="p-3 text-center">
                                <div class="flex justify-center space-x-4">
                                    <a href="{{ route('category.edit', ['category' => $item->id]) }}" title="Sửa" 
                                       class="text-green-500 hover:text-green-600 transition">
                                        <i class="fa fa-edit text-xl"></i>
                                    </a>
                                    <a href="{{ route('category.delete', ['category' => $item->id]) }}" title="Xóa" 
                                       class="text-red-500 hover:text-red-600 transition">
                                        <i class="fa fa-trash text-xl"></i>
                                    </a>
                                    <a href="{{ route('category.show', ['category' => $item->id]) }}" title="Xem chi tiết" 
                                       class="text-gray-600 hover:text-gray-700 transition">
                                        <i class="fa fa-eye text-xl"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Phân trang -->
            <div class="p-4">
                {{ $list->links() }}
            </div>
        </div>
    </div>

</x-layout-admin>
