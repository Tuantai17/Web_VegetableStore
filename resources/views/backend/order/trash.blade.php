<x-layout-admin>
    <div class="content-wrapper">
        <div class="border border-red-300 mb-3 rounded-lg p-2">
            <h2 class="text-xl font-bold text-red-600">Đơn hàng trong thùng rác</h2>
        </div>

        <div class="border border-red-300 rounded-lg p-2">
            <table class="w-full border border-gray-300">
                <thead>
                    <tr class="bg-red-100">
                        <th class="border p-2">ID</th>
                        <th class="border p-2">Tên</th>
                        <th class="border p-2">SĐT</th>
                        <th class="border p-2">Email</th>
                        <th class="border p-2">Trạng thái</th> {{-- thêm cột trạng thái --}}
                        <th class="border p-2">Thời gian xóa</th>
                        <th class="border p-2 text-center">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr>
                            <td class="border p-2">{{ $item->id }}</td>
                            <td class="border p-2">{{ $item->name }}</td>
                            <td class="border p-2">{{ $item->phone }}</td>
                            <td class="border p-2">{{ $item->email }}</td>

                            {{-- Trạng thái --}}
                            <td class="border p-2 text-center">
                                @if ($item->status == 1)
                                    <a href="{{ route('order.toggleStatus', ['id' => $item->id]) }}">
                                        <i class="fa fa-toggle-on text-green-500 text-2xl"></i>
                                    </a>
                                @else
                                    <a href="{{ route('order.toggleStatus', ['id' => $item->id]) }}">
                                        <i class="fa fa-toggle-off text-gray-500 text-2xl"></i>
                                    </a>
                                @endif
                            </td>

                            <td class="border p-2">{{ $item->deleted_at->format('d/m/Y H:i') }}</td>
                            <td class="border p-2 text-center space-x-2">
                                {{-- Khôi phục --}}
                                <a href="{{ route('order.restore', ['id' => $item->id]) }}">
                                    <i class="fa fa-undo text-blue-500 text-2xl"></i>
                                </a>
                                {{-- Xóa vĩnh viễn --}}
                                <a href="{{ route('order.forceDelete', ['id' => $item->id]) }}">
                                    <i class="fa fa-trash text-red-500 text-2xl"></i>
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
