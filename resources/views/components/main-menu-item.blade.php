<li class="relative group border-b-3 border-[#f1ce37] hover:border-[#c12e37]">
    <a href="{{ url($menuitem->link) }}" class="inline-block p-4 text-lg text-black">
        {{ $menuitem->name }}
    </a>

    {{-- Dropdown menu nếu có menu con --}}
    @if ($menuitem->menu->isNotEmpty())
        <ul class="absolute left-0 top-full bg-white shadow-lg hidden group-hover:block z-10 min-w-[150px]">
            @foreach ($menuitem->menu as $child)
                <li class="border-b border-gray-200">
                    <a href="{{ url($child->link) }}" class="block px-4 py-2 text-black hover:bg-gray-100">
                        {{ $child->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</li>
