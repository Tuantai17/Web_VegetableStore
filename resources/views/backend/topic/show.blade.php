<x-layout-admin>
    <div class="content-wrapper">
        <!-- Header -->
        <div class="border border-blue-100 rounded-lg p-2 flex items-center justify-between">
            <h2 class="text-xl font-bold text-blue-600">Chi tiết chủ đề</h2>
            <a href="{{ route('topic.index') }}" class="bg-sky-500 text-white px-4 py-2 rounded hover:bg-sky-600">
                🔙 Quay về danh sách
            </a>
        </div>

        <!-- Nội dung chi tiết của chủ đề -->
        <div class="border border-blue-100 rounded-lg p-2 mt-3">
            <h3 class="text-lg font-semibold">Tiêu đề: {{ $topic->name }}</h3>
            <p class="mt-2">Nội dung mô tả: {{ $topic->description }}</p>
        </div>
    </div>
</x-layout-admin>
