<x-layout-site>
    <x-slot:title>
        Trang chủ
    </x-slot:title>

    <main>
        <!-- DANH MỤC NỔI BẬT -->
        <div class="container mx-auto my-12 px-4">
            <div class="flex items-center justify-center mb-6">
                <h2 class="text-3xl font-bold text-green-700 flex items-center space-x-2">
                    <span>Danh mục nổi bật</span>
                    <span>🍃</span>
                </h2>
            </div>
            <div class="border-t-2 border-green-500 w-1/3 mx-auto mb-8"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">
                <!-- Danh mục Rau củ -->
                <a href="{{ route('site.product.byCategory', ['category_slug' => 'rau']) }}">
                    <div class="relative group overflow-hidden rounded-xl shadow-lg h-56 w-full">
                        <img src="{{ asset('asset/image/product.jpeg') }}" alt="Rau củ" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-green-300 opacity-0 group-hover:opacity-50 transition-opacity"></div>
                        <div class="absolute inset-0 flex items-center justify-center flex-col">
                            <span class="text-white text-xl font-bold tracking-wide">Rau củ</span>
                        </div>
                    </div>
                </a>

                <!-- Danh mục Trái cây -->
                <a href="{{ route('site.product.byCategory', ['category_slug' => 'trai-cay']) }}">
                    <div class="relative group overflow-hidden rounded-xl shadow-lg h-56 w-full">
                        <img src="{{ asset('asset/image/product2.webp') }}" alt="Trái cây" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-green-300 opacity-0 group-hover:opacity-50 transition-opacity"></div>
                        <div class="absolute inset-0 flex items-center justify-center flex-col">
                            <span class="text-slate-800 text-xl font-bold tracking-wide">Trái cây</span>
                        </div>
                    </div>
                </a>

                <!-- Danh mục Nấm -->
                <a href="{{ route('site.product.byCategory', ['category_slug' => 'nam']) }}">
                    <div class="relative group overflow-hidden rounded-xl shadow-lg h-56 w-full">
                        <img src="{{ asset('asset/image/product3.webp') }}" alt="Nấm" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-green-300 opacity-0 group-hover:opacity-50 transition-opacity"></div>
                        <div class="absolute inset-0 flex items-center justify-center flex-col">
                            <span class="text-white text-xl font-bold tracking-wide">Nấm</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>



<br></br>
        <!-- Dòng dưới video nếu cần thêm -->
<div class="mt-8 flex flex-wrap justify-center gap-4">
    <div class="bg-green-100 text-green-800 font-semibold px-5 py-3 rounded-full shadow-md">
        👋 Xin chào, bạn đến đúng chỗ rồi!
    </div>
    <div class="bg-green-100 text-green-800 font-semibold px-5 py-3 rounded-full shadow-md">
        🥦 Rau sạch, tâm sạch – chỉ cần bạn ghé!
    </div>
    <div class="bg-green-100 text-green-800 font-semibold px-5 py-3 rounded-full shadow-md">
        🚀 Giao nhanh đến mức bạn chưa kịp nấu xong cơm!
    </div>
</div>
<br></br>
        <div class="relative group flex justify-center items-center">
    <div class="overflow-hidden rounded-2xl shadow-2xl border-4 border-green-600 w-full max-w-4xl">
        <video 
            class="w-full aspect-video object-cover rounded-2xl" 
            autoplay 
            loop 
            playsinline 
            controls
        >
            <source src="{{ asset('asset/video/snaptik_7496256322200014111.mp4') }}" type="video/mp4">
            Trình duyệt của bạn không hỗ trợ video.
        </video>
    </div>
