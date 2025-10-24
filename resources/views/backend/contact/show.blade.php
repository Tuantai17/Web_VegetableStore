<x-layout-admin>
    <div class="max-w-4xl mx-auto py-10 px-4">
        <h1 class="text-4xl font-bold mb-8 text-center text-indigo-600 flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h1l1 2h13l1-2h1m-3 0V6a3 3 0 00-6 0v4m-2 4h6m-6 4h6"/>
            </svg>
            Chi tiết liên hệ
        </h1>

        <div class="bg-gradient-to-r from-blue-100 to-purple-100 shadow-2xl rounded-2xl p-8 space-y-6">

            <div class="flex items-center gap-3">
                <span class="text-pink-500">
                    📛
                </span>
                <div>
                    <h2 class="text-lg font-bold text-pink-700">Tên người liên hệ:</h2>
                    <p class="text-gray-800">{{ $contact->name }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <span class="text-green-500">
                    📧
                </span>
                <div>
                    <h2 class="text-lg font-bold text-green-700">Email:</h2>
                    <p class="text-gray-800">{{ $contact->email }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <span class="text-blue-500">
                    📞
                </span>
                <div>
                    <h2 class="text-lg font-bold text-blue-700">Số điện thoại:</h2>
                    <p class="text-gray-800">{{ $contact->phone }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <span class="text-yellow-500">
                    📝
                </span>
                <div>
                    <h2 class="text-lg font-bold text-yellow-700">Tiêu đề liên hệ:</h2>
                    <p class="text-gray-800">{{ $contact->title }}</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <span class="text-purple-500 pt-1">
                    📨
                </span>
                <div>
                    <h2 class="text-lg font-bold text-purple-700">Nội dung liên hệ:</h2>
                    <div class="text-gray-800 leading-relaxed">
                        {!! $contact->content !!}
                    </div>
                </div>
            </div>

            <div class="text-sm text-gray-600 italic pt-4">
                🕒 Cập nhật lần cuối: {{ optional($contact->updated_at)->format('d/m/Y H:i') ?? 'Chưa cập nhật' }}
            </div>
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 text-indigo-500 hover:text-indigo-700 font-semibold">
                ← Quay về danh sách liên hệ
            </a>
        </div>
    </div>
</x-layout-admin>
