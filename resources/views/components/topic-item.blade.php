<div class="container mx-auto py-10 px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center bg-gradient-to-r from-green-50 to-green-100 p-6 rounded-2xl shadow-md h-[250px] overflow-hidden">

        <!-- Hình ảnh chủ đề -->
        <div class="h-full flex items-center justify-center">
            <img
                src="{{ asset('asset/image/chude.jpg') }}"
                alt="Hình chủ đề"
                class="h-full max-h-[220px] w-auto object-contain rounded-xl shadow">
        </div>

        <!-- Nội dung -->
        <div class="h-full flex flex-col justify-between">
            <div>
                <h2 class="text-xl md:text-2xl font-bold text-green-800 mb-2 flex items-center gap-2">
                    @if (!empty($topicitem->icon_image))
                        <img src="{{ asset('assets/icons/' . $topicitem->icon_image) }}" class="w-7 h-7" alt="icon">
                    @else
                        🌿
                    @endif
                    {{ $topicitem->name }}
                </h2>

                <p class="text-gray-700 text-sm md:text-base leading-relaxed line-clamp-3">
                   
                An toàn cho sức khỏe: Rau củ sạch được trồng theo quy trình an toàn, không sử dụng hóa chất độc hại, thuốc trừ sâu, thuốc kích thích tăng trưởng. 
                </p>
            </div>

            <div class="mt-3">
                <a href="{{ route('site.topic.detail', ['slug' => $topicitem->slug]) }}">
                    
                </a>
            </div>
        </div>
    </div>
</div>
