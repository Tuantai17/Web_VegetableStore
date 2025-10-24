<x-layout-admin>
    <div class="max-w-xl mx-auto bg-white shadow-md rounded px-6 py-8">
        <h2 class="text-xl font-bold text-red-600 mb-4">Xác nhận xóa liên hệ</h2>

        <p>Bạn có chắc chắn muốn xóa liên hệ này không?</p>

        <ul class="my-4 space-y-2 text-gray-700">
            <li><strong>ID:</strong> {{ $contact->id }}</li>
            <li><strong>Họ tên:</strong> {{ $contact->name }}</li>
            <li><strong>Email:</strong> {{ $contact->email }}</li>
            <li><strong>Nội dung:</strong> {{ $contact->message }}</li>
        </ul>

        <form action="{{ route('contact.destroy', $contact->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-between mt-6">
                <a href="{{ route('contact.trash') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Hủy</a>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Xóa vĩnh viễn</button>
            </div>
        </form>
    </div>
</x-layout-admin>
