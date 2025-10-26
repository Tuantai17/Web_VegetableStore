<nav class="mainmenu bg-white text-center">
    <div class="container mx-auto px-2 md:px-4">
        <ul class="flex flex-wrap justify-center space-x-4">
            {{-- Thêm mục Home thủ công --}}
            <li class="relative group border-b-4 border-[#f1ce37] hover:border-[#c12e37]">
                <a href="{{ url('/') }}" class="inline-block p-4 text-lg text-black">
                    Home
                </a>
            </li>

            {{-- Chỉ hiển thị mục "Product" từ database --}}
            @foreach ($menu_list as $menu_item)
                @if ($menu_item->name === 'Product')
                    <x-main-menu-item :menuitem="$menu_item" />
                @endif
            @endforeach
        </ul>
    </div>
</nav>
