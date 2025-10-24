<x-layout-admin>

<x-slot:title>Quản Lí Banner</x-slot:title>

    <div class="content-wrapper">
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-pink-600">Danh Sách Banner</h2>
                <div>  
                    <a href="{{ route('banner.create') }}" class="bg-green-500 px-3 py-2 rounded text-white">
                        <i class="fa fa-plus"></i> Thêm mới
                    </a>
                    <a href="{{ route('banner.trash') }}" class="bg-red-500 px-3 py-2 rounded text-white">
                        <i class="fa fa-trash"></i> Thùng rác
                    </a>
                </div>
            </div>
        </div>

        <div class="border border-blue-100 rounded-lg p-2">
            <table class="border-collapse border border-gray-400 w-full">
                <thead>
                    <tr>
                        <th class="border border-gray-300 p-2">ID</th>
                        <th class="border border-gray-300 p-2">Tên Banner</th>
                        <th class="border border-gray-300 p-2">Hình ảnh</th>
                        <th class="border border-gray-300 p-2">Thứ tự</th>
                        <th class="border border-gray-300 p-2">Vị trí</th>
                        <th class="border border-gray-300 p-2">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr>
                            <td class="border border-gray-300 p-2">{{ $item->id }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->name }}</td>
                            <td class="border border-gray-300 p-2">
                            <img src="{{ asset('assets/images/banner/' . $item->image) }}" class="w-20 h-20 object-cover mx-auto" alt="{{ $item->name }}">
                            </td>
                            <td class="border border-gray-300 p-2">{{ $item->sort_order }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->position }}</td>
                            <td class="border border-gray-300 p-2 flex justify-around items-center">
                                <a href="{{ route('banner.status', ['banner' => $item->id]) }}">
                                    @if ($item->status == 1)
                                        <i class="fa-solid fa-toggle-on text-green-500 text-2xl"></i>
                                    @else
                                        <i class="fa-solid fa-toggle-off text-red-500 text-2xl"></i>
                                    @endif
                                </a>
                            
                                <a href="{{ route('banner.edit', ['banner' => $item->id]) }}">
                                    <i class="fa fa-edit text-blue-500 text-2xl" aria-hidden="true"></i></a>
                                    <a href="{{ route('banner.show', ['banner' => $item->id]) }}" title="Xem chi tiết">
                                        <i class="fas fa-eye text-gray-600 text-xl"></i>
                                    </a>
                            <a href="{{ route('banner.delete', ['banner' => $item->id]) }}">
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
