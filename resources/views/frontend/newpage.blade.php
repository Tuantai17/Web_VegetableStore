<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Tin Tức</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .img-cover {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        .img-contain {
            object-fit: contain;
            width: 100%;
            height: 100%;
        }

        .hover-zoom:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body style="background-color: rgb(229, 246, 234);">
    <header class="bg-white">
        <div class="container mx-auto px-8 py-4">
            <div class="flex items-center">
                <div class="md:basis-3/12 basis-3/12 py-2">
                    <img src="{{ asset('asset/image/logo1.jpg') }}" class="w-20 h-20" alt="Logo">
                </div>

                <div class="md:basis-6/12 basis-8/12 relative">
                    <input type="search" name="hhh" class="border border-gray-300 rounded-lg pl-10 pr-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tìm kiếm...">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
            </div>
        </div>
    </header>
<!-- Menu điều hướng -->
<nav class="mt-4 bg-green-500 text-white rounded-lg shadow-md">
    <ul class="flex flex-wrap justify-center space-x-4 p-3 text-sm md:text-base">
        <li><a href="home" class="hover:text-yellow-300 font-semibold">Home</a></li>
      
    </ul>
</nav>

    <section class="relative w-full">
        <img src="{{ asset('asset/image/banernew.webp') }}" alt="Tin tức" class="w-full h-64 object-cover">
        <h1 class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-4xl font-bold text-white">Tin tức</h1>
    </section>

    <div class="container mx-auto p-4 flex flex-col md:flex-row">
        <!-- Món ăn -->
        <main class="w-full md:w-3/4 grid grid-cols-1 md:grid-cols-2 gap-4">
         <!-- Món nước ép -->
<div class="relative rounded-lg overflow-hidden hover-zoom">
    <img src="{{ asset('asset/image/nuot.jpg') }}" alt="Nước ép" class="img-cover">
    <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col justify-center items-center text-white p-4">
        <h3 class="text-lg font-bold">Nước Ép Tươi</h3>
        <p class="text-sm">Giải nhiệt mùa hè</p>
    </div>
</div>

<!-- Món súp nấm -->
<div class="relative rounded-lg overflow-hidden hover-zoom">
    <img src="{{ asset('asset/image/sup.png') }}" alt="Sup Nấm" class="img-cover">
    <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col justify-center items-center text-white p-4">
        <h3 class="text-lg font-bold">Súp Nấm</h3>
        <p class="text-sm">Món ăn thanh đạm</p>
    </div>
</div>

<!-- Món trái cây sấy -->
<div class="relative rounded-lg overflow-hidden hover-zoom">
    <img src="{{ asset('asset/image/say.jpg') }}" alt="Trái cây sấy" class="img-cover">
    <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col justify-center items-center text-white p-4">
        <h3 class="text-lg font-bold">Trái Cây Sấy</h3>
        <p class="text-sm">Đậm đà hương vị tự nhiên</p>
    </div>
</div>

<!-- Món rau củ nướng thịt -->
<div class="relative rounded-lg overflow-hidden hover-zoom">
    <img src="{{ asset('asset/image/thit.jpg') }}" alt="Rau củ nướng thịt" class="img-cover">
    <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col justify-center items-center text-white p-4">
        <h3 class="text-lg font-bold">Rau Củ Nướng Thịt</h3>
        <p class="text-sm">Món ăn hấp dẫn cho bữa tiệc</p>
    </div>
</div>

        </main>

        <!-- Sidebar -->
        <aside class="w-full md:w-1/4 md:ml-4">
           
            <div class="bg-green-300 p-4 rounded-lg mt-4">
                <h3 class="text-xl font-bold text-white">Danh mục sản phẩm</h3>
                <ul class="mt-2 space-y-2">
                    <li class="hover:text-blue-400 cursor-pointer">Trái cây</li>
                    <li class="hover:text-blue-400 cursor-pointer">Rau củ</li>
                    <li class="hover:text-blue-400 cursor-pointer">Nấm</li>
                </ul>
            </div>
            <div class="bg-green-300 p-4 rounded-lg mt-4">
                <h3 class="text-xl font-bold text-pink-500">Tin tức nổi bật</h3>
                <ul class="mt-2 space-y-2">
                    <li class="hover:text-blue-400 cursor-pointer">5 loại rau củ tốt cho sức khỏe</li>
                    <li class="hover:text-blue-400 cursor-pointer">Xà lách là loại rau xanh quen thuộc,Giàu vitamin A, C, K, folate</li>
                    <li class="hover:text-blue-400 cursor-pointer">Cách chọn trái cây tươi</li>
                </ul>
            </div>
        </aside>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-20">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-5 gap-4 px-4">
            <div class="col-span-2">
                <div class="flex items-center mb-4">
                    <img src="{{ asset('asset/image/logo-ft.webp') }}" class="w-16 h-8" alt="Dola Organic">
                    <span class="text-xl font-bold text-white">Dola Organic</span>
                </div>
                <p class="text-xs text-white mb-2">
                    Cung cấp rau củ quả sạch và an toàn nhất tại Dola Organic.
                </p>
                <div class="flex space-x-2">
                    <img src="{{ asset('asset/image/payment_1.webp') }}" class="h-5">
                    <img src="{{ asset('asset/image/payment_2.webp') }}" class="h-5">
                    <img src="{{ asset('asset/image/payment_3.webp') }}" class="h-5">
                </div>
            </div>

            <div>
                <h3 class="text-sm font-bold text-white mb-2">CHÍNH SÁCH</h3>
                <ul class="text-xs text-white space-y-1">
                    <li>Chính sách thành viên</li>
                    <li>Hướng dẫn mua hàng</li>
                    <li>Bảo mật thông tin</li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-bold text-white mb-2">THÔNG TIN</h3>
                <ul class="text-xs text-white space-y-1">
                    <li>Địa chỉ: 70 Lữ Gia, Q.11, TP.HCM</li>
                    <li>Điện thoại: 1900 6750</li>
                    <li>Email: support@sapo.vn</li>
                </ul>
            </div>
<br></br>

            <div>
                <h3 class="text-sm font-bold text-white mb-2">INSTAGRAM</h3>
                <div class="grid grid-cols-3 gap-1">
                    <img src="{{ asset('asset/image/intagam.webp') }}" class="h-16 w-full object-cover rounded hover:scale-105">
                    <img src="{{ asset('asset/image/intagam1.webp') }}" class="h-16 w-full object-cover rounded hover:scale-105">
                    <img src="{{ asset('asset/image/intagam3.jpeg') }}" class="h-16 w-full object-cover rounded hover:scale-105">
                </div>
            </div>
        </div>
    </footer>
</body>

</html>