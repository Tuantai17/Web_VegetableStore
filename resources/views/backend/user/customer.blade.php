<x-layout-admin>
<div class="container">
    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-orange-500">Danh sách Khách hàng</h2>
       
    </div>
    <div class="text-right mb-4 space-x-2">
            <a href="{{ route('user.create') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl">
                <i class="fa fa-plus mr-1"></i> Thêm
            </a>
            <a href="{{ route('user.trash') }}" class="inline-block bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl">
                <i class="fa fa-trash mr-1"></i> Thùng rác
            </a>
        </div>
    <!-- Table -->
    <table class="border-collapse border border-gray-400 w-full">
        <thead>
            <tr>
                <th class="border border-gray-300 p-2">ID</th>
                <th class="border border-gray-300 p-2">Họ và tên</th>
                <th class="border border-gray-300 p-2">Email</th>
                <th class="border border-gray-300 p-2">Vai trò</th>
                <th class="border border-gray-300 p-2 text-center w-40">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $item)
            <tr>
                <td class="border border-gray-300 p-2 text-center">{{ $item->id }}</td>
                <td class="border border-gray-300 p-2">{{ $item->name }}</td>
                <td class="border border-gray-300 p-2">{{ $item->email }}</td>
                <td class="border border-gray-300 p-2">{{ $item->roles }}</td>
                <td class="border border-gray-300 p-2 text-center space-x-2">
                    <a href="{{ route('user.status', ['user' => $item->id]) }}">
                        @if ($item->status == 1)
                            <i class="fa fa-toggle-on text-2xl text-green-500" aria-hidden="true" title="Đang hoạt động"></i>
                        @else
                            <i class="fa fa-toggle-off text-2xl text-red-500" aria-hidden="true" title="Đã khóa"></i>
                        @endif
                    </a>
                    <a href="{{ route('user.edit', ['user' => $item->id]) }}">
                        <i class="fa fa-edit text-2xl text-blue-500" aria-hidden="true" title="Chỉnh sửa"></i>
                    </a>
                    <a href="{{ route('user.delete', ['user' => $item->id]) }}">
                        <i class="fa fa-trash text-2xl text-red-500" aria-hidden="true" title="Xoá tạm"></i>
                    </a>
                    <a href="{{ route('user.show', ['user' => $item->id]) }}">
                                <i class="fa fa-eye text-2xl text-gray-600"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $list->links() }}
    </div>
</div>
</x-layout-admin>
