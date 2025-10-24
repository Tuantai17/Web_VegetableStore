@php
    $latestPosts = $posts->sortByDesc('created_at')->take(2);
@endphp

<x-layout-site>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-green-700">Bài viết mới nhất</h1>
    
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-6">
            @foreach($latestPosts as $post)
            <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition flex flex-col">
                <a href="{{ route('site.post.detail', ['slug' => $post->slug]) }}">
                    <img 
                        src="{{ asset('asset/image/post/' . $post->thumbnail) }}" 
                        class="rounded-xl shadow-md w-20 h-20 object-cover"
                    >
                    <h2 class="text-base font-semibold text-green-800 mb-2">{{ $post->title }}</h2>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($post->description, 60) }}</p>
                </a>
                <a href="{{ route('site.post.detail', ['slug' => $post->slug]) }}"
                    class="mt-auto inline-block text-sm text-white bg-green-700 hover:bg-green-600 px-3 py-1 rounded-xl transition">
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
