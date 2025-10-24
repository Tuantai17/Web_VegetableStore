<x-layout-admin>
    <div class="content-wrapper">
        <div class="border border-blue-100 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">THÙNG RÁC</h2>
                <div class="text-right">
                    <a href="{{ route('product.index') }}" class="bg-sky-500 px-2 py-2 rounded-xl mx-1 text-white">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Về danh sách
                    </a>
                </div>
            </div>
        </div>

        <div class="border border-blue-100 rounded-lg p-2 mt-3">
            <table class="border-collapse border border-gray-400 w-full">
                <thead>
                    <tr>
                        <th class="border border-gray-300 p-2 w-32 ">Hình ảnh</th>
                        <th class="border border-gray-300 p-2">Tên</th>
                        <th class="border border-gray-300 p-2">Danh mục</th>
                        <th class="border border-gray-300 p-2">Thương hiệu</th>
                        <th class="border border-gray-300 p-2">Khôi phục / Xóa</th>
                        <th class="border border-gray-300 p-2">ID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr>
                            <td class="border border-gray-300 p-2">
                                <img src="{{ asset('assets/images/product/' . $item->thumbnail) }}" class="w-full" alt="{{ $item->thumbnail }}">
                            </td>
                            <td class="border border-gray-300 p-2">{{ $item->name }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->categoryname }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->brandname }}</td>
                            <td class="border border-gray-300 p-2 text-center">
                                <a href="{{ route('product.restore', ['product' => $item->id]) }}" class="fa-solid fa-rotate-left text-blue-500 text-2xl"></a>

                                <form action="{{ route('product.destroy', ['product' => $item->id]) }}" method="post" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button>
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
