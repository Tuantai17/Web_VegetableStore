<div class="mb-5">
    <h3 class="text-[#c12e37] font-bold uppercase text-2xl">Danh mục</h3>
    <ul>
        @foreach($category_list as $category)
            <li><a href="{{ route('site.product', ['category_slug' => $category->slug]) }}">{{ $category->name }}</a></li>
        @endforeach
    </ul>
</div>