<x-layout-site>
    <x-slot:title>
        Trang liên hệ
    </x-slot:title>

    <main class="container mx-auto p-8">
    <!-- Vì sao chọn chúng tôi -->
    <div class="max-w-7xl mx-auto px-8 py-20">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800">VÌ SAO CHỌN CHÚNG TÔI</h2>
            <div class="w-24 h-1 bg-green-500 mx-auto mt-3 mb-8"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 items-center">
            <!-- Cột bên trái -->
            <div class="space-y-8 text-right">
                <div class="flex items-center justify-end space-x-6">
                    <span class="text-xl font-semibold text-green-700">Tươi Ngon Từ Nông Trại</span>
                    <div class="w-16 h-16 flex items-center justify-center bg-green-100 rounded-full text-2xl">✅</div>
                </div>
                <div class="flex items-center justify-end space-x-6">
                    <span class="text-xl font-semibold text-green-700">100% Hữu Cơ</span>
                    <div class="w-16 h-16 flex items-center justify-center bg-green-100 rounded-full text-2xl">✅</div>
                </div>
                <div class="flex items-center justify-end space-x-6">
                    <span class="text-xl font-semibold text-green-700">Dinh Dưỡng Vượt Trội</span>
                    <div class="w-16 h-16 flex items-center justify-center bg-green-100 rounded-full text-2xl">✅</div>
                </div>
            </div>
            
            <!-- Video trung tâm -->
            <div class="relative group">
                <div class="overflow-hidden rounded-2xl shadow-2xl border-4 border-green-600">
                    <video class="w-full h-auto rounded-2xl" autoplay loop muted playsinline>
                        <source src="{{ asset('asset/video/banner.mp4') }}" type="video/mp4">
                        Trình duyệt của bạn không hỗ trợ video.
                    </video>
                </div>
            </div>
            
            <!-- Cột bên phải -->
            <div class="space-y-8 text-left">
                <div class="flex items-center space-x-6">
                    <div class="w-16 h-16 flex items-center justify-center bg-green-100 rounded-full text-2xl">✅</div>
                    <span class="text-xl font-semibold text-green-700">Giá cả hợp lý</span>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="w-16 h-16 flex items-center justify-center bg-green-100 rounded-full text-2xl">✅</div>
                    <span class="text-xl font-semibold text-green-700">Giao hàng nhanh chóng</span>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="w-16 h-16 flex items-center justify-center bg-green-100 rounded-full text-2xl">✅</div>
                    <span class="text-xl font-semibold text-green-700">Thanh toán an toàn</span>
                </div>
            </div>
        </div>
    </div>

<!-- Gợi ý món ăn -->
<div class="max-w-7xl mx-auto px-8 py-20 rounded-xl shadow-lg" style="background-color: rgb(127, 168, 136);">
    <div class="text-center">
        <h2 class="text-3xl font-bold text-white">GỢI Ý MÓN NGON TỪ RAU CỦ HỮU CƠ</h2>
        <div class="w-24 h-1 bg-green-300 mx-auto mt-3 mb-8"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
            <div class="overflow-hidden rounded-lg w-full h-56">
                <img src="{{ asset('asset/image/about1.webp') }}" alt="Sữa chua trái cây" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
            </div>
            <h3 class="text-green-700 mt-4 text-xl font-semibold text-center">Salad trái cây và rau củ</h3>
            <p class="text-gray-600 text-center">Kết hợp trái cây tươi như dưa hấu, táo, nho, xoài với rau củ như xà lách, dưa chuột, cà rốt để tạo thành một món salad bổ dưỡng và tươi ngon</p>
        </div> -->
        <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
            <div class="overflow-hidden rounded-lg w-full h-56">
                <img src="{{ asset('asset/image/about2.webp') }}" alt="Sinh tố rau củ detox" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
            </div>
            <h3 class="text-green-700 mt-4 text-xl font-semibold text-center">Sữa chua trái cây</h3>
            <p class="text-gray-600 text-center">Sữa chua kết hợp với dâu tây, việt quất và mật ong, tạo nên món ăn nhẹ bổ dưỡng và tốt cho hệ tiêu hóa.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
            <div class="overflow-hidden rounded-lg w-full h-56">
                <img src="{{ asset('asset/image/about3.jpeg') }}" alt="Bánh socola trái cây" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
            </div>
            <h3 class="text-green-700 mt-4 text-xl font-semibold text-center">Bánh socola trái cây</h3>
            <p class="text-gray-600 text-center">Bánh socola thơm ngon kết hợp với dâu tây và việt quất, tạo nên hương vị ngọt ngào khó cưỡng.</p>
        </div>
    </div>
</div>

<!-- dịch vụ -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <!-- Dịch vụ 1 -->
                <div class="bg-gray-100 border border-green-500 p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2 group cursor-pointer relative overflow-hidden h-[320px]">
                    <div class="flex justify-center items-center h-32 overflow-hidden">
                        <img src="{{ asset('asset/image/dichvu_1.webp') }}" alt="Rau hữu cơ tươi" class="transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <h3 class="text-green-700 mt-4 text-xl font-semibold text-center">Rau hữu cơ tươi</h3>
                    <div class="w-12 h-1 bg-green-500 mx-auto my-2"></div>
                    <p class="text-gray-600 mb-4 text-center">Được trồng theo phương pháp hiện đại, đạt tiêu chuẩn quốc tế, vô cùng an toàn khi sử dụng.</p>
                </div>

                <!-- Dịch vụ 2 -->
                <div class="bg-gray-100 border border-green-500 p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2 group cursor-pointer relative overflow-hidden h-[320px]">
                    <div class="flex justify-center items-center h-32 overflow-hidden">
                        <img src="{{ asset('asset/image/dichvu_2.webp') }}" alt="Giao hàng nhanh chóng" class="transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <h3 class="text-green-700 mt-4 text-xl font-semibold text-center">Giao hàng nhanh chóng</h3>
                    <div class="w-12 h-1 bg-green-500 mx-auto my-2"></div>
                    <p class="text-gray-600 mb-4 text-center">Giao hàng trong thời gian nhanh nhất để đảm bảo chất lượng tốt nhất cho những sản phẩm bạn đã đặt.</p>
                </div>

                <!-- Dịch vụ 3 -->
                <div class="bg-gray-100 border border-green-500 p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2 group cursor-pointer relative overflow-hidden h-[320px]">
                    <div class="flex justify-center items-center h-32 overflow-hidden">
                        <img src="{{ asset('asset/image/dichvu_3.webp') }}" alt="Thanh toán dễ dàng" class="transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <h3 class="text-green-700 mt-4 text-xl font-semibold text-center">Thanh toán dễ dàng</h3>
                    <div class="w-12 h-1 bg-green-500 mx-auto my-2"></div>
                    <p class="text-gray-600 mb-4 text-center">Nhiều hình thức thanh toán tiện lợi giúp khách hàng dễ dàng đặt hàng.</p>
                </div>
            </div>
        </div>


</main>



    </x-layout-site>

