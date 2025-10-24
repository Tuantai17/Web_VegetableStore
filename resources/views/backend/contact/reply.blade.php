<form method="POST" action="{{ route('contact.reply', $item->id) }}">
    @csrf
    <div class="mb-6">
        <label for="reply_content_{{ $item->id }}" class="block text-sm font-semibold text-teal-600 mb-2">Nội dung trả lời:</label>
        <textarea 
            id="reply_content_{{ $item->id }}"
            name="reply_content" 
            rows="6" 
            class="w-full border border-teal-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300 ease-in-out shadow-lg"
            placeholder="Nhập nội dung trả lời ở đây..."
            required>{{ old('reply_content', $item->reply_content) }}</textarea>
    </div>
    <div class="flex justify-end space-x-4">
        <button type="submit" class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold px-6 py-3 rounded-xl shadow-xl hover:shadow-2xl transition duration-300 ease-in-out transform hover:scale-110">
            Gửi
        </button>
        <button type="button" onclick="closeModal('modal-{{ $item->id }}')" class="bg-gray-300 hover:bg-gray-500 text-gray-800 px-6 py-3 rounded-xl shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-110">
            Đóng
        </button>
    </div>
</form>
