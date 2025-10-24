<x-layout-admin>
    <div class="content-wrapper p-8 bg-gray-50">
        <h2 class="text-3xl font-bold text-blue-700 mb-8">Trả lời liên hệ</h2>

        <form action="{{ route('contact.reply', $contact->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Tên người liên hệ -->
            <div>
                <label class="block text-lg font-semibold text-gray-700 mb-2">Tên người liên hệ:</label>
                <input 
                    type="text" 
                    value="{{ $contact->name }}" 
                    disabled 
                    class="w-full border border-gray-300 rounded-lg p-3 bg-gray-100 text-gray-600 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <!-- Email -->
            <div>
                <label class="block text-lg font-semibold text-gray-700 mb-2">Email:</label>
                <input 
                    type="text" 
                    value="{{ $contact->email }}" 
                    disabled 
                    class="w-full border border-gray-300 rounded-lg p-3 bg-gray-100 text-gray-600 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <!-- Nội dung liên hệ -->
            <div>
                <label class="block text-lg font-semibold text-gray-700 mb-2">Nội dung liên hệ:</label>
                <textarea 
                    disabled 
                    class="w-full border border-gray-300 rounded-lg p-3 bg-gray-100 text-gray-600 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    rows="6"
                >{{ $contact->content }}</textarea>
            </div>

            <!-- Nội dung trả lời -->
            <div>
                <label class="block text-lg font-semibold text-gray-700 mb-2">Nội dung trả lời:</label>
                <textarea 
                    name="reply_content" 
                    class="w-full border border-gray-300 rounded-lg p-3 bg-white text-gray-800 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                    rows="6"
                >{{ old('reply_content', $contact->reply_content) }}</textarea>
            </div>

            <!-- Nút gửi trả lời -->
            <div class="text-right">
                <button 
                    type="submit" 
                    class="bg-gradient-to-r from-green-500 to-teal-500 hover:from-green-600 hover:to-teal-600 text-white font-bold py-3 px-8 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105"
                >
                    Gửi trả lời
                </button>
            </div>
        </form>
    </div>
</x-layout-admin>
