<x-layout-site>
    <x-slot:title>{{ isset($category) ? 'Danh mục: ' . $category->name : 'Tất cả sản phẩm' }}</x-slot:title>

    <style>
        /* ====== RESET CƠ BẢN ====== */
        *, *::before, *::after { box-sizing: border-box; }
        html { -webkit-text-size-adjust: 100%; }
        body { margin: 0; font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; color: #111827; background: #f8fafc; }
        img { display: block; max-width: 100%; }

        /* ====== LAYOUT CHUNG ====== */
        .page-main { margin: 40px 0; }
        .container { width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 12px; }
        .section-space { margin-bottom: 40px; }

        /* ====== FORM LỌC ====== */
        .filter-form {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 6px 18px rgba(17, 24, 39, 0.06);
            display: flex; flex-wrap: wrap; gap: 16px; align-items: center;
        }
        .filter-input, .filter-select {
            border: 1px solid #d1d5db; border-radius: 8px;
            padding: 8px 12px; min-width: 150px; outline: none; height: 40px; color: #111827;
        }
        .filter-input:focus, .filter-select:focus { border-color: #10b981; box-shadow: 0 0 0 3px rgba(16,185,129,.15); }
        .filter-actions { display: flex; align-items: center; gap: 10px; }
        .btn {
            display: inline-block; padding: 9px 16px; border-radius: 8px; border: 1px solid transparent;
            font-weight: 600; cursor: pointer; transition: all .2s ease; text-decoration: none;
        }
        .btn-primary { background: #059669; color: #fff; }
        .btn-primary:hover { background: #047857; }
        .btn-link { color: #2563eb; background: transparent; border: none; padding: 0; }
        .btn-link:hover { text-decoration: underline; }

        /* ====== TIÊU ĐỀ & HỘP “ĐANG LỌC” ====== */
        .title-wrap { margin-bottom: 16px; }
        .page-title { font-size: 24px; font-weight: 700; margin: 0 0 8px; color: #1f2937; }
        .filter-chipbox {
            background: #ecfdf5; border: 1px solid #86efac; color: #065f46;
            padding: 16px; border-radius: 14px; box-shadow: 0 8px 22px rgba(16,185,129,0.12);
            font-size: 14px;
        }
        .filter-chipbox h2 {
            margin: 0 0 10px; font-weight: 800; color: #064e3b; display: flex; align-items: center; gap: 8px; font-size: 16px;
        }
        .filter-chipbox ul { margin: 0; padding-left: 18px; }
        .filter-chipbox li { margin: 6px 0; }

        /* ====== LƯỚI SẢN PHẨM ====== */
        .product-grid {
            display: grid; grid-template-columns: 1fr; gap: 20px;
        }
        @media (min-width: 640px) { .product-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (min-width: 768px) { .product-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (min-width: 1024px){ .product-grid { grid-template-columns: repeat(4, 1fr); } }

        .product-card {
            background: #fff; border: 1px solid #f3f4f6; border-radius: 12px; overflow: hidden;
            box-shadow: 0 4px 14px rgba(17, 24, 39, 0.06);
            transition: box-shadow .25s ease, transform .25s ease;
        }
        .product-card:hover { box-shadow: 0 12px 28px rgba(17, 24, 39, 0.12); transform: translateY(-2px); }
        .product-thumb { width: 100%; height: 190px; object-fit: cover; background: #f9fafb; }
        .product-body { padding: 16px; text-align: center; }
        .product-name { margin: 0 0 6px; font-size: 16px; font-weight: 700; color: #111827; }
        .price-row { display: flex; justify-content: center; align-items: center; gap: 8px; margin: 8px 0 10px; }
        .price-sale { color: #ef4444; font-weight: 800; font-size: 18px; }
        .price-old { color: #9ca3af; text-decoration: line-through; font-size: 13px; }
        .price-regular { color: #374151; font-weight: 800; font-size: 18px; }

        .product-desc {
            color: #6b7280; font-size: 14px; line-height: 1.5;
            height: 40px; overflow: hidden;
        }
        .btn-detail {
            margin-top: 12px; display: inline-block; background: #ec4899; color: #fff;
            padding: 8px 18px; border-radius: 999px; font-weight: 600; transition: background .2s;
            text-decoration: none;
        }
        .btn-detail:hover { background: #db2777; }

        /* ====== PHÂN TRANG (tương thích mặc định Laravel) ====== */
        nav[role="navigation"] { margin-top: 28px; display: flex; justify-content: center; }
        nav[role="navigation"] > div { display: inline-flex; flex-wrap: wrap; gap: 6px; }
        nav[role="navigation"] a,
        nav[role="navigation"] span {
            display: inline-flex; align-items: center; justify-content: center;
            height: 36px; min-width: 36px; padding: 0 12px; border-radius: 8px;
            border: 1px solid #e5e7eb; color: #374151; background: #fff; text-decoration: none; font-size: 14px;
        }
        nav[role="navigation"] a:hover { background: #f3f4f6; }
        nav[role="navigation"] span[aria-current="page"] {
            background: #111827; color: #fff; border-color: #111827;
        }

        /* ====== TIỆN ÍCH RỜI (icon + list) ====== */
        .inline-icon { width: 20px; height: 20px; color: #10b981; }
        .list-reset { margin: 0; padding: 0; list-style: none; }
    </style>

    <main class="page-main">
        <!-- FORM LỌC -->
        <section class="section-space">
            <form
                method="GET"
                action="{{ isset($category) ? route('site.product.byCategory', $category->slug) : route('site.product') }}"
                class="filter-form"
            >
                <!-- Giá từ -->
                <input
                    type="number"
                    name="min_price"
                    placeholder="Giá từ"
                    value="{{ request('min_price') }}"
                    class="filter-input"
                />

                <!-- Giá đến -->
                <input
                    type="number"
                    name="max_price"
                    placeholder="Đến"
                    value="{{ request('max_price') }}"
                    class="filter-input"
                />

                <!-- Danh mục -->
                <select name="category" class="filter-select" style="min-width:200px;">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach ($category_list as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Thương hiệu -->
                <select name="brand" class="filter-select" style="min-width:200px;">
                    <option value="">-- Chọn thương hiệu --</option>
                    @foreach ($brand_list as $brand)
                        <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Actions -->
                <div class="filter-actions">
                    <button type="submit" class="btn btn-primary">Lọc</button>

                    <a
                        href="{{ isset($category) ? route('site.product.byCategory', $category->slug) : route('site.product') }}"
                        class="btn-link"
                        title="Đặt lại bộ lọc"
                    >
                        Đặt lại
                    </a>
                </div>
            </form>
        </section>

        <!-- DANH SÁCH SẢN PHẨM -->
        <div class="container">
            <div style="width:100%;">
                <div class="title-wrap">
                    <h1 class="page-title">
                        {{ isset($category) ? 'Danh mục: ' . $category->name : 'Tất cả sản phẩm' }}
                    </h1>

                    @php
                        $filters = [];
                        if (request('min_price') || request('max_price')) {
                            $min = number_format(request('min_price') ?? 0);
                            $max = number_format(request('max_price') ?? 0);
                            $filters[] = "Giá từ {$min}₫ đến {$max}₫";
                        }
                        if (request('category')) {
                            $cat = $category_list->firstWhere('id', request('category'));
                            if ($cat) $filters[] = "Danh mục: " . $cat->name;
                        }
                        if (request('brand')) {
                            $brand = $brand_list->firstWhere('id', request('brand'));
                            if ($brand) $filters[] = "Thương hiệu: " . $brand->name;
                        }
                    @endphp

                    @if (count($filters))
                        <div class="filter-chipbox">
                            <h2>
                                <!-- icon -->
                                <svg class="inline-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zM3 16a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" />
                                </svg>
                                Đang lọc theo:
                            </h2>
                            <ul>
                                @foreach ($filters as $f)
                                    <li>{{ $f }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- GRID SẢN PHẨM -->
                <div class="product-grid">
                    @forelse ($products as $product)
                        <div class="product-card">
                            <img
                                src="{{ asset('assets/images/product/' . $product->thumbnail) }}"
                                class="product-thumb"
                                alt="{{ $product->name }}"
                                onerror="this.src='{{ asset('assets/images/product/placeholder.png') }}';"
                            >
                            <div class="product-body">
                                <h2 class="product-name">{{ $product->name }}</h2>

                                <div class="price-row">
                                    @if ($product->price_sale > 0 && $product->price_sale < $product->price_root)
                                        <span class="price-sale">{{ number_format($product->price_sale) }}₫</span>
                                        <span class="price-old">{{ number_format($product->price_root) }}₫</span>
                                    @else
                                        <span class="price-regular">{{ number_format($product->price_root) }}₫</span>
                                    @endif
                                </div>

                                <p class="product-desc">
                                    {{ \Illuminate\Support\Str::limit($product->description, 50) }}
                                </p>

                                <a href="{{ route('site.product.detail', $product->slug) }}" class="btn-detail">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    @empty
                        <p style="grid-column: 1 / -1; text-align:center; color:#6b7280;">
                            Không có sản phẩm phù hợp.
                        </p>
                    @endforelse
                </div>

                <!-- PHÂN TRANG -->
                <div style="margin-top: 28px; display:flex; justify-content:center;">
                    {{ $products->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </main>
</x-layout-site>
