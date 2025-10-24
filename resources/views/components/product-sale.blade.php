<div class="product-sale-section">
    <style>
        .product-sale-section {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 0;
        }
        .product-sale-title {
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 32px;
        }
        .product-sale-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 24px;
        }
        .view-all-btn {
            display: inline-block;
            border: 1px solid #333;
            color: #333;
            padding: 10px 24px;
            border-radius: 6px;
            transition: .3s;
            cursor: pointer;
            background: white;
            font-weight: 500;
        }
        .view-all-btn:hover {
            background: #333;
            color: #fff;
        }
    </style>

    <h3 class="product-sale-title">Sản phẩm giảm giá</h3>

    <div class="product-sale-grid">
        @foreach ($product_sale as $product_item)
            <x-product-card :productitem="$product_item" />
        @endforeach
    </div>

    <div style="margin-top: 40px; text-align:center;">
        <a href="{{ route('site.product') }}">
            <button type="button" class="view-all-btn">
                Xem tất cả sản phẩm
            </button>
        </a>
    </div>
</div>
