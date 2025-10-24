<x-layout-admin>
    <x-slot:title>
        Quản Lý Thương Hiệu
    </x-slot:title>

    <div class="content-wrapper">
        <div class="border border-blue-200 mb-4 rounded-lg p-4 bg-white shadow-sm">
            <h2 class="text-2xl font-semibold text-blue-600">Quản Lí Thương Hiệu</h2>
            <div class="text-right mt-3">
                <a href="{{ route('brand.create') }}" class="bg-green-500 px-4 py-2 rounded-xl mx-2 text-white hover:bg-green-600 transition duration-300 ease-in-out">
                    <i class="fa fa-plus"></i> Thêm
                </a>
                <a href="{{ route('brand.trash') }}" class="bg-red-500 px-4 py-2 rounded-xl mx-2 text-white hover:bg-red-600 transition duration-300 ease-in-out">
                    <i class="fa fa-trash"></i> Thùng rác
                </a>
            </div>
        </div>

        <!-- Bảng danh sách thương hiệu -->
        <div class="border border-blue-200 rounded-lg p-4 bg-white shadow-sm">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr>
                        <th class="border border-gray-300 p-3 text-center text-sm font-medium text-gray-600">ID</th>
                        <th class="border border-gray-300 p-3 text-center text-sm font-medium text-gray-600">Hình</th>
                        <th class="border border-gray-300 p-3 text-center text-sm font-medium text-gray-600">Tên thương hiệu</th>
                        <th class="border border-gray-300 p-3 text-center text-sm font-medium text-gray-600">Trạng thái</th>
                        <th class="border border-gray-300 p-3 text-center text-sm font-medium text-gray-600">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="border border-gray-300 p-3 text-center text-sm">{{ $item->id }}</td>
                            <td class="border border-gray-300 p-3 text-center">
                                <img src="{{ asset('assets/images/brand/' . $item->image) }}" class="w-16 h-16 object-cover mx-auto rounded-lg" alt="{{ $item->name }}">
                            </td>
                            <td class="border border-gray-300 p-3 text-center text-sm">{{ $item->name }}</td>
                            <td class="border border-gray-300 p-3 text-center">
                                <a href="{{ route('brand.status', ['brand' => $item->id]) }}">
                                    @if ($item->status == 1)
                                        <i class="fa-solid fa-toggle-on text-green-500 text-xl"></i>
                                    @else
                                        <i class="fa-solid fa-toggle-off text-red-500 text-xl"></i>
                                    @endif
                                </a>
                            </td>
                            <td class="border border-gray-300 p-3 text-center">
                                <div class="flex justify-center space-x-3">
                                    <a href="{{ route('brand.show', ['brand' => $item->id]) }}" title="Xem chi tiết">
                                        <i class="fas fa-eye text-gray-600 text-lg hover:text-blue-500 transition duration-300"></i>
                                    </a>
                                    <a href="{{ route('brand.edit', ['brand' => $item->id]) }}" title="Chỉnh sửa">
                                        <i class="fa fa-edit text-blue-500 text-lg hover:text-blue-700 transition duration-300"></i>
                                    </a>
                                    <a href="{{ route('brand.delete', ['brand' => $item->id]) }}" 
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa?')" title="Xóa tạm thời">
                                        <i class="fa fa-trash text-red-500 text-lg hover:text-red-700 transition duration-300"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6">
                {{ $list->links() }}
            </div>
        </div>
    </div>
</x-layout-admin>
