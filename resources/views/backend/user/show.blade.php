<x-layout-admin>
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-xl p-6 mt-8">

        {{-- Nút quay về --}}
        @php
            $backRoute = ($user->roles === 'admin') ? route('user.index') : route('user.customer');
        @endphp

        <div class="mb-6">
            <a href="{{ $backRoute }}"
               class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                <i class="fa fa-arrow-left mr-2"></i> Quay về danh sách
            </a>
        </div>

        {{-- Tiêu đề --}}
        <h2 class="text-2xl font-bold text-blue-600 mb-6 border-b pb-2">Chi tiết Người dùng</h2>

        {{-- Thông tin người dùng --}}
        <div class="space-y-4 text-gray-800">
            <p><strong class="text-gray-700">ID:</strong> {{ $user->id }}</p>
            <p><strong class="text-gray-700">Họ tên:</strong> {{ $user->name }}</p>
            <p><strong class="text-gray-700">Email:</strong> {{ $user->email }}</p>
            <p><strong class="text-gray-700">Vai trò:</strong> 
                <span class="px-2 py-1 rounded 
                    {{ $user->roles === 'admin' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                    {{ ucfirst($user->roles) }}
                </span>
            </p>
        </div>

        {{-- Danh sách đơn hàng --}}
        @if ($user->orders->count() > 0)
            <div class="mt-10">
                <h3 class="text-xl font-semibold text-blue-500 mb-4">Đơn hàng đã đặt</h3>

                @foreach ($user->orders as $order)
                    <div class="mb-8 border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                        <div class="bg-gray-100 px-4 py-3 flex justify-between items-center">
                            <div>
                                <p><strong>Mã đơn hàng:</strong> #{{ $order->id }}</p>
                                <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
                            </div>
                            <div class="text-right">
                              <tfoot>
                                <tr>
                                    <td colspan="4" class="border p-2 text-right font-semibold bg-gray-50">Tổng tiền đơn hàng:</td>
                                    <td class="border p-2 text-right font-bold text-pink-600 bg-gray-50">
                                        {{ number_format($order->orderDetails->sum('amount')) }}₫
                                    </td>
                                </tr>
                            </tfoot>
                                <p><strong>Trạng thái:</strong> 
                                    <span class="px-2 py-1 rounded 
                                        {{ $order->status === 'completed' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        {{-- Bảng sản phẩm trong đơn --}}
                        <table class="w-full table-auto border-collapse text-sm">
                            <thead class="bg-pink-100">
                                <tr>
                                    <th class="border p-2">Tên sản phẩm</th>
                                    <th class="border p-2">Hình ảnh</th>
                                    <th class="border p-2 text-center">Số lượng</th>
                                    <th class="border p-2 text-right">Giá</th>
                                    <th class="border p-2 text-right">Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderDetails as $detail)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border p-2">{{ $detail->product->name }}</td>
                                        <td class="border p-2">
                                            <img src="{{ asset('assets/images/product/' . $detail->product->thumbnail) }}"
                                                 class="w-20 h-20 object-cover border rounded" alt="{{ $detail->product->name }}">
                                        </td>
                                        <td class="border p-2 text-center">{{ $detail->qty }}</td>
                                        <td class="border p-2 text-right">{{ number_format($detail->price_buy) }}₫</td>
                                        <td class="border p-2 text-right">{{ number_format($detail->amount) }}₫</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-layout-admin>
