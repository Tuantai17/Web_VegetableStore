<x-layout-admin>
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold text-blue-600 mb-4">Quản lý Người dùng</h2>

        {{-- Nút thêm & thùng rác --}}
        <div class="text-right mb-4 space-x-2">
            <a href="{{ route('user.create') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl">
                <i class="fa fa-plus mr-1"></i> Thêm
            </a>
            <a href="{{ route('user.trash') }}" class="inline-block bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl">
                <i class="fa fa-trash mr-1"></i> Thùng rác
            </a>
        </div>

        {{-- Bảng danh sách --}}
        <table class="table-auto w-full border-collapse border border-gray-400">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-3 py-2 w-10">ID</th>
                    <th class="border border-gray-300 px-3 py-2">Họ và tên</th>
                    <th class="border border-gray-300 px-3 py-2">Email</th>
                    <th class="border border-gray-300 px-3 py-2">Vai trò</th>
                    <th class="border border-gray-300 px-3 py-2 text-center w-40">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $item)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-3 py-2 text-center">{{ $item->id }}</td>
                    <td class="border border-gray-300 px-3 py-2">{{ $item->name }}</td>
                    <td class="border border-gray-300 px-3 py-2">{{ $item->email }}</td>
                    <td class="border border-gray-300 px-3 py-2">
                        @if ($item->roles == 'admin')
                            Admin
                        @else
                            Người dùng
                        @endif
                    </td>
                    <td class="border border-gray-300 px-3 py-2">
    <div class="flex items-center justify-center space-x-3">
        <a href="{{ route('user.status', ['user' => $item->id]) }}">
            @if ($item->status == 1)
                <i class="fa fa-toggle-on text-2xl text-green-500" aria-hidden="true"></i>
            @else
                <i class="fa fa-toggle-off text-2xl text-red-500" aria-hidden="true"></i>
            @endif
        </a>
        <a href="{{ route('user.edit', ['user' => $item->id]) }}">
            <i class="fa fa-edit text-2xl text-blue-500" aria-hidden="true"></i>
        </a>
        <a href="{{ route('user.delete', ['user' => $item->id]) }}">
            <i class="fa fa-trash text-2xl text-red-500" aria-hidden="true"></i>
        </a>
        <a href="{{ route('user.show', ['user' => $item->id]) }}">
            <i class="fa fa-eye text-2xl text-gray-600"></i>
        </a>
    </div>
</td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Phân trang --}}
        <div class="mt-4">
            {{ $list->links() }}
        </div>
    </div>
</x-layout-admin>
