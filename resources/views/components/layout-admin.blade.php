<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $header ?? 'Trang quản lý' }}</title>
    {{ $header ?? '' }}

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e3f2fd;
        }

        .menu-container {
            background: #ffffff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .menu-container ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-container li {
            margin-bottom: 5px;
        }

        .menu-container a {
            display: flex;
            align-items: center;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            color: #333;
            text-decoration: none;
            transition: background 0.3s ease-in-out;
            cursor: pointer;
        }

        .menu-container a i {
            margin-right: 10px;
        }

        .menu-container a:hover {
            background: #ff9800;
            color: white;
        }

        .submenu {
            display: none;
            padding-left: 15px;
            background: #fdf3e3;
            border-left: 4px solid #ff9800;
            border-radius: 5px;
        }

        .submenu li a {
            padding: 10px;
            font-size: 15px;
            color: #555;
        }

        .submenu li a:hover {
            background: #ffcc80;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let menuItems = document.querySelectorAll(".menu-container > ul > li > a");
            menuItems.forEach(item => {
                item.addEventListener("click", function () {
                    let submenu = this.nextElementSibling;
                    if (submenu && submenu.classList.contains("submenu")) {
                        submenu.style.display = submenu.style.display === "block" ? "none" : "block";
                    }
                });
            });
        });
    </script>
</head>

<body>
    <!-- Header -->
    <header>
    <div class="flex bg-white shadow-md py-3 px-5 items-center justify-between">
    <div class="basis-2/12">
        <h1 class="text-center font-bold text-2xl text-black">QUẢN LÝ</h1>
    </div>

    <div class="flex items-center gap-6">
        <div class="text-gray-700 text-sm hover:text-blue-600 transition duration-300 ease-in-out">
            <i class="fa fa-user text-blue-500 mr-1"></i>
            <span class="font-medium">Xin chào,</span> 
            <span class="font-semibold text-black">{{ Auth::user()->name }}</span>        </div>

        <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="text-red-600 hover:text-red-800 transition duration-300 ease-in-out text-sm">
                <i class="fa fa-power-off mr-1"></i> Đăng xuất
            </button>
        </form>
    </div>
</div>

</header>


    <!-- Main layout -->
    <main class="flex mt-1">
        <!-- Sidebar menu -->
        <div class="basis-2/12 p-3 menu-container">
            <ul>
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Bảng điều khiển</a></li>

                <li>
                    <a><i class="fa fa-box"></i> Quản lý sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="{{ route('product.index') }}"><i class="fa fa-list"></i> Sản phẩm</a></li>
                        <li><a href="{{ route('category.index') }}"><i class="fa fa-tags"></i> Danh mục</a></li>
                        <li><a href="{{ route('brand.index') }}"><i class="fa fa-industry"></i> Thương hiệu</a></li>
                    </ul>
                </li>

                <li>
                    <a><i class="fa fa-newspaper"></i> Quản lý bài viết</a>
                    <ul class="submenu">
                        <li><a href="{{ route('post.index') }}"><i class="fa fa-file-alt"></i> Bài viết</a></li>
                        <li><a href="{{ route('topic.index') }}"><i class="fa fa-folder"></i> Chủ đề</a></li>
                    </ul>
                </li>

                <li>
                    <a><i class="fa fa-paint-brush"></i> Giao diện</a>
                    <ul class="submenu">
                        <li><a href="{{ route('menu.index') }}"><i class="fa fa-bars"></i> Menu</a></li>
                        <li><a href="{{ route('banner.index') }}"><i class="fa fa-image"></i> Banner</a></li>
                    </ul>
                </li>

                <li><a href="{{ route('contact.index') }}"><i class="fa fa-envelope"></i> Liên hệ</a></li>
                <li><a href="{{ route('order.index') }}"><i class="fa fa-shopping-cart"></i> Đơn hàng</a></li>
                <li><a href="{{ route('user.customer') }}"><i class="fa fa-users"></i> Khách hàng</a></li>
                <li><a href="{{ route('user.index') }}"><i class="fa fa-user-shield"></i> Thành viên</a></li>
            </ul>
        </div>

        <!-- Main content area -->
        <div class="basis-10/12 p-5 bg-white shadow-md rounded-lg">
            {{ $slot }}
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-blue-200 mt-1 py-6 px-1 text-center relative z-10">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4 text-gray-600">
            <div class="text-sm">
                © 2025 - Thiết kế bởi
                <span class="font-semibold text-blue-500 hover:underline hover:text-pink-500 transition-all duration-300">
                    Thanh Thảo
                </span>
            </div>
            <div class="flex space-x-4 text-xl">
                <a href="#" class="text-blue-400 hover:text-pink-500 transition-all duration-300">
                    <i class="fab fa-facebook-square"></i>
                </a>
                <a href="#" class="text-blue-400 hover:text-pink-500 transition-all duration-300">
                    <i class="fab fa-twitter-square"></i>
                </a>
                <a href="#" class="text-blue-400 hover:text-pink-500 transition-all duration-300">
                    <i class="fab fa-github-square"></i>
                </a>
            </div>
        </div>
    </footer>

    {{ $footer ?? '' }}
</body>

</html>
