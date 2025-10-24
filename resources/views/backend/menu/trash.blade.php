<x-layout-admin>
    <div class="content-wrapper">
        <div class="border border-blue-100 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">THÙNG RÁC MENU</h2>
                <div class="text-right">
                    <a href="{{ route('menu.index') }}" class="bg-sky-500 px-2 py-2 rounded-xl mx-1 text-white">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Về danh sách
                    </a>
                </div>
            </div>
        </div>

        <div class="border border-blue-100 rounded-lg p-2 mt-3">
            <table class="border-collapse border border-gray-400 w-full">
                <thead>
                    <tr>
                        <th class="border border-gray-300 p-2">Tên menu</th>
                        <th class="border border-gray-300 p-2">Liên kết</th>
                        <th class="border border-gray-300 p-2">Vị trí</th>
                        <th class="border border-gray-300 p-2">Khôi phục / Xóa</th>
                        <th class="border border-gray-300 p-2">ID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr>
                            <td class="border border-gray-300 p-2">{{ $item->name }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->link }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->position }}</td>
                            <td class="border border-gray-300 p-2 text-center">
                                <a href="{{ route('menu.restore', ['menu' => $item->id]) }}" class="fa-solid fa-rotate-left text-blue-500 text-2xl"></a>

                                <form action="{{ route('menu.destroy', ['menu' => $item->id]) }}" method="post" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa vĩnh viễn?')">
                                        <i class="fa fa-trash text-red-500 text-2xl" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="border border-gray-300 p-2 text-center">{{ $item->id }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout-admin>
