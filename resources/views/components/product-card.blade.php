<style>
/* ===== Product Card (CSS thuần) ===== */
.product-card {
    border: 1px solid #ddd;
    border-radius: 16px;
    background: #f9f9f9;
    overflow: hidden;
    transition: 0.3s ease;
    box-shadow: 0 4px 8px rgba(0,0,0,0.08);
    max-width: 280px; /* Tuỳ bạn chỉnh */
    margin: auto;
}

.product-card:hover {
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    transform: translateY(-4px);
}

.product-thumb img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform .6s ease;
}

.product-card:hover img {
    transform: scale(1.08);
}

.product-body {
    text-align: center;
    padding: 16px;
    border-top: 1px solid #eee;
}

.product-brand {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 2px;
    color: #888;
    text-transform: uppercase;
    margin: 0;
}

.product-title {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin: 10px 0;
    text-decoration: none;
    display: inline-block;
}

.product-title:hover {
    color: #008d4c;
}

.product-price-box {
    margin: 10px 0;
    font-size: 16px;
}

.product-price {
    color: red;
    font-weight: bold;
}

.product-old-price {
    color: #aaa;
    text-decoration: line-through;
    font-size: 14px;
    margin-left: 6px;
}

.discount-badge {
    display: inline-block;
    padding: 4px 8px;
    background: linear-gradient(to right, #d90429, #ff4d6d);
    color: white;
    font-size: 12px;
    font-weight: bold;
    border-radius: 12px;
}

.save-text {
    font-size: 13px;
    color: #555;
    margin-left: 6px;
}

.save-text span {
    color: red;
    font-weight: 600;
}
</style>

<div class="product-card">
    <div class="product-thumb">
        <a href="{{ route('site.product.detail', ['slug' => $product->slug]) }}">
            <img src="{{ asset('assets/images/product/' . $product->thumbnail) }}" 
                 alt="{{ $product->name }}">
        </a>
    </div>

    <div class="product-body">
        <p class="product-brand">DIAMOND ZONE</p>

        <a href="{{ route('site.product.detail', ['slug' => $product->slug]) }}" class="product-title">
            {{ $product->name }}
        </a>

        <div class="product-price-box">
            @if ($product->price_sale > 0 && $product->price_sale < $product->price_root)
                <span class="product-price">{{ number_format($product->price_sale) }}₫</span>
                <span class="product-old-price">{{ number_format($product->price_root) }}₫</span>
            @else
                <span class="product-price">{{ number_format($product->price_root) }}₫</span>
            @endif
        </div>

        @if ($product->price_sale > 0 && $product->price_sale < $product->price_root)
            @php
                $discountPercent = round((($product->price_root - $product->price_sale) / $product->price_root) * 100);
                $savedAmount = $product->price_root - $product->price_sale;
            @endphp
            <div>
                <span class="discount-badge">-{{ $discountPercent }}%</span>
                <span class="save-text">Tiết kiệm: <span>{{ number_format($savedAmount) }}₫</span></span>
            </div>
        @endif
    </div>
</div>
