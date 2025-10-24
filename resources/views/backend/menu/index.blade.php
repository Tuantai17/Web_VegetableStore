<x-layout-admin>

    <x-slot:title>Quản Lí Menu</x-slot:title>

    <div class="content-wrapper">
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="text-right">
                <a href="{{ route('menu.create') }}" class="bg-green-500 px-2 py-2 rounded-xl mx-1 text-white">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Thêm
                </a>
                <a href="{{ route('menu.trash') }}" class="bg-red-500 px-2 py-2 rounded-xl mx-1 text-white">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    Thùng rác
                </a>
            </div>
        </div>

        <div class="border border-blue-100 rounded-lg p-2">
            <table class="border-collapse border border-gray-400 w-full">
                <thead>
                    <tr>
                        <th class="border border-gray-300 p-2">ID</th>
                        <th class="border border-gray-300 p-2">Tên Menu</th>
                        <th class="border border-gray-300 p-2">Link</th>
                        <th class="border border-gray-300 p-2">Parent ID</th>
                        <th class="border border-gray-300 p-2">Thứ tự</th>
                        <th class="border border-gray-300 p-2">Loại</th>
                        <th class="border border-gray-300 p-2">Vị trí</th>
                        <th class="border border-gray-300 p-2">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                    <tr>
                        <td class="border border-gray-300 p-2">{{ $item->id }}</td>
                        <td class="border border-gray-300 p-2">{{ $item->name }}</td>
                        <td class="border border-gray-300 p-2">{{ $item->link }}</td>
                        <td class="border border-gray-300 p-2">{{ $item->parent_id }}</td>
                        <td class="border border-gray-300 p-2">{{ $item->sort_order }}</td>
                        <td class="border border-gray-300 p-2">{{ $item->type }}</td>
                        <td class="border border-gray-300 p-2">{{ $item->position }}</td>
                        <td class="border border-gray-300 p-2 flex justify-around items-center">
                            <a href="{{ route('menu.status', ['menu' => $item->id]) }}">
                                @if ($item->status == 1)
                                <i class="fa-solid fa-toggle-on text-green-500 text-2xl"></i>
                                @else
                                <i class="fa-solid fa-toggle-off text-red-500 text-2xl"></i>
                                @endif
                            </a>

                            <a href="{{ route('menu.edit', ['menu' => $item->id]) }}"><i class="fa fa-edit text-blue-500 text-2xl" aria-hidden="true"></i>
                            </a>
                            <a href="{{ route('menu.show', ['menu' => $item->id]) }}" title="Xem chi tiết">
                                <i class="fa fa-eye text-gray-600 text-xl"></i>
                            </a>
                            <a href="{{ route('menu.delete', ['menu' => $item->id]) }}">
                                <i class="fa fa-trash text-red-500 text-2xl" aria-hidden="true"></i>
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