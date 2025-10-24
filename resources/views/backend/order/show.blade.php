<x-layout-admin>
    <div class="content-wrapper p-6 bg-gray-50 min-h-screen">
        <h2 class="text-3xl font-bold text-pink-600 mb-6">Chi tiết đơn hàng #{{ $order->id }}</h2>

        <!-- Thông tin khách hàng -->
        <div class="mb-8 bg-white shadow-sm rounded-lg p-6 border border-gray-200">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Thông tin khách hàng:</h3>
            <ul class="space-y-2 text-gray-600">
                <li><strong>Tên:</strong> {{ $order->name }}</li>
                <li><strong>SĐT:</strong> {{ $order->phone }}</li>
                <li><strong>Email:</strong> {{ $order->email }}</li>
                <li><strong>Địa chỉ:</strong> {{ $order->address }}</li>
                <li><strong>Ghi chú:</strong> {{ $order->note }}</li>
            </ul>
        </div>

        <!-- Sản phẩm -->
        <div class="bg-white shadow-sm rounded-lg p-6 border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Sản phẩm đặt mua:</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                    <thead class="bg-pink-100 text-gray-700">
                        <tr>
                            <th class="p-3 text-left">Tên sản phẩm</th>
                            <th class="p-3 text-left">Hình ảnh</th>
                            <th class="p-3 text-center">Số lượng</th>
                            <th class="p-3 text-right">Giá</th>
                            <th class="p-3 text-right">Tổng</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($order->orderDetails as $detail)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3">{{ $detail->product->name }}</td>
                            <td class="p-3">
                                <img src="{{ asset('assets/images/product/' . $detail->product->thumbnail) }}"
                                    class="w-20 h-20 object-cover border rounded" alt="{{ $detail->product->name }}">
                            </td>
                            <td class="p-3 text-center">{{ $detail->qty }}</td>
                            <td class="p-3 text-right">{{ number_format($detail->price_buy) }}₫</td>
                            <td class="p-3 text-right">{{ number_format($detail->amount) }}₫</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="p-3 text-right font-semibold text-gray-700 bg-gray-100">Tổng tiền:</td>
                            <td class="p-3 text-right font-bold text-pink-600 bg-gray-100">
                                {{ number_format($order->orderDetails->sum('amount')) }}₫
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Nút quay về -->
            <div class="mt-6">
                <a href="{{ route('order.index') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">
                    ← Quay về danh sách đơn hàng
                </a>
            </div>
        </div>
    </div>
</x-layout-admin>
