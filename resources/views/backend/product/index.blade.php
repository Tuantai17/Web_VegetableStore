<x-layout-admin>
    <div class="container mx-auto px-6 py-8">
        <h2 class="text-3xl font-extrabold text-green-700 mb-6">🍎 Quản lý Sản phẩm </h2>

        {{-- Nút thêm và thùng rác --}}
        <div class="flex justify-end space-x-3 mb-6">
            <a href="{{ route('product.create') }}" class="inline-flex items-center bg-emerald-500 hover:bg-emerald-600 text-white font-medium px-4 py-2 rounded-lg shadow-md transition">
                <i class="fa fa-plus mr-2"></i> Thêm mới
            </a>
            <a href="{{ route('product.trash') }}" class="inline-flex items-center bg-orange-400 hover:bg-orange-500 text-white font-medium px-4 py-2 rounded-lg shadow-md transition">
                <i class="fa fa-trash mr-2"></i> Thùng rác
            </a>
        </div>

        {{-- Bảng sản phẩm --}}
        <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow">
            <table class="min-w-full table-auto text-sm text-gray-800">
                <thead class="bg-green-100 text-green-900 font-semibold">
                    <tr>
                        <th class="p-3 text-center border-b border-gray-200 w-12">ID</th>
                        <th class="p-3 border-b border-gray-200 w-20">Hình</th>
                        <th class="p-3 border-b border-gray-200">Tên sản phẩm</th>
                        <th class="p-3 border-b border-gray-200">Danh mục</th>
                        <th class="p-3 border-b border-gray-200">Thương hiệu</th>
                        <th class="p-3 border-b border-gray-200 text-center w-64">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($list as $item)
                        <tr class="hover:bg-lime-50 transition">
                            <td class="p-3 text-center">{{ $item->id }}</td>
                            <td class="p-3">
                                <img src="{{ asset('assets/images/product/'.$item->thumbnail) }}"
                                     class="w-14 h-14 object-cover rounded-lg border" alt="{{ $item->thumbnail }}">
                            </td>
                            <td class="p-3 font-medium">{{ $item->name }}</td>
                            <td class="p-3">{{ $item->categoryname }}</td>
                            <td class="p-3">{{ $item->brandname }}</td>
                            <td class="p-3 text-center space-x-2">
                                {{-- Trạng thái --}}
                                <a href="{{ route('product.status', ['product' => $item->id]) }}" title="Trạng thái">
                                    @if ($item->status == 1)
                                        <i class="fa fa-toggle-on text-2xl text-emerald-500"></i>
                                    @else
                                        <i class="fa fa-toggle-off text-2xl text-gray-400"></i>
                                    @endif
                                </a>
                                {{-- Sửa --}}
                                <a href="{{ route('product.edit', ['product' => $item->id]) }}" title="Chỉnh sửa">
                                    <i class="fa fa-edit text-2xl text-blue-400 hover:text-blue-600"></i>
                                </a>
                                {{-- Xoá --}}
                                <a href="{{ route('product.delete', ['product' => $item->id]) }}" title="Xoá">
                                    <i class="fa fa-trash text-2xl text-red-400 hover:text-red-600"></i>
                                </a>
                                {{-- Xem --}}
                                <a href="{{ route('product.show', ['product' => $item->id]) }}" title="Xem chi tiết">
                                    <i class="fa fa-eye text-2xl text-gray-600 hover:text-gray-800"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Phân trang --}}
        <div class="mt-6">
            {{ $list->links() }}
        </div>
    </div>
</x-layout-admin>
