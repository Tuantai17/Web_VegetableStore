<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $title ?? 'Shop Thanh Thảo'}}</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" >
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{ $header ?? ''}}
    </head>
    <body style="background-color: rgb(229, 246, 234);">
        <header class="bg-white">
            <div class="container mx-auto px-8 py-4">
                <div class="flex items-center">
                    <div class="md:basis-3/12 basis-3/12 py-2">
                        <img src="{{ asset('asset/image/logo1.jpg') }}" class="w-20 h-20" alt="Logo">
                    </div>
                    <!-- tìm iếm -->
                    <form action="{{ route('site.product.search') }}" method="GET" class="md:basis-6/12 basis-8/12 relative">
    <input type="search" name="keyword" class="border border-gray-300 rounded-lg pl-10 pr-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tìm kiếm...">
    <button type="submit">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
    </button>
</form>


<!--  -->

                    <div class="flex items-center justify-end space-x-2 py-2 bg-white px-4 border-b border-gray-300">
    <!-- Hotline Button -->
    <div class="flex items-center bg-white text-green-600 text-sm font-semibold px-3 py-1 rounded-full space-x-2 border border-green-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a2 2 0 011.95 1.55l.54 2.18a2 2 0 01-.45 1.84l-1.1 1.1a11.042 11.042 0 005.4 5.4l1.1-1.1a2 2 0 011.84-.45l2.18.54A2 2 0 0121 17.72V21a2 2 0 01-2 2h-1a16.018 16.018 0 01-16-16V7a2 2 0 012-2h1z" />
        </svg>
        <span>Hotline: 1900 6750</span>
    </div>

    <!-- Icons -->
    <style>
    .dropdown { position: relative; display: inline-block; }
    .dropdown-content { 
        display: none; position: absolute; top: 100%; left: 50%; transform: translateX(-50%);
        background: white; min-width: 120px; border: 1px solid #e5e7eb; border-radius: 6px;
    }
    .dropdown:hover .dropdown-content { display: block; }
    .dropdown-content a { display: block; padding: 8px 12px; text-decoration: none; color: black; }
    .dropdown-content a:hover { background: #f0f0f0; }
</style>

<!-- User Icon with Dropdown -->



<!-- Nút và Dropdown Tài Khoản -->
<!-- Nút và Dropdown Tài Khoản -->
<div class="relative inline-block text-left z-50">
    <button onclick="toggleAccountInfo()" class="flex items-center px-4 py-2 border-2 border-green-600 rounded-full text-green-600 bg-white hover:bg-green-50">
        <span class="mr-2">👤</span>
        {{ Auth::check() ? Auth::user()->name : 'Tài khoản' }}
    </button>

    <!-- Thông tin tài khoản -->
    <div id="accountInfo" class="absolute right-0 mt-2 w-64 bg-white border rounded shadow-lg hidden p-4 text-sm">
        @auth
            <div class="mb-2 text-gray-800">
                <div class="font-semibold text-base mb-1">Thông tin tài khoản</div>
                <p><strong>Tên:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            </div>
            <a href="{{ route('user.account') }}" class="block text-blue-600 hover:underline">Xem chi tiết tài khoản</a>
            <a href="#" onclick="logoutUser()" class="block mt-2 text-red-600 hover:underline">Đăng xuất</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <a href="{{ route('site.login') }}" class="block mb-2 text-green-600 hover:underline">Đăng nhập</a>
            <a href="{{ route('user.register.form') }}" class="block text-green-600 hover:underline">Đăng ký</a>
        @endauth
    </div>
</div>

<!-- JavaScript -->
<script>
    function toggleAccountInfo() {
        const dropdown = document.getElementById('accountInfo');
        dropdown.classList.toggle('hidden');
    }

    function logoutUser() {
        document.getElementById('logout-form').submit();
    }

    // Ẩn dropdown khi click ra ngoài
    document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('accountInfo');
        const button = document.querySelector('button[onclick="toggleAccountInfo()"]');
        if (!dropdown.contains(event.target) && !button.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>


        
        <!-- Location (Mũi tên ghim địa chỉ) Icon -->
        <div class="relative p-2 rounded-full bg-white text-green-600 cursor-pointer border border-green-600">
            <a href="https://www.google.com/maps/place/S%E1%BB%9F+T%C3%A0i+Nguy%C3%AAn+V%C3%A0+M%C3%B4i+Tr%C6%B0%E1%BB%9Dng+TP.HCM/@10.8298731,106.771639,17z/data=!3m1!4b1!4m6!3m5!1s0x31752701cbacce21:0xc55b53936092d0e1!8m2!3d10.8298731!4d106.771639!16s%2Fg%2F11j8dl1k1h"
               target="_blank">
                📍
            </a>
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">8</span>
        </div>
        
        <!-- Heart (Trái Tim) Icon -->
        <div class="relative p-2 rounded-full bg-white text-green-600 cursor-pointer border border-green-600">
            ❤️
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">0</span>
        </div>
        
        <!-- Cart (Giỏ Hàng) Icon -->
        <a href="{{ route('site.cart') }}">
    <div class="relative p-2 rounded-full bg-white text-green-600 cursor-pointer border border-green-600">
        🛒
        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">
            {{ session('cart') ? count(session('cart')) : 0 }}
        </span>
    </div>
</a>

    </div>
</div>

                </div>
            </div>
           
        </header>


           <!-- banner -->
<div class="flex w-full h-[400px] gap-4">
    <!-- Slider chính bên trái -->
    <div x-data="{ active: 0 }" 
        x-init="setInterval(() => active = (active + 1) % 2, 3000)" 
        class="relative w-2/3 overflow-hidden rounded-lg">

        <div class="flex w-[200%] h-full transition-transform duration-700 ease-in-out"
            :style="'transform: translateX(-' + (active * 50) + '%);'">

            <!-- Slide 1: Hiển thị ảnh IMAC -->
            <a href="https://example.com/imac" class="w-full h-full flex-shrink-0">
                <img src="{{ asset('asset/image/baner1.jpeg') }}" alt="IMAC 21,5 IN (MK142)" class="w-full h-full object-cover rounded-lg">
            </a>
            <!-- Slide 2: Hiển thị ảnh Macbook Pro -->
            <a href="https://example.com/macbook" class="w-full h-full flex-shrink-0">
                <img src="{{ asset('asset/image/banner_three_1.webp') }}" alt="MACBOOK PRO M1" class="w-full h-full object-cover rounded-lg">
            </a>
        </div>
        <!-- Nút điều hướng -->
        <button @click="active = (active === 0 ? 1 : 0)" 
                class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white text-black p-1 rounded-full shadow">❮</button>
        <button @click="active = (active === 0 ? 1 : 0)" 
                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white text-black p-1 rounded-full shadow">❯</button>
    </div>
    <!-- Quảng cáo bên phải -->
    <div class="w-1/3 flex flex-col gap-2 h-full">
        <!-- Quảng cáo 1 -->
        <img src="{{ asset('asset/image/baner2.jpg') }}" alt="BEATPHONE" class="w-full h-1/2 object-cover rounded-lg">

        <!-- Quảng cáo 2 -->
        <img src="{{ asset('asset/image/banner_three_2.webp') }}" alt="GALAXY S9" class="w-full h-1/2 object-cover rounded-lg">
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <br></br>
    <!-- menu -->
<x-main-menu/>
            {{ $slot }}


  
        <!-- Footer -->
        <footer style="background-color: rgb(83, 94, 85);" class="py-20">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-5 gap-4 px-4">
        
        <!-- Logo & Description -->
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
 <!-- Liên kết nhanh -->
 <div class="max-w-xs">
                <h3 class="text-white text-3xl font-bold mb-3 relative inline-block">
                    Liên Kết Nhanh
                    <span class="block w-12 h-1 bg-blue-500 absolute -bottom-1 left-1/2 -translate-x-1/2"></span>
                </h3>
                <ul class="mt-6 space-y-3 text-lg font-medium">
    <li><a href="{{ url('/') }}" class="text-white hover:text-pink-500">Trang Chủ</a></li>
    <li><a href="{{ url('/about') }}" class="text-white hover:text-pink-500">Giới Thiệu</a></li>
    <li><a href="{{ url('/sanp-pham') }}" class="text-white hover:text-pink-500">Sản Phẩm</a></li>
    <li><a href="{{ url('/lien-he') }}" class="text-white hover:text-pink-500">Liên Hệ</a></li>
</ul>

            </div>
        <!-- Chính sách -->
        <div>
            <h3 class="text-sm font-bold text-white mb-2">CHÍNH SÁCH</h3>
            <ul class="text-xs text-white space-y-1">
                <li>Chính sách thành viên</li>
                <li>Hướng dẫn mua hàng</li>
                <li>Bảo mật thông tin</li>
            </ul>
        </div>

        <!-- Thông tin chung -->
        <div>
            <h3 class="text-sm font-bold text-white mb-2">THÔNG TIN</h3>
            <ul class="text-xs text-white space-y-1">
                <li>Địa chỉ: 70 Lữ Gia, Q.11, TP.HCM</li>
                <li>Điện thoại: 1900 6750</li>
                <li>Email: support@sapo.vn</li>
            </ul>
        </div>

        <!-- Instagram -->
        <div>
            <h3 class="text-sm font-bold text-white mb-2">INSTAGRAM</h3>
            <div class="grid grid-cols-3 gap-1">
                <img src="{{ asset('asset/image/intagam.webp') }}" class="h-16 w-full object-cover rounded transition-transform transform hover:scale-105">
                <img src="{{ asset('asset/image/intagam1.webp') }}" class="h-16 w-full object-cover rounded transition-transform transform hover:scale-105">
                <img src="{{ asset('asset/image/intagam3.jpeg') }}" class="h-16 w-full object-cover rounded transition-transform transform hover:scale-105">
            </div>
        </div>
    </div>
    
</footer>

{{ $footer ?? '' }}


    </body>
</html>
