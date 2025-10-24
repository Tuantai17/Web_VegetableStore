<x-layout-admin>
    <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="content-wrapper p-4">
            <!-- Header -->
            <div class="border border-pink-100 mb-6 rounded-lg p-4 flex items-center justify-between">
                <h2 class="text-2xl font-bold text-pink-600">CHỈNH SỬA ĐƠN HÀNG #{{ $order->id }}</h2>
                <div class="flex gap-2">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-xl text-white">
                        <i class="fa fa-save"></i> Cập nhật
                    </button>
                    <a href="{{ route('admin.order.index') }}" class="bg-sky-500 hover:bg-sky-600 px-4 py-2 rounded-xl text-white">
                        <i class="fa fa-arrow-left"></i> Về danh sách
                    </a>
                </div>
            </div>

            <!-- Form Nội dung -->
            <div class="border border-pink-100 rounded-lg p-4 space-y-6">

                <!-- Tên khách hàng -->
                <div>
                    <label class="font-semibold block mb-2">Tên khách hàng</label>
                    <input type="text" value="{{ $order->name }}"
                        class="w-full border border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                </div>

                <!-- Trạng thái đơn hàng -->
                <!-- Trạng thái -->
                <div class="mb-3">
                    <label class="font-semibold block mb-2">Trạng thái</label>
                    <div class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            id="status"
                            name="status"
                            value="1"
                            {{ old('status', $product->status) == '1' ? 'checked' : '' }}>
                        <label for="status" id="status-label">
                            {{ old('status', $product->status) == '1' ? 'Xuất bản' : 'Không xuất bản' }}
                        </label>
                    </div>
                </div>


            </div>
        </div>
    </form>
</x-layout-admin>