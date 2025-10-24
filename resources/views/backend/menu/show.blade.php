<x-layout-admin>
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Chi tiết Menu</h2>

        <div class="grid grid-cols-1 gap-4 text-gray-700">
            <p><strong>ID:</strong> {{ $menu->id }}</p>
            <p><strong>Tên menu:</strong> {{ $menu->name }}</p>
            <p><strong>Link:</strong> {{ $menu->link }}</p>
            <p><strong>Liên kết:</strong> 
                <a href="{{ $menu->link }}" class="text-blue-600 underline" target="_blank">
                    {{ $menu->link }}
                </a>
            </p>
            <p><strong>Kiểu:</strong> {{ $menu->type }}</p>
            <p><strong>Vị trí:</strong> {{ $menu->position }}</p>
            <p><strong>Thứ tự:</strong> {{ $menu->sort_order }}</p>
            <p><strong>Trạng thái:</strong> 
                @if ($menu->status == 1)
                    <span class="text-green-600 font-semibold">Hiển thị</span>
                @else
                    <span class="text-red-600 font-semibold">Ẩn</span>
                @endif
            </p>
            <p><strong>Ngày tạo:</strong> {{ optional($menu->created_at)->format('d/m/Y H:i') }}</p>
            <p><strong>Ngày cập nhật:</strong> {{ optional($menu->updated_at)->format('d/m/Y H:i') }}</p>
        </div>

        <div class="mt-6">
            <a href="{{ route('menu.index') }}" class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                <i class="fa fa-arrow-left mr-2"></i> Quay về danh sách
            </a>
        </div>
    </div>
</x-layout-admin>
