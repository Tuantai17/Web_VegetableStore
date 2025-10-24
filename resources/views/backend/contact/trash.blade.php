<x-layout-admin>
    <div class="content-wrapper">
        <!-- Header -->
        <div class="border border-blue-100 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">THÙNG RÁC LIÊN HỆ</h2>
                <div class="text-right">
                    <a href="{{ route('contact.index') }}" class="bg-sky-500 px-2 py-2 rounded-xl mx-1 text-white">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Về danh sách
                    </a>
                </div>
            </div>
        </div>

        <!-- Bảng danh sách liên hệ đã xóa -->
        <div class="border border-blue-100 rounded-lg p-2 mt-3">
            <table class="border-collapse border border-gray-400 w-full">
                <thead>
                    <tr>
                        <th class="border border-gray-300 p-2 w-10">ID</th>
                        <th class="border border-gray-300 p-2">Họ tên</th>
                        <th class="border border-gray-300 p-2">Email</th>
                        <th class="border border-gray-300 p-2">Điện thoại</th>
                        <th class="border border-gray-300 p-2">Tiêu đề</th>
                        <th class="border border-gray-300 p-2 text-center">Khôi phục / Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr>
                            <td class="border border-gray-300 p-2 text-center">{{ $item->id }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->name }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->email }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->phone }}</td>
                            <td class="border border-gray-300 p-2">{{ $item->subject }}</td>
                            <td class="border border-gray-300 p-2 text-center">
                                <!-- Nút khôi phục -->
                                <a href="{{ route('contact.restore', $item->id) }}" class="text-blue-500 mr-2"
                                    title="Khôi phục">
                                    <i class="fa fa-undo text-2xl" aria-hidden="true"></i>
                                </a>

                                <!-- Nút xóa vĩnh viễn -->
                                <form action="{{ route('contact.destroy', $item->id) }}" method="post" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Bạn có chắc muốn xóa vĩnh viễn?')"
                                        title="Xóa vĩnh viễn">
                                        <i class="fa fa-trash text-red-500 text-2xl"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout-admin>
