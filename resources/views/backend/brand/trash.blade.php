<x-layout-admin>
    <div class="content-wrapper">
        <!-- Header -->
        <div class="border border-blue-100 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">THÙNG RÁC THƯƠNG HIỆU</h2>
                <div class="text-right">
                    <a href="{{ route('brand.index') }}" class="bg-sky-500 px-2 py-2 rounded-xl mx-1 text-white">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Về danh sách
                    </a>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="border border-blue-100 rounded-lg p-2 mt-3">
            <table class="border-collapse border border-gray-400 w-full">
                <thead>
                    <tr>
                        <th class="border border-gray-300 p-2 w-32">Hình ảnh</th>
                        <th class="border border-gray-300 p-2">Tên thương hiệu</th>
                        <th class="border border-gray-300 p-2">Mô tả</th>
                        <th class="border border-gray-300 p-2 text-center">Khôi phục / Xóa</th>
                        <th class="border border-gray-300 p-2 text-center">ID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr>
                            <td class="border border-gray-300 p-2">
                                @if ($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-20 object-cover rounded" alt="{{ $item->name }}">
                                @else
                                    <span class="text-gray-400 italic">Không có ảnh</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 p-2">{{ $item->name }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->description }}</td>
                            <td class="border border-gray-300 p-2 text-center">
                                <a href="{{ route('brand.restore', ['brand' => $item->id]) }}" class="fa-solid fa-rotate-left text-blue-500 text-2xl"></a>

                                <form action="{{ route('brand.destroy', ['brand' => $item->id]) }}" method="post" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Bạn có chắc muốn xóa vĩnh viễn thương hiệu này?')">
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
