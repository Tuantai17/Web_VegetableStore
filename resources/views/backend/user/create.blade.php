<x-layout-admin>
    <form action="{{ route('user.store') }}" method="post">
        @csrf

        <div class="content-wrapper">
            <!-- Header -->
            <div class="border border-blue-100 mb-3 rounded-lg p-2 flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">THÊM NGƯỜI DÙNG</h2>
                <div class="text-right">
                    <button type="submit" class="bg-green-500 px-4 py-2 cursor-pointer rounded-xl text-white">
                        <i class="fa fa-save"></i> Lưu
                    </button>
                    <a href="{{ route('user.index') }}" class="bg-sky-500 px-4 py-2 rounded-xl text-white">
                        <i class="fa fa-arrow-left"></i> Về danh sách
                    </a>
                </div>
            </div>

            <!-- Form chính -->
            <div class="border border-blue-100 rounded-lg p-3">
                <div class="flex gap-6">
                    <div class="basis-9/12">
                        <!-- Họ và tên -->
                        <div class="mb-3">
                            <label for="name" class="font-semibold">Họ và tên</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500"
                                placeholder="Nhập họ và tên" required>
                            @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <!-- Username -->
<div class="mb-3">
    <label for="username" class="font-semibold">Tên đăng nhập</label>
    <input type="text" name="username" id="username" value="{{ old('username') }}"
        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
    @error('username') <p class="text-red-500">{{ $message }}</p> @enderror
</div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="font-semibold">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" 
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500"
                                placeholder="Nhập email" required>
                            @error('email') <p class="text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Vai trò -->
                        <div class="mb-3">
                            <label for="role" class="font-semibold">Vai trò</label>
                            <select name="role" id="role"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                                <option value="">Chọn vai trò</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>

                            </select>
                            @error('role') <p class="text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3">
                            <label for="status" class="font-semibold">Trạng thái</label>
                            <select name="status" id="status"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Bật</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Tắt</option>
                            </select>
                        </div>

                        <!-- Mật khẩu -->
                        <div class="mb-3">
                            <label for="password" class="font-semibold">Mật khẩu</label>
                            <input type="password" name="password" id="password"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500"
                                required>
                            @error('password') <p class="text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Nhập lại mật khẩu -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="font-semibold">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500"
                                required>
                               <!-- Số điện thoại -->
<div class="mb-3">
    <label for="phone" class="font-semibold">Số điện thoại</label>
    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500"
        required>
    @error('phone') <p class="text-red-500">{{ $message }}</p> @enderror
</div>


                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layout-admin>
