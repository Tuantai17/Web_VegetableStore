<x-layout-site>
    <x-slot:title>
        Trang liên hệ
    </x-slot:title>

<main>
    <div class="w-full px-6 md:px-12 py-12 bg-gray-100">
        <!-- Google Maps -->
        <div class="w-full mb-10 shadow-lg rounded-xl overflow-hidden">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2770.979889561008!2d106.77163904942185!3d10.829873063706733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752701cbacce21%3A0xc55b53936092d0e1!2zS8O9IFTDumMgWMOhIFRyxrDhu51uZyBDYW8gxJDhurNuZyBDw7RuZyBUaMawxqFuZyBUUC5IQ00!5e0!3m2!1svi!2s!4v1742014539771!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>        </div>

        <!-- Container form + thông tin -->
        <div class="flex flex-col md:flex-row md:gap-10">
            <!-- Form liên hệ -->
            <div class="md:w-1/2 bg-white p-8 rounded-xl shadow-md">
                @if (session('success'))
                    <div class="mb-6 text-red-700 bg-red-100 border border-red-400 p-4 rounded font-semibold text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Liên hệ với chúng tôi</h2>

                <form action="{{ route('site.contact.submit') }}" method="POST" class="flex flex-col gap-4">
                    @csrf
                    <input type="text" name="name" placeholder="Họ và tên *" required class="p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    <input type="email" name="email" placeholder="Địa chỉ Email *" required class="p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    <input type="text" name="phone" placeholder="Số điện thoại *" required class="p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    <input type="text" name="title" placeholder="Tiêu đề *" required class="p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    <textarea name="content" placeholder="Viết bình luận *" required class="p-3 border rounded-md h-32 focus:outline-none focus:ring-2 focus:ring-yellow-500"></textarea>

                    <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white py-3 rounded-md font-bold transition duration-300 ease-in-out">
                        GỬI LIÊN HỆ
                    </button>
                </form>
            </div>

            <!-- Thông tin công ty -->
            <div class="md:w-1/2 mt-10 md:mt-0 bg-white p-8 rounded-xl shadow-md">
                <div class="flex items-start gap-4">
                    <img src="{{ asset('asset/image/logo1.jpg') }}" alt="MENDOVER Logo" class="w-24 h-24 object-cover rounded-md">
                    <div>
                        <p class="text-gray-700 mb-4">
                            🌿 Chào mừng bạn đến với cửa hàng rau củ tươi sạch của chúng tôi! 🥕🥦
                            Chúng tôi tự hào mang đến cho bạn những sản phẩm rau củ tươi ngon nhất mỗi ngày từ các nông trại sạch.
                        </p>
                        <ul class="text-gray-600 space-y-1">
                            <li><strong>📍 Địa chỉ:</strong> 103 Tăng Nhơn Phú, Phước Long B, Quận 9, TP.HCM</li>
                            <li><strong>📞 Hotline:</strong> 1900 8750</li>
                            <li><strong>📧 Email:</strong> support@fruit.vn</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</x-layout-site>
