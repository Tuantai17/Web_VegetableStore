<div class="mb-5">
    <h3 class="text-[#c12e37] font-bold uppercase text-2xl">Thương hiệu</h3>
    <ul>
        @foreach($brand_list as $brand)
            <li><a href="{{ route('site.product') }}?slug={{ $brand->slug }}">{{ $brand->name }}</a></li>
        @endforeach
    </ul>
</div>