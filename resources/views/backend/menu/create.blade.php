<x-layout-admin>
    <form action="{{ route('menu.store') }}" method="POST">
        @csrf

        <div class="border border-blue-100 mb-3 rounded-lg p-5 bg-white shadow">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-blue-600">THÊM MENU</h2>
                <div class="space-x-2">
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-xl text-white font-semibold transition">
                        <i class="fa fa-save"></i> Lưu
                    </button>
                    <a href="{{ route('menu.index') }}"
                        class="bg-sky-500 hover:bg-sky-600 px-4 py-2 rounded-xl text-white font-semibold transition">
                        <i class="fa fa-arrow-left"></i> Về danh sách
                    </a>
                </div>
            </div>

            <!-- Form -->
            <div class="space-y-4">
                <div>
                    <label class="font-semibold">Tên Menu</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="font-semibold">Link</label>
                    <input type="text" name="link" value="{{ old('link') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="font-semibold">Vị trí hiển thị</label>
                    <select name="position"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        <option value="main" {{ old('position') == 'main' ? 'selected' : '' }}>Menu chính (Main)</option>
                        <option value="footer" {{ old('position') == 'footer' ? 'selected' : '' }}>Menu chân trang (Footer)</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
</x-layout-admin>
