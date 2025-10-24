<x-layout-site>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-green-700">Tất cả bài viết</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($posts as $post)
        <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition flex flex-col">
            <a href="{{ route('site.post.detail' , ['slug' => $post->slug]) }}">
                <img src="{{ asset('asset/image/post/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover rounded mb-4">
                <h2 class="text-xl font-semibold text-green-800 mb-2">{{ $post->title }}</h2>
                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($post->description, 100) }}</p>
            </a>
            <a href="{{ route('site.post.detail' , ['slug' => $post->slug]) }}"
   class="mt-auto inline-block text-sm text-white bg-green-700 hover:bg-green-600 px-4 py-2 rounded-xl transition">
    Xem chi tiết
</a>
        </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</div>
</x-layout-site>