</div>


                <!-- Nội dung
                <div class="animate-fadeIn delay-100 md:text-left text-center space-y-4 group">
                    <h2 class="text-3xl font-bold text-green-600 group-hover:text-green-800 transition-all duration-300">
                        Chúng tôi cung cấp những gì tốt nhất
                    </h2>
                    <p class="text-gray-700 text-lg leading-relaxed group-hover:text-gray-800 transition-all">
                        Trang trại của chúng tôi cung cấp các loại trái cây và rau quả tươi ngon nhất, được lựa chọn cẩn thận và giao đến bạn bằng tất cả tình yêu thương.
                    </p>
                    <p class="text-gray-700 text-lg leading-relaxed group-hover:text-gray-800 transition-all">
                        Chúng tôi tin tưởng vào việc hỗ trợ nông dân địa phương và mang những sản phẩm tươi ngon nhất trực tiếp đến bàn ăn của bạn.
                    </p>
                    <ul class="text-gray-600 text-lg space-y-2">
                        <li>🍎 <b>Tốt cho tim mạch & huyết áp</b></li>
                        <li>🥦 <b>Giàu chất xơ, hỗ trợ tiêu hóa</b></li>
                        <li>🍊 <b>Chống oxy hóa, làm đẹp da</b></li>
                        <li>🥕 <b>Bổ sung vitamin A, C, K cần thiết</b></li>
                    </ul>
                </div> -->
            </div>
        </div>

        <!-- SẢN PHẨM MỚI VÀ SALE -->
        <x-product-new />
        <x-product-sale />

        <!-- BÀI VIẾT MỚI -->
        <div class="container mx-auto">
            <h1 class="text-4xl font-bold text-center text-gray-800 bg-gradient-to-r from-yellow-100 via-pink-100 to-purple-100 py-4 px-8 rounded-xl shadow-md mb-10">
                Bài viết mới
            </h1>

            @foreach ($posts as $post)
                <x-post-item :postitem="$post" />
            @endforeach
        </div>

        <!-- CHỦ ĐỀ -->
        <div class="container mx-auto mt-12">
            <h1 class="text-4xl font-bold text-center text-gray-800 bg-gradient-to-r from-yellow-100 via-pink-100 to-purple-100 py-4 px-8 rounded-xl shadow-md mb-10">
                Chủ đề
            </h1>

            @foreach ($topics as $topic)
                <x-topic-item :topicitem="$topic" />
            @endforeach
        </div>

        <!-- TIN TỨC MỚI NHẤT -->
        <div class="w-full border-green-500 p-8 rounded-lg mt-12">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-1">TIN TỨC MỚI NHẤT</h2>
            <p class="text-sm text-gray-500 text-center mb-6">ORGANIC NEWS</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 animate-fadeIn">
                <!-- Bài viết mẫu -->
                <div class="bg-gray-100 rounded-lg overflow-hidden shadow-md hover:scale-105 hover:shadow-lg transform transition duration-300">
                    <img src="{{ asset('asset/image/raucu12.jpeg') }}" alt="Hình bài viết" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Các loại rau củ hữu cơ tốt nhất cho sức khỏe</h3>
                        <p class="text-sm text-gray-600">Những loại rau củ được trồng theo phương pháp hữu cơ giúp bảo vệ sức khỏe và môi trường...</p>
                    </div>
                </div>

                <!-- Các bài khác tương tự -->
                <div class="bg-gray-100 rounded-lg overflow-hidden shadow-md hover:scale-105 hover:shadow-lg transform transition duration-300">
                    <img src="{{ asset('asset/image/chebien.webp') }}" alt="Hình bài viết" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Cách chế biến rau củ hữu cơ đúng cách</h3>
                        <p class="text-sm text-gray-600">Hướng dẫn bạn cách chế biến các loại rau củ hữu cơ để giữ nguyên dinh dưỡng và hương vị...</p>
                    </div>
                </div>

                <div class="bg-gray-100 rounded-lg overflow-hidden shadow-md hover:scale-105 hover:shadow-lg transform transition duration-300">
                    <img src="{{ asset('asset/image/tot.jpg') }}" alt="Hình bài viết" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Lợi ích của việc ăn rau củ sạch mỗi ngày</h3>
                        <p class="text-sm text-gray-600">Ăn rau củ sạch không chỉ giúp cải thiện sức khỏe mà còn nâng cao chất lượng cuộc sống...</p>
                    </div>
                </div>

                <div class="bg-gray-100 rounded-lg overflow-hidden shadow-md hover:scale-105 hover:shadow-lg transform transition duration-300">
                    <img src="{{ asset('asset/image/thuc-pham-huu-co-5.webp') }}" alt="Hình bài viết" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Thực phẩm hữu cơ - Xu hướng tiêu dùng xanh</h3>
                        <p class="text-sm text-gray-600">Ngày càng nhiều người lựa chọn thực phẩm hữu cơ như một cách bảo vệ sức khỏe và môi trường...</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CSS hiệu ứng -->
        <style>
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fadeIn {
                animation: fadeIn 1s ease-out forwards;
            }
        </style>

    </main>
</x-layout-site>
