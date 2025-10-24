<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Đăng nhập quản trị</title>
</head>

<body class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="flex w-[1000px] h-[600px] max-w-6xl bg-white rounded-2xl shadow-2xl overflow-hidden">
        <!-- Left: Form -->
        <div class="w-1/2 p-12 flex flex-col justify-center">
            <h2 class="text-3xl font-bold text-center mb-4">Log in</h2>
            <p class="text-sm text-center text-gray-500 mb-6">to your account</p>

            <form action="{{ route('admin.dologinad') }}" method="post" class="space-y-6">
                @csrf
                <div>
                    <input type="text" name="username" placeholder="username" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <input type="password" name="password" placeholder="password" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-3 rounded-full hover:bg-blue-700 transition duration-300">
                    LOG IN
                </button>
            </form>

            <p class="text-sm text-center text-gray-500 mt-6 hover:underline cursor-pointer">
                Forgot password?
            </p>
        </div>

        <!-- Right: Image + Social -->
        <div class="w-1/2 relative flex flex-col items-center justify-center bg-cover bg-center text-white px-6"
            style="background-image: url('{{ asset('asset/image/login.jpeg') }}')">

            <div class="absolute inset-0 bg-black opacity-40 rounded-r-2xl"></div>

            <div class="relative z-10 text-center">
                <h2 class="text-3xl font-bold mb-4">Sign in</h2>
                <p class="mb-5">with one of your social profiles</p>
                <div class="flex justify-center space-x-4 mb-6">
    <button class="bg-blue-700 w-10 h-10 rounded-full font-bold text-white 
        transition duration-300 transform hover:scale-110 hover:bg-opacity-80">
        F
    </button>
    <button class="bg-blue-400 w-10 h-10 rounded-full font-bold text-white 
        transition duration-300 transform hover:scale-110 hover:bg-opacity-80">
        T
    </button>
    <button class="bg-red-600 w-10 h-10 rounded-full font-bold text-white 
        transition duration-300 transform hover:scale-110 hover:bg-opacity-80">
        G+
    </button>
</div>

                <p class="text-sm">Don’t have an account? <a href="#" class="underline">sign up</a></p>
            </div>
        </div>
    </div>

    <!-- Toastr Notifications -->
    @if(session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
    @endif

    @if(session('error'))
    <script>
        toastr.error("{{ session('error') }}");
    </script>
    @endif
</body>

</html>
