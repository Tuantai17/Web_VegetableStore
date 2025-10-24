<x-layout-admin>
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-bold text-blue-600 mb-8">Quản lý liên hệ</h2>

        {{-- Nút chức năng --}}
        <div class="flex justify-end mb-6 space-x-4">
            <!-- <a href="{{ route('contact.create') }}" class="bg-green-600 hover:bg-green-700 px-6 py-3 rounded-xl text-white transition duration-300 ease-in-out shadow-lg">
                <i class="fa fa-plus"></i> Thêm
            </a> -->
            <a href="{{ route('contact.trash') }}" class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-xl text-white transition duration-300 ease-in-out shadow-lg">
                <i class="fa fa-trash"></i> Thùng rác
            </a>
        </div>

        {{-- Bảng danh sách liên hệ --}}
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-blue-100">
                    <tr>
                        @foreach (['ID', 'Họ tên', 'Email', 'Điện thoại', 'Tiêu đề', 'Nội dung', 'Nội dung trả lời', 'Chức năng'] as $header)
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-300">
                    @foreach ($contacts as $item)
                    <tr>
                        <td class="px-6 py-4">{{ $item->id }}</td>
                        <td class="px-6 py-4">{{ $item->name }}</td>
                        <td class="px-6 py-4">{{ $item->email }}</td>
                        <td class="px-6 py-4">{{ $item->phone }}</td>
                        <td class="px-6 py-4">{{ $item->title }}</td>
                        <td class="px-6 py-4">{{ $item->content }}</td>
                        <td class="px-6 py-4">
                            @if ($item->reply_content)
                                <span class="text-green-600">{{ $item->reply_content }}</span>
                            @else
                                <span class="italic text-red-500">Chưa trả lời</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center space-x-3">
                            {{-- Trạng thái --}}
                            <a href="{{ route('contact.status', $item->id) }}" title="Đổi trạng thái">
                                @if ($item->status == 1)
                                    <i class="fa fa-toggle-on text-2xl text-red-500 hover:text-red-600 transition duration-300 ease-in-out"></i>
                                @else
                                    <i class="fa fa-toggle-off text-2xl text-blue-500 hover:text-blue-600 transition duration-300 ease-in-out"></i>
                                @endif
                            </a>

                            <!-- {{-- Sửa --}}
                            <a href="{{ route('contact.edit', $item->id) }}" title="Chỉnh sửa">
                                <i class="fa fa-pen-to-square text-2xl text-blue-500 hover:text-blue-600 transition duration-300 ease-in-out"></i>
                            </a> -->

                            {{-- Xem --}}
                            <a href="{{ route('contact.show', $item->id) }}" title="Xem chi tiết">
                                <i class="fas fa-eye text-xl text-gray-600 hover:text-gray-700 transition duration-300 ease-in-out"></i>
                            </a>

                            {{-- Xóa --}}
                            <a href="{{ route('contact.delete', $item->id) }}"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa?');">
                                <i class="fa fa-trash text-2xl text-red-600 hover:text-red-700 transition duration-300 ease-in-out"></i>
                            </a>

                            {{-- Trả lời --}}
                            <button 
                                onclick="openModal('modal-{{ $item->id }}')"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-sm transition duration-300 ease-in-out"
                                title="Trả lời"
                            >
                                <i class="fas fa-reply"></i> Trả lời
                            </button>
                        </td>
                    </tr>

                    {{-- Modal trả lời --}}
                    <div id="modal-{{ $item->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-bold text-blue-600">Trả lời liên hệ</h2>
                                <button class="text-gray-500 hover:text-gray-700" onclick="closeModal('modal-{{ $item->id }}')">
                                    ✕
                                </button>
                            </div>

                            {{-- Thông tin liên hệ --}}
                            <div class="mb-4 space-y-1 text-sm text-gray-700">
                                <p><strong>Tên:</strong> {{ $item->name }}</p>
                                <p><strong>Email:</strong> {{ $item->email }}</p>
                                <p><strong>Điện thoại:</strong> {{ $item->phone }}</p>
                                <p><strong>Tiêu đề:</strong> {{ $item->title }}</p>
                                <p><strong>Nội dung:</strong> {{ $item->content }}</p>
                            </div>

                          <form method="POST" action="{{ route('contact.reply', $item->id) }}">
    @csrf
    <div class="mb-6">
        <label class="block text-sm font-semibold text-blue-600 mb-2">Nội dung trả lời:</label>
        <textarea 
            name="reply_content" 
            rows="6" 
            class="w-full border border-gray-300 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 transition duration-300 ease-in-out shadow-md placeholder:text-gray-500" 
            placeholder="Nhập nội dung trả lời ở đây..."
            required>{{ old('reply_content', $item->reply_content) }}</textarea>
    </div>
    <div class="flex justify-end space-x-6">
        <button 
            type="submit" 
            class="bg-gradient-to-r from-green-500 to-teal-500 hover:from-green-600 hover:to-teal-600 text-white font-semibold px-6 py-3 rounded-lg shadow-xl hover:shadow-2xl transition duration-300 ease-in-out transform hover:scale-105">
            Gửi
        </button>
        <button 
            type="button" 
            onclick="closeModal('modal-{{ $item->id }}')" 
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg shadow-sm hover:shadow-md transition duration-300 ease-in-out transform hover:scale-105">
            Đóng
        </button>
    </div>
</form>

                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Phân trang --}}
        <div class="mt-8">
            {{ $contacts->links() }}
        </div>
    </div>

    {{-- Script mở/đóng modal --}}
    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }
        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>
</x-layout-admin>
