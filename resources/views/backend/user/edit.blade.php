<x-layout-admin>
    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="content-wrapper">
            <!-- Header -->
            <div class="border border-blue-100 mb-3 rounded-lg p-2 flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">CHỈNH SỬA NGƯỜI DÙNG</h2>
                <div class="text-right">
                    <button type="submit" class="bg-green-500 px-4 py-2 cursor-pointer rounded-xl text-white">
                        <i class="fa fa-save"></i> Cập nhật
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
                        <!-- Họ tên -->
                        <div class="mb-3">
                            <label for="name" class="font-semibold">Họ và tên</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                            @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="font-semibold">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                            @error('email') <p class="text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Điện thoại -->
                        <div class="mb-3">
                            <label for="phone" class="font-semibold">Số điện thoại</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                            @error('phone') <p class="text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Vai trò -->
                        <div class="mb-3">
                            <label for="role" class="font-semibold">Vai trò</label>
                            <select name="roles" id="roles"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                                <option value="admin" {{ old('roles', $user->roles) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="customer" {{ old('roles', $user->roles) == 'customer' ? 'selected' : '' }}>Khách hàng</option>
                            </select>

                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3">
                            <label for="status" class="font-semibold">Trạng thái</label>
                            <select name="status" id="status"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                                <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>Hoạt động</option>
                                <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '' }}>Tạm khóa</option>
                            </select>
                        </div>

                        <!-- Mật khẩu (tuỳ chọn) -->
                        <div class="mb-3">
                            <label for="password" class="font-semibold">Mật khẩu mới (nếu muốn thay đổi)</label>
                            <input type="password" name="password" id="password"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                            @error('password') <p class="text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="font-semibold">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layout-admin>