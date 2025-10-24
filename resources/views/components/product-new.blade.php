<div class="new-products-section">
    <style>
        .new-products-section {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 0;
        }

        /* Tiêu đề với nền gradient + hiệu ứng “pulse” */
        .new-products-title {
            font-size: 28px;
            font-weight: 800;
            text-align: center;
            color: #fff;
            padding: 16px 24px;
            margin-bottom: 48px;
            letter-spacing: .06em;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,.15);
            background: linear-gradient(90deg, #ec4899 0%, #fde047 50%, #a855f7 100%);
            animation: pulseGlow 2s ease-in-out infinite;
        }
        @keyframes pulseGlow {
            0%, 100% { transform: scale(1); box-shadow: 0 10px 25px rgba(0,0,0,.15); }
            50% { transform: scale(1.01); box-shadow: 0 14px 30px rgba(0,0,0,.20); }
        }

        /* Lưới sản phẩm responsive (không Tailwind) */
        .new-products-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 24px;
        }
        @media (min-width: 640px) { /* sm */
            .new-products-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (min-width: 768px) { /* md */
            .new-products-grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media (min-width: 1024px) { /* lg */
            .new-products-grid { grid-template-columns: repeat(4, 1fr); }
        }

        /* Khu vực nút xem thêm */
        .view-all-wrap {
            margin-top: 40px;
            text-align: center;
        }
        .view-all-btn {
            display: inline-block;
            border: 1px solid #1f2937; /* xám đậm */
            color: #1f2937;
            padding: 10px 24px;
            border-radius: 8px;
            background: #fff;
            font-weight: 600;
            transition: background .25s, color .25s, transform .15s;
            cursor: pointer;
        }
        .view-all-btn:hover {
            background: #1f2937;
            color: #fff;
            transform: translateY(-1px);
        }
        .view-all-btn:active {
            transform: translateY(0);
        }
    </style>

    <h1 class="new-products-title">Sản phẩm mới nhất</h1>

    <div class="new-products-grid">
        @foreach ($product_new as $product_item)
            <x-product-card :productitem="$product_item" />
        @endforeach
    </div>

    <div class="view-all-wrap">
        <a href="{{ route('site.product') }}">
            <button type="button" class="view-all-btn">Xem tất cả sản phẩm</button>
        </a>
    </div>
</div>
