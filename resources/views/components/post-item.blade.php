<div class="container mx-auto py-10">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
        <!-- Hình ảnh -->
<div class="flex justify-center">
    <div class="overflow-hidden rounded-2xl shadow-lg max-w-md w-full">
        <div class="h-64 w-full"> <!-- Cố định chiều cao -->
            <img src="{{ asset('asset/image/post/' . $post->thumbnail) }}"
                 alt="{{ $post->image }}"
                 class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
        </div>
    </div>
</div>


        <!-- Nội dung -->
        <div class="px-4">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $post->title }}</h2>
            <p class="text-base text-gray-600 leading-relaxed mb-6">{{ $post->description }}</p>
            <a href="{{ route('site.post.detail', ['slug' => $post->slug]) }}">
                <button type="button"
                        class="py-2 px-6 border border-gray-700 text-gray-700 font-medium rounded-lg hover:bg-gray-700 hover:text-white transition duration-300">
                    Xem thêm
                </button>
            </a>
        </div>
    </div>
</div>v