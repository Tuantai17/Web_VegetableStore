<x-layout-site>
    <x-slot:title>Trang chủ</x-slot:title>

    <main>

        {{-- ===================== DANH MỤC NỔI BẬT ===================== --}}
        <section class="container my-12">
            <div class="center mb-6">
                <h2 class="title-green">
                    <span>Danh mục nổi bật</span>
                    <span>🍃</span>
                </h2>
            </div>
            <div class="divider w-1-3 mb-8"></div>

            <div class="featured-grid"> {{-- Danh mục Rau củ --}} 
                <a href="{{ route('site.product.byCategory', ['category_slug' => 'rau']) }}"> 
                    <div class="cat-card"> <img src="{{ asset('asset/image/ao01.web') }}" alt="Bóng chuyền">
                     <div class="overlay"></div> <div class="content"> <span class="title light">Bóng chuyền</span>
                     </div> </div> </a> {{-- Danh mục Trái cây --}} <a href="{{ route('site.product.byCategory', ['category_slug' => 'trai-cay']) }}">
                         <div class="cat-card"> <img src="{{ asset('asset/image/10.webp') }}" alt="Bóng rổ"> <div class="overlay"></div> <div class="content">
                             <span class="title dark">Bóng rổ</span> </div> </div> </a> {{-- Danh mục Nấm --}} 
                             <a href="{{ route('site.product.byCategory', ['category_slug' => 'nam']) }}"> 
                                <div class="cat-card"> <img src="{{ asset('asset/image/ao0.webp') }}" alt="Bóng Đá"> 
                                <div class="overlay"></div> <div class="content"> <span class="title light">Bóng đá</span> </div> </div> </a> </div>
        </section>

       

        {{-- ===================== SẢN PHẨM ===================== --}}
        <x-product-new />
        <x-product-sale />

        {{-- ===================== CSS VÁ LAYOUT (không cần Tailwind) ===================== --}}
        <style>
            /* ---- Reset nhe nhàng / base ---- */
            :root{
                --green-700:#15803d;
                --green-500:#22c55e;
                --slate-800:#0f172a;
            }
            *{box-sizing:border-box}
            img{max-width:100%;height:auto;display:block}

            /* ---- Container & các utility đơn giản ---- */
            .container{max-width:1200px;margin:0 auto;padding:0 16px}
            .my-12{margin:3rem 0}
            .mb-6{margin-bottom:1.5rem}
            .mb-8{margin-bottom:2rem}
            .w-1-3{width:33.333%}

            .center{display:flex;justify-content:center;align-items:center}
            .title-green{
                display:flex;gap:.5rem;align-items:center;justify-content:center;
                font-size:1.875rem;font-weight:700;color:var(--green-700)
            }
            .divider{height:0;border-top:2px solid var(--green-500);margin:0 auto}

            /* ---- Lưới danh mục nổi bật ---- */
            .featured-grid{
                display:grid;gap:2rem;
                grid-template-columns: 1fr;
            }
            @media (min-width:640px){ .featured-grid{ grid-template-columns: repeat(2,1fr);} }
            @media (min-width:768px){ .featured-grid{ grid-template-columns: repeat(3,1fr);} }

            .cat-card{
                position:relative;height:14rem;border-radius:.75rem;overflow:hidden;
                box-shadow:0 10px 25px rgba(0,0,0,.08);
            }
            .cat-card img{
                width:100%;height:100%;object-fit:cover;transform:scale(1);
                transition:transform .5s ease;
            }
            .cat-card:hover img{ transform:scale(1.1); }
            .cat-card .overlay{
                position:absolute;inset:0;
                background:linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(34,197,94,.45) 100%);
                opacity:0;transition:opacity .35s ease;
            }
            .cat-card:hover .overlay{ opacity:.6; }
            .cat-card .content{
                position:absolute;inset:0;display:flex;flex-direction:column;
                align-items:center;justify-content:center;text-align:center;padding:8px;
                pointer-events:none;
            }
            .cat-card .title{
                font-weight:700;letter-spacing:.02em;font-size:1.25rem;
                text-shadow:0 2px 6px rgba(0,0,0,.35);
            }
            .cat-card .title.light{color:#fff}
            .cat-card .title.dark{color:var(--slate-800)}

            /* ---- Chip ---- */
            .chip-wrap{display:flex;flex-wrap:wrap;gap:1rem;justify-content:center;margin-top:2rem}
            .chip{
                background:#dcfce7;color:#166534;font-weight:600;
                padding:.75rem 1.25rem;border-radius:999px;
                box-shadow:0 8px 16px rgba(22,101,52,.12)
            }

            /* ---- Video (tùy chọn) ---- */
            .video-wrap{display:flex;justify-content:center}
            .video-box{
                overflow:hidden;border-radius:1rem;border:4px solid var(--green-600);
                width:100%;max-width:960px;box-shadow:0 15px 35px rgba(0,0,0,.12)
            }
            .video{width:100%;aspect-ratio:16/9;object-fit:cover;border-radius:1rem}

            /* ---- Hiệu ứng nhỏ ---- */
            @keyframes fadeIn{
                from{opacity:0;transform:translateY(20px)}
                to{opacity:1;transform:translateY(0)}
            }
            .animate-fadeIn{animation:fadeIn 1s ease-out forwards}
        </style>
    </main>
</x-layout-site>
