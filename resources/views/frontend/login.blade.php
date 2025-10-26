<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { margin:0; padding:0; box-sizing:border-box; height:100vh; display:flex; justify-content:center; align-items:center; background:#edf2f7; }
    </style>
</head>
<body>
    <div class="w-[800px] h-[500px] bg-white shadow-lg rounded-xl flex overflow-hidden">
        <!-- Left Side (Login Form) -->
        <div class="w-1/2 bg-white flex flex-col justify-center items-center p-8 relative z-10">
            <h2 class="text-3xl font-semibold text-gray-800 mb-4">Đăng nhập</h2>
            <p class="text-gray-600 mb-6">Vui lòng đăng nhập tài khoản của bạn</p>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4 w-full text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 w-full text-center">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Dùng path tương đối để đảm bảo HTTPS --}}
            <form action="/loginngdung" method="POST" class="w-full">
                @csrf
                <input type="text" name="username" placeholder="Tên đăng nhập / Email"
                       class="border border-gray-300 rounded-lg px-4 py-2 w-full mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <input type="password" name="password" placeholder="Mật khẩu"
                       class="border border-gray-300 rounded-lg px-4 py-2 w-full mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Đăng nhập
                </button>
            </form>

            <div class="mt-4 text-sm text-gray-600">
                Chưa có tài khoản?
                <a href="{{ route('user.register.form') }}" class="text-blue-500 hover:underline">Đăng ký</a>
            </div>
        </div>

        <!-- Right Side -->
        <div class="w-1/2 bg-cover bg-center relative" style="background-image:url('{{ asset('assets/image/login.jpeg') }}');">
            <div class="absolute inset-0 bg-black/40"></div>
            <div class="relative z-10 flex items-center justify-center h-full text-white text-center px-4">
                <div>
                    <h2 class="text-4xl font-bold mb-4">Chào mừng bạn!</h2>
                    <p class="text-xl">Đăng nhập để trải nghiệm những tiện ích tuyệt vời.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
