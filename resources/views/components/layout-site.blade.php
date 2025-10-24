<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
  <title>{{ $title ?? 'Shop Thanh Thảo'}}</title>

  {{-- Bạn có thể giữ @vite nếu cần JS/CSS khác; layout này không phụ thuộc Tailwind --}}
  @vite(['resources/js/app.js'])

  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

  <style>
    :root{
      --bg: #e5f6ea;
      --white:#fff;
      --text:#1f2937;
      --muted:#6b7280;
      --green:#16a34a;
      --green-600:#059669;
      --green-700:#047857;
      --red:#ef4444;
      --border:#e5e7eb;
      --shadow:0 6px 18px rgba(0,0,0,.06);
      --radius:14px;
      --gap:18px;
      --container:1200px;
    }
    /* Reset nhẹ */
    *{box-sizing:border-box}
    html,body{margin:0;padding:0;background:var(--bg);color:var(--text);font:400 15px/1.6 system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,'Helvetica Neue',Arial}
    img{max-width:100%;display:block}
    a{color:inherit;text-decoration:none}
    button{font:inherit;cursor:pointer}
    .container{max-width:var(--container);margin:auto;padding:0 20px}
    .hide{display:none!important}

    /* Header ----------------------------------------------------*/
    header{background:var(--white);box-shadow:var(--shadow);position:sticky;top:0;z-index:40}
    .head-wrap{display:flex;align-items:center;gap:18px;padding:14px 0}
    .brand{display:flex;align-items:center;gap:10px;min-width:110px}
    .brand img{width:68px;height:68px;border-radius:12px;object-fit:cover}
    .search{flex:1;position:relative}
    .search input{
      width:100%;height:42px;border:1px solid var(--border);border-radius:999px;
      padding:0 44px 0 44px;outline:none;transition:.2s;
    }
    .search input:focus{border-color:var(--green)}
    .search .ico{
      position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--muted)
    }
    .top-actions{display:flex;align-items:center;gap:10px;margin-left:auto}
    .pill{
      display:inline-flex;align-items:center;gap:8px;border:1px solid var(--green-600);
      color:var(--green-600);background:var(--white);padding:8px 12px;border-radius:999px;
      font-weight:600;white-space:nowrap
    }
    .icon-btn{
      position:relative;display:grid;place-items:center;width:38px;height:38px;
      border:1px solid var(--green-600);color:var(--green-600);
      border-radius:999px;background:var(--white)
    }
    .badge{
      position:absolute;right:-6px;top:-6px;min-width:18px;height:18px;padding:0 6px;
      display:grid;place-items:center;border-radius:999px;background:var(--red);color:#fff;
      font-size:11px;font-weight:700
    }

    /* Dropdown tài khoản */
    .account{position:relative}
    .account-btn{border:1px solid var(--green-600);color:var(--green-600);background:#fff;border-radius:999px;padding:8px 14px;font-weight:600}
    .dropdown{
      position:absolute;right:0;top:calc(100% + 8px);width:280px;background:#fff;border:1px solid var(--border);
      border-radius:12px;box-shadow:var(--shadow);padding:14px;z-index:50
    }
    .dropdown a{color:#2563eb}
    .dropdown a:hover{text-decoration:underline}

    /* Banner ----------------------------------------------------*/
    .banner{display:grid;grid-template-columns:2fr 1fr;gap:var(--gap);margin:18px auto}
    .slider{position:relative;overflow:hidden;border-radius:var(--radius);height:400px;background:#f8fafc}
    .slides{display:flex;height:100%;transition:transform .6s ease}
    .slide{min-width:100%;height:100%}
    .slide img{width:100%;height:100%;object-fit:cover}
    .nav-btn{
      position:absolute;top:50%;transform:translateY(-50%);border:none;background:#fff;
      width:34px;height:34px;border-radius:999px;box-shadow:var(--shadow)
    }
    .nav-btn.prev{left:10px} .nav-btn.next{right:10px}
    .ads{display:grid;grid-template-rows:1fr 1fr;gap:var(--gap)}
    .ads img{height:100%;object-fit:cover;border-radius:var(--radius)}

    /* Main menu slot wrapper */
    .slot-wrap{margin:16px 0}

    /* Footer ----------------------------------------------------*/
    footer{background:#535e55;color:#fff;margin-top:40px}
    .ft{display:grid;grid-template-columns:2fr 1.2fr 1fr 1fr 1fr;gap:22px;padding:40px 0}
    .ft h3{margin:0 0 10px;font-weight:700}
    .pay{display:flex;gap:8px}
    .quick-links ul{list-style:none;padding:0;margin:8px 0 0;display:grid;gap:8px}
    .quick-links a{color:#fff} .quick-links a:hover{color:#f472b6}
    .ig{display:grid;grid-template-columns:repeat(3,1fr);gap:6px}
    .ig img{width:100%;height:70px;border-radius:8px;object-fit:cover;transition:transform .2s}
    .ig img:hover{transform:scale(1.05)}

    /* Helpers for product sections that dùng Tailwind trước đây */
    .product-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px}
    .product-card{background:#fff;border:1px solid var(--border);border-radius:12px;box-shadow:var(--shadow);overflow:hidden}
    .product-card .body{padding:12px}
    .product-card .title{font-weight:600;margin:6px 0}
    .product-card .price{color:var(--green-700);font-weight:700}

    /* Responsive -----------------------------------------------*/
    @media (max-width:1024px){
      .banner{grid-template-columns:1fr}
      .ads{grid-template-rows:180px 180px}
      .slider{height:300px}
      .ft{grid-template-columns:1fr 1fr}
    }
    @media (max-width:640px){
      .head-wrap{flex-wrap:wrap}
      .brand{order:1}
      .search{order:3;width:100%}
      .top-actions{order:2}
      .slider{height:220px}
      .ft{grid-template-columns:1fr}
      .product-grid{grid-template-columns:repeat(2,1fr)}
    }
  </style>
  {{ $header ?? ''}}
</head>
<body>

  <!-- HEADER -->
  <header>
    <div class="container">
      <div class="head-wrap">
        <div class="brand">
          <img src="{{ asset('asset/image/logo1.jpg') }}" alt="Logo">
        </div>

        <form action="{{ route('site.product.search') }}" method="GET" class="search">
          <i class="fa-solid fa-magnifying-glass ico"></i>
          <input type="search" name="keyword" placeholder="Tìm kiếm sản phẩm...">
        </form>

        <div class="top-actions">
          <div class="pill">
            <i class="fa-solid fa-phone"></i>
            <span>Hotline: 1900 6750</span>
          </div>

          {{-- Tài khoản --}}
          <div class="account">
            <button type="button" class="account-btn" id="btnAccount">
              <i class="fa-regular fa-user" style="margin-right:8px"></i>
              {{ Auth::check() ? Auth::user()->name : 'Tài khoản' }}
            </button>

            <div class="dropdown hide" id="accountDrop">
              @auth
                <div style="margin-bottom:8px;">
                  <div style="font-weight:700;margin-bottom:6px">Thông tin tài khoản</div>
                  <div><b>Tên:</b> {{ Auth::user()->name }}</div>
                  <div><b>Email:</b> {{ Auth::user()->email }}</div>
                </div>
                <a href="{{ route('user.account') }}">Xem chi tiết tài khoản</a><br>
                <a href="#" onclick="document.getElementById('logout-form').submit();return false;" style="color:#dc2626">Đăng xuất</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hide">@csrf</form>
              @else
                <a href="{{ route('site.login') }}">Đăng nhập</a><br>
                <a href="{{ route('user.register.form') }}">Đăng ký</a>
              @endauth
            </div>
          </div>

          {{-- Địa chỉ --}}
          <a class="icon-btn" href="https://www.google.com/maps/place/S%E1%BB%9F+T%C3%A0i+Nguy%C3%AAn+V%C3%A0+M%C3%B4i+Tr%C6%B0%E1%BB%9Dng+TP.HCM/@10.8298731,106.771639,17z"
             target="_blank" rel="noopener">
            <i class="fa-solid fa-location-dot"></i>
            <span class="badge">8</span>
          </a>

          {{-- Yêu thích --}}
          <div class="icon-btn">
            <i class="fa-regular fa-heart"></i>
            <span class="badge">0</span>
          </div>

          {{-- Giỏ hàng --}}
          <a class="icon-btn" href="{{ route('site.cart') }}">
            <i class="fa-solid fa-cart-shopping"></i>
            <span class="badge">{{ session('cart') ? count(session('cart')) : 0 }}</span>
          </a>
        </div>
      </div>
    </div>
  </header>

  <!-- BANNER (Slider + Ads) -->
  <div class="container banner">
    <div class="slider" id="slider">
      <div class="slides" id="slides">
        <div class="slide"><img src="{{ asset('asset/image/baner.jpeg') }}" alt=""></div>
        <div class="slide"><img src="{{ asset('asset/image/banner2.webp') }}" alt=""></div>
      </div>
      <button class="nav-btn prev" id="prev" aria-label="Prev"><i class="fa-solid fa-angle-left"></i></button>
      <button class="nav-btn next" id="next" aria-label="Next"><i class="fa-solid fa-angle-right"></i></button>
    </div>
    <div class="ads">
      <img src="{{ asset('asset/image/baner2.jpg') }}" alt="">
      <img src="{{ asset('asset/image/banner11.webp') }}" alt="">
    </div>
  </div>

  <!-- MAIN MENU -->
  <div class="container slot-wrap">
    <x-main-menu/>
  </div>

  <!-- PAGE CONTENT -->
  <main class="container">
    {{ $slot }}
  </main>

  <!-- FOOTER -->
  <footer>
    <div class="container ft">
      <div>
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px">
          <img src="{{ asset('asset/image/logo-ft.webp') }}" style="width:68px;height:34px;object-fit:contain">
          <span style="font-size:20px;font-weight:700">thể thao</span>
        </div>
        <p style="margin:0 0 10px;font-size:14px;opacity:.9">Thời trang hiện đại.</p>
        <div class="pay">
          <img src="{{ asset('asset/image/payment_1.webp') }}" style="height:20px">
          <img src="{{ asset('asset/image/payment_2.webp') }}" style="height:20px">
          <img src="{{ asset('asset/image/payment_3.webp') }}" style="height:20px">
        </div>
      </div>

      <div class="quick-links">
        <h3>Liên Kết Nhanh</h3>
        <ul>
          <li><a href="{{ url('/') }}">Trang Chủ</a></li>
          <li><a href="{{ url('/about') }}">Giới Thiệu</a></li>
          <li><a href="{{ url('/sanp-pham') }}">Sản Phẩm</a></li>
          <li><a href="{{ url('/lien-he') }}">Liên Hệ</a></li>
        </ul>
      </div>

      <div>
        <h3>Chính Sách</h3>
        <ul style="list-style:none;padding:0;margin:8px 0 0;display:grid;gap:6px;font-size:14px">
          <li>Chính sách thành viên</li>
          <li>Hướng dẫn mua hàng</li>
          <li>Bảo mật thông tin</li>
        </ul>
      </div>

      <div>
        <h3>Thông Tin</h3>
        <ul style="list-style:none;padding:0;margin:8px 0 0;display:grid;gap:6px;font-size:14px">
          <li>Địa chỉ: 70 Lữ Gia, Q.11, TP.HCM</li>
          <li>Điện thoại: 1900 6750</li>
          <li>Email: support@sapo.vn</li>
        </ul>
      </div>

      <div>
        <h3>Instagram</h3>
        <div class="ig">
          <img src="{{ asset('asset/image/intagam.webp') }}">
          <img src="{{ asset('asset/image/intagam1.webp') }}">
          <img src="{{ asset('asset/image/intagam3.jpeg') }}">
        </div>
      </div>
    </div>
    {{ $footer ?? '' }}
  </footer>

  <script>
    // Dropdown tài khoản
    const btnAccount = document.getElementById('btnAccount');
    const accountDrop = document.getElementById('accountDrop');
    if (btnAccount){
      btnAccount.addEventListener('click', (e) => {
        e.stopPropagation();
        accountDrop.classList.toggle('hide');
      });
      document.addEventListener('click', (e)=>{
        if (!accountDrop.contains(e.target) && !btnAccount.contains(e.target)){
          accountDrop.classList.add('hide');
        }
      });
    }

    // Slider đơn giản
    const slides = document.getElementById('slides');
    const prev = document.getElementById('prev');
    const next = document.getElementById('next');
    let idx = 0, total = slides.children.length;

    function go(i){
      idx = (i + total) % total;
      slides.style.transform = `translateX(-${idx*100}%)`;
    }
    prev.addEventListener('click', ()=>go(idx-1));
    next.addEventListener('click', ()=>go(idx+1));
    setInterval(()=>go(idx+1), 4000);
  </script>
</body>
</html>
