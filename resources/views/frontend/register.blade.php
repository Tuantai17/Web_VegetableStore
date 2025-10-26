<x-layout-site>
  <x-slot:title>Đăng ký</x-slot:title>

  <main class="max-w-md mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Đăng ký tài khoản</h2>

    @if ($errors->any())
      <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
        <ul class="list-disc ml-5">
          @foreach ($errors->all() as $err) <li>{{ $err }}</li> @endforeach
        </ul>
      </div>
    @endif
    @if (session('error'))
      <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">{{ session('error') }}</div>
    @endif
    @if (session('success'))
      <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    <form method="POST" enctype="multipart/form-data"
          class="bg-white shadow-md rounded px-8 py-6 space-y-4">
      @csrf
      <input type="text" name="name" placeholder="Họ và tên" class="w-full p-2 border rounded" value="{{ old('name') }}" required>
      <input type="text" name="username" placeholder="Tên đăng nhập" class="w-full p-2 border rounded" value="{{ old('username') }}" required>
      <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded" value="{{ old('email') }}" required>
      <input type="password" name="password" placeholder="Mật khẩu" class="w-full p-2 border rounded" required>
      <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" class="w-full p-2 border rounded" required>
      <input type="text" name="phone" placeholder="Số điện thoại" class="w-full p-2 border rounded" value="{{ old('phone') }}" required>
      <input type="text" name="address" placeholder="Địa chỉ" class="w-full p-2 border rounded" value="{{ old('address') }}" required>
      <input type="file" name="avatar" class="w-full p-2 border rounded" accept="image/*">
      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 w-full">
        Đăng ký
      </button>
    </form>
  </main>
</x-layout-site>
