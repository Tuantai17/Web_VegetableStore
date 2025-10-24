<x-layout-admin>
    <div class="content-wrapper">
        <div class="border border-pink-200 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-pink-600">Danh Sách Đơn Hàng</h2>
                
            </div>
        </div>

        <div class="border border-pink-200 rounded-lg p-2">
            <table class="border-collapse border border-gray-300 w-full">
                <thead>
                    <tr class="bg-pink-100">
                        <th class="border border-gray-300 p-2">ID</th>
                        <th class="border border-gray-300 p-2">Tên</th>
                        <th class="border border-gray-300 p-2">SĐT</th>
                        <th class="border border-gray-300 p-2">Email</th>
                        <th class="border border-gray-300 p-2">Địa chỉ</th>
                        <th class="border border-gray-300 p-2">Ghi chú</th>
                        <th class="border border-gray-300 p-2">Trạng thái</th>
                        <th class="border border-gray-300 p-2">Thời gian</th>
                        <th class="border border-gray-300 p-2 text-center">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr>
                            <td class="border border-gray-300 p-2">{{ $item->id }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->name }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->phone }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->email }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->address }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->note }}</td>
                            <td class="border border-gray-300 p-2">
                                @if ($item->status == 1)
                                    <span class="text-green-600 font-semibold">Đã xử lý</span>
                                @else
                                    <span class="text-red-500 font-semibold">Chưa xử lý</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 p-2">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            <td class="border border-gray-300 p-2 text-center space-x-2">
                                {{-- Nút trạng thái --}}
                                <a href="{{ route('order.status', ['order' => $item->id]) }}">
                                    @if ($item->status == 1)
                                        <i class="fa fa-toggle-on text-2xl text-green-500"></i>
                                    @else
                                        <i class="fa fa-toggle-off text-2xl text-red-500"></i>
                                    @endif
                                </a>
                                

                                {{-- Nút xem chi tiết --}}
                                <a href="{{ route('order.show', ['order' => $item->id]) }}">
                                    <i class="fa fa-eye text-2xl text-indigo-500"></i>
                                </a>

                                <!-- {{-- Nút sửa --}}
                                <a href="{{ route('order.edit', ['order' => $item->id]) }}">
                                    <i class="fa fa-edit text-2xl text-blue-500"></i>
                                </a> -->

                                {{-- Nút xóa --}}
                                <a href="{{ route('order.delete', ['order' => $item->id]) }}">
                                    <i class="fa fa-trash text-2xl text-red-500"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $list->links() }}
            </div>
        </div>
    </div>
</x-layout-admin>
