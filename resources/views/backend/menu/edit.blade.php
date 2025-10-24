<x-layout-admin>
    <form action="{{ route('menu.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="content-wrapper">
            <!-- Header -->
            <div class="border border-blue-100 mb-3 rounded-lg p-2 flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">CHỈNH SỬA MENU</h2>
                <div class="text-right">
                    <button type="submit" class="bg-green-500 px-4 py-2 cursor-pointer rounded-xl text-white">
                        <i class="fa fa-save"></i> Cập nhật
                    </button>
                    <a href="{{ route('menu.index') }}" class="bg-sky-500 px-4 py-2 rounded-xl text-white">
                        <i class="fa fa-arrow-left"></i> Về danh sách
                    </a>
                </div>
            </div>

            <!-- Form chính -->
            <div class="border border-blue-100 rounded-lg p-3">
                <div class="mb-3">
                    <label for="name" class="font-semibold">Tên menu</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $menu->name) }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
                    @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="mb-3">
                    <label for="link" class="font-semibold">Liên kết</label>
                    <input type="text" name="link" id="link" value="{{ old('link', $menu->link) }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                    @error('link') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="mb-3">
                    <label for="position" class="font-semibold">Vị trí</label>
                    <select name="position" id="position"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        <option value="mainmenu" {{ old('position', $menu->position) == 'mainmenu' ? 'selected' : '' }}>Main Menu</option>
                        <option value="footermenu" {{ old('position', $menu->position) == 'footermenu' ? 'selected' : '' }}>Footer Menu</option>
                    </select>
                    @error('position') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="mb-3">
                    <label for="parent_id" class="font-semibold">Menu cha</label>
                    <select name="parent_id" id="parent_id"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        <option value="0">-- Không có --</option>
                        @foreach ($menus as $item)
                            <option value="{{ $item->id }}" {{ old('parent_id', $menu->parent_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="font-semibold">Trạng thái</label>
                    <select name="status" id="status"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        <option value="1" {{ old('status', $menu->status) == 1 ? 'selected' : '' }}>Xuất bản</option>
                        <option value="0" {{ old('status', $menu->status) == 0 ? 'selected' : '' }}>Không xuất bản</option>
                    </select>
                    @error('status') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </form>
</x-layout-admin>
