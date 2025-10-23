@extends('layouts.app')

@section('title', 'Bodycare — Beauté Verse')

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400;1,600&display=swap" rel="stylesheet">
    <style>
    :root{--bg:linear-gradient(180deg,#fffafe,#fff7fb);--text:#3a2e3f;--muted:#b6a7c3;--rose:#ff7ab8;--pink:#ffd1e6;--pill:#fff0f7;--card:#ffffff;--shadow:0 20px 50px rgba(255,182,216,.25);--container:1200px;--radius:24px}
    *{box-sizing:border-box}
    html,body{margin:0;background:var(--bg);color:var(--text);font:16px/1.5 'Inter',system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif}
    a{color:inherit;text-decoration:none}
    .container{max-width:var(--container);margin-inline:auto;padding-inline:20px}
    .topbar{display:flex;align-items:center;gap:20px;padding:20px;position:sticky;top:0;background:var(--bg);z-index:100;box-shadow:0 2px 8px rgba(0,0,0,.05);width:100%}
    .logo{font-family:'Playfair Display',serif;font-weight:600;letter-spacing:.5px}
    .logo a{font-size:30px}
    .search{flex:1;display:flex;align-items:center;gap:10px}
    .search input{flex:1;padding:12px 16px;border:1px solid #e5e7eb;border-radius:999px;outline:none}
    .search input:focus{border-color:#d1d5db;box-shadow:0 0 0 4px rgba(0,0,0,.04)}
    .actions{display:flex;align-items:center;gap:16px}
    .login{font-weight:600;cursor:pointer}
    .login b{color:var(--rose)}
    .cart{position:relative;display:inline-block;padding:10px;border-radius:999px;border:1px solid #eee;cursor:pointer}
    .badge{position:absolute;top:-6px;right:-6px;background:var(--rose);color:#fff;font-size:11px;line-height:1;padding:4px 6px;border-radius:999px}
    .nav{display:flex;gap:18px;overflow:auto;padding:10px 0 16px;max-width:var(--container);margin-inline:auto;padding-inline:20px}
    .nav a{display:flex;align-items:center;gap:10px;background:transparent;padding:8px 14px;border-radius:999px;white-space:nowrap;font-weight:600;font-family:'Playfair Display',serif;font-size:20px;letter-spacing:.4px;transition:box-shadow .25s ease, background .25s ease, transform .25s ease;}
    .nav a:hover{box-shadow:0 0 8px rgba(255,255,255,.25);background:rgba(255,255,255,.12);transform:translateY(-1px);}
    .nav .icon{width:28px;height:28px;border-radius:50%;background:linear-gradient(180deg,#ffd1dc,#ffb2d6);display:flex;align-items:center;justify-content:center;}

  /* Flash sale */
  .flash-sale-section{background:url('{{ asset('background.jpeg') }}') center/cover;padding:60px 20px;position:relative;overflow:hidden;min-height:400px}
  .flash-sale-header{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:30px;max-width:1200px;margin-left:auto;margin-right:auto}
  .flash-sale-title{display:flex;align-items:center;gap:15px}
  .flash-title-img{height:170px;width:auto}
  .see-all-btn{background-color:#FF1493;color:white;border:none;padding:10px 24px;border-radius:6px;cursor:pointer;font-weight:600;font-size:14px;transition:all .3s ease}
  .see-all-btn:hover{background-color:#FF69B4;transform:translateY(-2px);box-shadow:0 4px 12px rgba(255,20,147,.3)}
  .carousel-container{max-width:1200px;margin:0 auto;position:relative;padding:0 20px}
  .carousel-wrapper{position:relative;overflow:hidden;padding:0 60px}
  .carousel{display:flex;gap:20px;overflow-x:auto;scroll-behavior:smooth;padding:20px 0;scroll-snap-type:x mandatory}
  .carousel::-webkit-scrollbar{height:6px}
  .carousel::-webkit-scrollbar-track{background:#f1f1f1;border-radius:10px}
  .carousel::-webkit-scrollbar-thumb{background:#FF1493;border-radius:10px}
  .carousel-btn{position:absolute;top:50%;transform:translateY(-50%);background-color:rgba(255,255,255,.9);border:2px solid #FF1493;width:40px;height:40px;border-radius:4px;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:20px;color:#FF1493;transition:all .3s ease;z-index:10;font-weight:bold}
  .carousel-btn:hover{background-color:#FF1493;color:white;box-shadow:0 4px 12px rgba(255,20,147,.3)}
  .carousel-btn.prev{left:0}
  .carousel-btn.next{right:0}

  /* Product cards */
  .product-card{flex:0 0 calc(20% - 16px);min-width:200px;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.1);transition:all .3s ease;scroll-snap-align:start;position:relative;cursor:pointer;display:flex;flex-direction:column}
  .product-card:hover{transform:translateY(-8px);box-shadow:0 8px 20px rgba(0,0,0,.15)}
  .product-image{width:100%;height:200px;background:linear-gradient(135deg,#f5f5f5 0%,#e0e0e0 100%);display:flex;align-items:center;justify-content:center;font-size:12px;color:#999;position:relative}
  /* match Makeup: fill the card area and crop if necessary so the image looks consistent */
  .product-image img{width:100%;height:100%;object-fit:cover}
  .discount-badge{position:absolute;top:12px;left:12px;background-color:#FF1493;color:white;padding:6px 10px;border-radius:4px;font-weight:bold;font-size:12px}

  /* Compact flash sale badge (match Loveshine card): small pill inside image */
  .product-image .discount-badge,
  .explore-product-image .discount-badge,
  .mini-image .discount-badge {
    top:10px; left:10px; position:absolute; background:#ff1493; color:#fff; font-weight:700; font-size:13px; padding:6px 8px; border-radius:10px; box-shadow:0 6px 16px rgba(255,20,147,.12);
  }
  .product-info{padding:16px;display:flex;flex-direction:column;flex:1}
  .product-badge{display:inline-block;background-color:#FFE4E1;color:#FF1493;padding:4px 12px;border-radius:20px;font-size:11px;font-weight:600;margin-bottom:8px;text-transform:uppercase}
  .product-name{font-size:14px;font-weight:600;color:#333;margin-bottom:8px;line-height:1.4}
  .product-brand{font-size:12px;color:#999;margin-bottom:8px}
  .product-price{font-size:14px;font-weight:700;color:#10b981;margin-bottom:8px}
  .price-original{font-size:12px;color:#999;text-decoration:line-through;margin-left:8px}
  .add-to-cart-btn{width:100%;background:linear-gradient(135deg,#FF1493 0%,#FF69B4 100%);color:white;border:none;padding:10px;border-radius:6px;cursor:pointer;font-weight:600;font-size:12px;transition:all .3s ease;margin-top:auto}
  .add-to-cart-btn:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(255,20,147,.3)}

  /* Category tabs */
  .category-section{background-color:#fff;padding:50px 20px;max-width:1200px;margin:0 auto}
  .category-tabs{list-style:none;display:flex;justify-content:space-around;border-bottom:2px solid #eee;margin-bottom:25px;flex-wrap:wrap;gap:10px}
  .category-tabs li{font-weight:600;font-size:16px;color:#666;cursor:pointer;padding:10px 5px;position:relative;transition:all .3s}
  .category-tabs li.active{color:#ff1493}
  .category-tabs li.active::after{content:"";position:absolute;left:0;bottom:-2px;width:100%;height:3px;background:linear-gradient(135deg,#FF1493 0%,#FF69B4 100%);border-radius:2px}
  .category-carousel{position:relative}
  .category-carousel .carousel{display:flex;overflow-x:auto;scroll-behavior:smooth;gap:16px;padding:10px 0;scroll-snap-type:x mandatory}
  .category-carousel .carousel::-webkit-scrollbar{height:6px}
  .category-carousel .carousel::-webkit-scrollbar-thumb{background:#FF1493;border-radius:10px}
  .mini-card{flex:0 0 calc(20% - 16px);background:white;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.08);overflow:hidden;scroll-snap-align:start;transition:all .3s;cursor:pointer}
  .mini-card:hover{transform:translateY(-5px);box-shadow:0 6px 15px rgba(255,20,147,.2)}
  .mini-image{width:100%;height:120px;background:#f4f4f4;display:flex;align-items:center;justify-content:center;color:#aaa;font-size:12px}
  .mini-info{padding:10px;text-align:center}
  .mini-name{font-size:13px;font-weight:600;color:#333;line-height:1.4;margin-bottom:4px}
  .mini-price{font-size:13px;font-weight:700;color:#10b981}

  /* Free gifts */
  .free-gifts-section{padding:60px 20px;background-color:white;max-width:1200px;margin:0 auto}
  .section-title{font-size:28px;font-weight:700;color:#333;margin-bottom:40px;text-align:left}
  .gifts-grid{display:grid;grid-template-columns:repeat(6,1fr);gap:24px;margin-bottom:40px}
  .gift-card{background:white;border-radius:16px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.1);transition:all .3s ease;cursor:pointer;height:300px}
  .gift-card:hover{transform:translateY(-8px);box-shadow:0 12px 30px rgba(255,20,147,.3)}
  .gift-image{width:100%;height:100%;background:linear-gradient(135deg,#f5f5f5 0%,#e0e0e0 100%);display:flex;align-items:center;justify-content:center;color:#999;font-size:12px}

  /* Explore */
  .explore-section{background:linear-gradient(135deg,#ffedf0 0%,#FFC0CB 100%);padding:60px 20px}
  .explore-container{max-width:1200px;margin:0 auto}
  .explore-title{font-size:28px;font-weight:700;color:#333;margin-bottom:40px}
  .products-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:20px;margin-bottom:40px}
  .explore-product-card{background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.1);transition:all .3s ease;position:relative;cursor:pointer}
  .explore-product-card:hover{transform:translateY(-8px);box-shadow:0 8px 20px rgba(0,0,0,.15)}
  .explore-product-image{width:100%;height:230px;background:#fff;display:flex;align-items:center;justify-content:center;font-size:12px;color:#999;position:relative}
  /* match Makeup explore cards: fill area and keep consistent crop */
  .explore-product-image img{width:100%;height:100%;object-fit:cover}
  .explore-product-brand{font-size:12px;color:#999;margin-bottom:6px}
  .explore-product-info{padding:12px;display:flex;flex-direction:column;flex:1}
  /* hide badges everywhere by default; only show inside flash-sale-section */
  .product-badge, .explore-product-badge { display:none }

  /* show flash sale badges inside the flash sale section */
  .flash-sale-section .product-badge,
  .flash-sale-section .explore-product-badge,
  .flash-sale-section .product-info .product-badge { display:inline-block; background-color:#FFE4E1;color:#FF1493;padding:4px 12px;border-radius:20px;font-size:11px;font-weight:600;margin-bottom:8px;text-transform:uppercase }
  .explore-product-name{font-size:12px;font-weight:600;color:#333;margin-bottom:6px;line-height:1.3}
  .explore-product-price{font-size:12px;font-weight:700;color:#10b981;margin-top:auto}

  /* Footer */
  .footer-section{background-color:white;padding:60px 20px;border-top:1px solid #f0f0f0}
  .footer-container{max-width:1200px;margin:0 auto}
  .footer-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:40px;text-align:center}
  .footer-item{display:flex;flex-direction:column;align-items:center;gap:16px}
  .footer-icon{width:60px;height:60px;border:2px solid #FF1493;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:28px;color:#FF1493}
  .footer-title{font-size:16px;font-weight:700;color:#333}
  .footer-description{font-size:13px;color:#666;line-height:1.6}

  /* Modal */
  .modal{display:none;position:fixed;z-index:1000;left:0;top:0;width:100%;height:100%;background-color:rgba(0,0,0,.5)}
  .modal-content{background-color:#fefefe;margin:5% auto;padding:30px;border-radius:12px;width:90%;max-width:600px;max-height:80vh;overflow-y:auto}
  .modal-close{color:#aaa;float:right;font-size:28px;font-weight:bold;cursor:pointer}
  .modal-close:hover{color:#000}
.modal-product-image {
  width: 100%;
  height: 300px;
  background: #fff;
  border-radius: 12px;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #999;
}
.modal-product-image img {
  max-width: 130%;
  max-height: 130%;
  object-fit: contain; /* Untuk menjaga aspect ratio */
  border-radius: 12px;
} .modal-product-title{font-size:24px;font-weight:700;color:#333;margin-bottom:8px}
  .modal-product-brand{font-size:14px;color:#999;margin-bottom:16px}
  .modal-product-price{font-size:20px;font-weight:700;color:#10b981;margin-bottom:16px}
  .modal-product-desc{font-size:14px;color:#666;line-height:1.6;margin-bottom:20px}
  .modal-add-btn{width:100%;background:linear-gradient(135deg,#FF1493 0%,#FF69B4 100%);color:white;border:none;padding:14px;border-radius:8px;cursor:pointer;font-weight:600;font-size:16px;transition:all .3s ease}
  .modal-add-btn:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(255,20,147,.3)}

  .hidden{display:none}

  @media (max-width:1024px){
    .products-grid{grid-template-columns:repeat(4,1fr)!important}
    .product-card{flex:0 0 calc(25% - 15px)!important}
    .gifts-grid{grid-template-columns:repeat(3,1fr)}
  }
  @media (max-width:768px){
    .products-grid{grid-template-columns:repeat(3,1fr)!important}
    .product-card{flex:0 0 calc(33.333% - 14px)!important}
    .gifts-grid{grid-template-columns:repeat(2,1fr)}
    .footer-grid{grid-template-columns:1fr;gap:30px}
    .mini-card{flex:0 0 calc(33.333% - 10px)}
    .mini-image{height:100px}
    .category-tabs li{font-size:14px}
  }
  @media (max-width:480px){
    .products-grid{grid-template-columns:repeat(2,1fr)!important}
    .product-card{flex:0 0 calc(50% - 10px)!important}
    .section-title,.explore-title{font-size:20px}
    .carousel-btn{display:none}
    .mini-card{flex:0 0 calc(50% - 10px)}
    .gifts-grid{grid-template-columns:repeat(2,1fr)}
  }
</style>
@endpush

@section('content')
  <header class="topbar">
    <div class="logo"><a href="{{ url('/') }}">Beauté Verse</a></div>
    <div class="search">
      <input type="text" id="searchInput" placeholder="Cari produk makeup..." aria-label="Search products" />
    </div>
    <div class="actions">
      <a href="#" class="login" id="openLogin">LOGIN WITH <b>BEAUTÉ ID</b></a>
      <a href="#" class="cart" id="openCart" aria-label="Cart">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
        <span class="badge">0</span>
      </a>
    </div>
  </header>
  <div style="border-bottom:1px solid rgba(255,122,184,0.3);width:100%;height:1px;margin-bottom:10px"></div>

  <nav class="nav" aria-label="Main navigation">
    <a href="{{ url('/makeup') }}"><span class="icon">💄</span>Makeup</a>
    <a href="{{ url('/skincare') }}"><span class="icon">✨</span>Skincare</a>
    <a href="{{ url('/bodycare') }}"><span class="icon">🧴</span>Bodycare</a>
  </nav>

<!-- FLASH SALE -->
<section class="flash-sale-section">
  <div class="flash-sale-header">
    <div class="flash-sale-title">
      <img src="{{ asset('images/flashsale.png') }}" alt="Flash Sale" class="flash-title-img"/>
    </div>
  </div>
  <div class="carousel-container">
    <div class="carousel-wrapper">
      <div class="carousel" id="flashSaleCarousel">
        <!-- 10 products -->
        <div class="product-card" onclick="openModal(0)">
          <div class="product-image"><img src="{{ asset('images/image41.jpg') }}" alt="product"></div>
          <div class="discount-badge">35%</div>
          <div class="product-info">
            <div class="product-badge">Flash Sale</div>
            <div class="product-name">Shea Body Butter</div>
            <div class="product-brand">The Body Shop</div>
            <div class="product-price">Rp156.000 <span class="price-original">Rp240.000</span></div>
            <button class="add-to-cart-btn" onclick="addToCart(0, event)">Add to Cart</button>
          </div>
        </div>
        <div class="product-card" onclick="openModal(1)">
          <div class="product-image"><img src="{{ asset('images/image42.jpg') }}" alt="product"></div>
          <div class="discount-badge">30%</div>
          <div class="product-info">
            <div class="product-badge">Flash Sale</div>
            <div class="product-name">Into The Night Body Lotion</div>
            <div class="product-brand">Bath & Body Works</div>
            <div class="product-price">Rp203.000 <span class="price-original">Rp290.000</span></div>
            <button class="add-to-cart-btn" onclick="addToCart(1, event)">Add to Cart</button>
          </div>
        </div>
        <div class="product-card" onclick="openModal(2)">
          <div class="product-image"><img src="{{ asset('images/image43.jpg') }}" alt="product"></div>
          <div class="discount-badge">25%</div>
          <div class="product-info">
            <div class="product-badge">Flash Sale</div>
            <div class="product-name">Sleepy Body Lotion</div>
            <div class="product-brand">LUSH</div>
            <div class="product-price">Rp285.000 <span class="price-original">Rp380.000</span></div>
            <button class="add-to-cart-btn" onclick="addToCart(2, event)">Add to Cart</button>
          </div>
        </div>
        <div class="product-card" onclick="openModal(3)">
          <div class="product-image"><img src="{{ asset('images/image44.jpg') }}" alt="product"></div>
          <div class="discount-badge">28%</div>
          <div class="product-info">
            <div class="product-badge">Flash Sale</div>
            <div class="product-name">Self-Love Body Oil</div>
            <div class="product-brand">Bopo Women</div>
            <div class="product-price">Rp223.200 <span class="price-original">Rp310.000</span></div>
            <button class="add-to-cart-btn" onclick="addToCart(3, event)">Add to Cart</button>
          </div>
        </div>
        <div class="product-card" onclick="openModal(4)">
          <div class="product-image"><img src="{{ asset('images/image45.jpg') }}" alt="product"></div>
          <div class="discount-badge">32%</div>
          <div class="product-info">
            <div class="product-badge">Flash Sale</div>
            <div class="product-name">Gluta-Hya Flawless Bright Serum Lotion</div>
            <div class="product-brand">Vaseline</div>
            <div class="product-price">Rp39.440 <span class="price-original">Rp58.000</span></div>
            <button class="add-to-cart-btn" onclick="addToCart(4, event)">Add to Cart</button>
          </div>
        </div>
        <div class="product-card" onclick="openModal(5)">
          <div class="product-image"><img src="{{ asset('images/image46.jpg') }}" alt="product"></div>
          <div class="discount-badge">26%</div>
          <div class="product-info">
            <div class="product-badge">Flash Sale</div>
            <div class="product-name">Extra White Repair & Protect SPF30</div>
            <div class="product-brand">Nivea</div>
            <div class="product-price">Rp40.700 <span class="price-original">Rp55.000</span></div>
            <button class="add-to-cart-btn" onclick="addToCart(5, event)">Add to Cart</button>
          </div>
        </div>
        <div class="product-card" onclick="openModal(6)">
          <div class="product-image"><img src="{{ asset('images/image47.jpg') }}" alt="product"></div>
          <div class="discount-badge">24%</div>
          <div class="product-info">
            <div class="product-badge">Flash Sale</div>
            <div class="product-name">Atoderm Ultra-Nourishing Cream</div>
            <div class="product-brand">Bioderma</div>
            <div class="product-price">Rp266.000 <span class="price-original">Rp350.000</span></div>
            <button class="add-to-cart-btn" onclick="addToCart(6, event)">Add to Cart</button>
          </div>
        </div>
        <div class="product-card" onclick="openModal(7)">
          <div class="product-image"><img src="{{ asset('images/image48.jpg') }}" alt="product"></div>
          <div class="discount-badge">29%</div>
          <div class="product-info">
            <div class="product-badge">Flash Sale</div>
            <div class="product-name">Bronzing Lotion</div>
            <div class="product-brand">Bali Body</div>
            <div class="product-price">Rp276.900 <span class="price-original">Rp390.000</span></div>
            <button class="add-to-cart-btn" onclick="addToCart(7, event)">Add to Cart</button>
          </div>
        </div>
        <div class="product-card" onclick="openModal(8)">
          <div class="product-image"><img src="{{ asset('images/image49.jpg') }}" alt="product"></div>
          <div class="discount-badge">27%</div>
          <div class="product-info">
            <div class="product-badge">Flash Sale</div>
            <div class="product-name">SA Smoothing Cleanser</div>
            <div class="product-brand">CeraVe</div>
            <div class="product-price">Rp204.400 <span class="price-original">Rp280.000</span></div>
            <button class="add-to-cart-btn" onclick="addToCart(8, event)">Add to Cart</button>
          </div>
        </div>
        <div class="product-card" onclick="openModal(9)">
          <div class="product-image"><img src="{{ asset('images/image50.jpg') }}" alt="product"></div>
          <div class="discount-badge">31%</div>
          <div class="product-info">
            <div class="product-badge">Flash Sale</div>
            <div class="product-name">Exfoliating Body Polish Crushed Macadamia & Rice Milk</div>
            <div class="product-brand">Dove</div>
            <div class="product-price">Rp65.650 <span class="price-original">Rp95.000</span></div>
            <button class="add-to-cart-btn" onclick="addToCart(9, event)">Add to Cart</button>
          </div>
        </div>
      </div>
      <button class="carousel-btn prev" onclick="scrollCarousel('flashSaleCarousel', -1)">‹</button>
      <button class="carousel-btn next" onclick="scrollCarousel('flashSaleCarousel', 1)">›</button>
    </div>
  </div>
</section>

<!-- FREE GIFTS -->
<section class="free-gifts-section">
  <h2 class="section-title">Free Gifts, This Way!</h2>
  <div class="gifts-grid" style="padding:0;">
    <div class="container" style="display:flex;justify-content:center;padding:20px 0;">
      <img src="{{ asset('images/gift.jpg') }}" alt="Free Gifts banner" style="width:100%;max-width:1000px;height:auto;display:block;border-radius:12px;object-fit:cover;" />
    </div>
  </div>
</section>

<!-- EXPLORE MORE -->
<section class="explore-section">
  <div class="explore-container">
    <h2 class="explore-title">More to explore for you, Bestie!</h2>
  <div class="products-grid" id="exploreGrid">
      <!-- first 10 products visible -->
  <div class="explore-product-card" onclick="openModal(0)"><div class="explore-product-image"><img src="{{ asset('images/image41.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">The Body Shop</div><div class="explore-product-name">Shea Body Butter</div><div class="explore-product-price">Rp240.000</div></div></div>
      <div class="explore-product-card" onclick="openModal(1)"><div class="explore-product-image"><img src="{{ asset('images/image42.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">Bath & Body Works</div><div class="explore-product-name">Into The Night Body Lotion</div><div class="explore-product-price">Rp290.000</div></div></div>
      <div class="explore-product-card" onclick="openModal(2)"><div class="explore-product-image"><img src="{{ asset('images/image43.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">LUSH</div><div class="explore-product-name">Sleepy Body Lotion</div><div class="explore-product-price">Rp380.000</div></div></div>
      <div class="explore-product-card" onclick="openModal(3)"><div class="explore-product-image"><img src="{{ asset('images/image44.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">Bopo Women</div><div class="explore-product-name">Self-Love Body Oil</div><div class="explore-product-price">Rp310.000</div></div></div>
      <div class="explore-product-card" onclick="openModal(4)"><div class="explore-product-image"><img src="{{ asset('images/image45.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">Vaseline</div><div class="explore-product-name">Gluta-Hya Flawless Bright Serum Lotion</div><div class="explore-product-price">Rp58.000</div></div></div>
      <div class="explore-product-card" onclick="openModal(5)"><div class="explore-product-image"><img src="{{ asset('images/image46.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">Nivea</div><div class="explore-product-name">Extra White Repair & Protect SPF30</div><div class="explore-product-price">Rp55.000</div></div></div>
      <div class="explore-product-card" onclick="openModal(6)"><div class="explore-product-image"><img src="{{ asset('images/image47.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">Bioderma</div><div class="explore-product-name">Atoderm Ultra-Nourishing Cream</div><div class="explore-product-price">Rp350.000</div></div></div>
      <div class="explore-product-card" onclick="openModal(7)"><div class="explore-product-image"><img src="{{ asset('images/image48.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">Bali Body</div><div class="explore-product-name">Bronzing Lotion</div><div class="explore-product-price">Rp390.000</div></div></div>
      <div class="explore-product-card" onclick="openModal(8)"><div class="explore-product-image"><img src="{{ asset('images/image49.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">CeraVe</div><div class="explore-product-name">SA Smoothing Cleanser</div><div class="explore-product-price">Rp280.000</div></div></div>
      <div class="explore-product-card" onclick="openModal(9)"><div class="explore-product-image"><img src="{{ asset('images/image50.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">Dove</div><div class="explore-product-name">Exfoliating Body Polish Crushed Macadamia & Rice Milk</div><div class="explore-product-price">Rp95.000</div></div></div>

      <!-- remaining 10 hidden initially -->
      <div id="moreExplore" class="hidden">
        <div class="explore-product-card" onclick="openModal(10)"><div class="explore-product-image"><img src="{{ asset('images/image51.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">OUAI</div><div class="explore-product-name">Melrose Place Body Cleanser</div><div class="explore-product-price">Rp420.000</div></div></div>
        <div class="explore-product-card" onclick="openModal(11)"><div class="explore-product-image"><img src="{{ asset('images/image52.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">Sol de Janeiro</div><div class="explore-product-name">Brazilian Bum Bum Cream</div><div class="explore-product-price">Rp620.000</div></div></div>
        <div class="explore-product-card" onclick="openModal(12)"><div class="explore-product-image"><img src="{{ asset('images/image53.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">St. Ives</div><div class="explore-product-name">Oatmeal & Shea Butter Body Wash</div><div class="explore-product-price">Rp68.000</div></div></div>
        <div class="explore-product-card" onclick="openModal(13)"><div class="explore-product-image"><img src="{{ asset('images/image54.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">Neutrogena</div><div class="explore-product-name">Hydro Boost Whipped Body Balm</div><div class="explore-product-price">Rp220.000</div></div></div>
        <div class="explore-product-card" onclick="openModal(14)"><div class="explore-product-image"><img src="{{ asset('images/image55.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">Eucerin</div><div class="explore-product-name">pH5 Shower Oil</div><div class="explore-product-price">Rp330.000</div></div></div>
        <div class="explore-product-card" onclick="openModal(15)"><div class="explore-product-image"><img src="{{ asset('images/image56.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">L'Occitane</div><div class="explore-product-name">Almond Shower Oil</div><div class="explore-product-price">Rp450.000</div></div></div>
        <div class="explore-product-card" onclick="openModal(16)"><div class="explore-product-image"><img src="{{ asset('images/image57.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">Maison Fleurette</div><div class="explore-product-name">Rose Milk Bath Salts</div><div class="explore-product-price">Rp150.000</div></div></div>
        <div class="explore-product-card" onclick="openModal(17)"><div class="explore-product-image"><img src="{{ asset('images/image58.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">Palmer's</div><div class="explore-product-name">Cocoa Butter Formula Lotion</div><div class="explore-product-price">Rp95.000</div></div></div>
        <div class="explore-product-card" onclick="openModal(18)"><div class="explore-product-image"><img src="{{ asset('images/image59.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">Sensatia Botanicals</div><div class="explore-product-name">Seaweed Bath Soap</div><div class="explore-product-price">Rp85.000</div></div></div>
        <div class="explore-product-card" onclick="openModal(19)"><div class="explore-product-image"><img src="{{ asset('images/image60.jpg') }}" alt="product"></div><div class="explore-product-info"><div class="explore-product-badge">Bodycare</div><div class="explore-product-brand">Bio-Oil</div><div class="explore-product-name">Skincare Oil</div><div class="explore-product-price">Rp160.000</div></div></div>
        </div>
      </div>
      <div style="text-align:center;margin-top:18px">
        <button id="loadMoreBtn" class="see-all-btn" onclick="loadMoreExplore()">Load more products</button>
      </div>
      <script>
        function loadMoreExplore(){
          var grid = document.getElementById('exploreGrid');
          var more = document.getElementById('moreExplore');
          var btn = document.getElementById('loadMoreBtn');
          if(more) more.classList.remove('hidden');
          if(grid) grid.classList.add('expanded');
          if(btn) btn.style.display = 'none';
        }
      </script>
  </div>
</section>

<style>
  /* allow the hidden wrapper to become transparent to the grid when shown
     so its children participate as direct grid items. Keep .hidden to hide it. */
  #moreExplore { display: contents; }
  #moreExplore.hidden { display: none; }

  /* initially show only first 10 items (5 columns x 2 rows) in explore grid */
  #exploreGrid:not(.expanded) > * { display: none; }
  #exploreGrid:not(.expanded) > *:nth-child(-n+10) { display: block; }
</style>

<!-- FOOTER -->
<section class="footer-section">
  <div class="footer-container">
    <div class="footer-grid">
      <div class="footer-item"><div class="footer-icon">✓</div><div class="footer-title">Asli & 100% BPOM</div><div class="footer-description">Belanja dengan ketenangan dari ratusan brand yang bersertifikasi BPOM</div></div>
      <div class="footer-item"><div class="footer-icon">♥</div><div class="footer-title">Promo Cantik Tiap Hari</div><div class="footer-description">Temukan ribuan produk favorit kamu dengan promo spesial setiap hari</div></div>
      <div class="footer-item"><div class="footer-icon">★</div><div class="footer-title">Review Terpercaya</div><div class="footer-description">Baca ulasan terpercaya sebelum kamu membeli dan bergabung komunitas</div></div>
    </div>
  </div>
</section>

<!-- PRODUCT MODAL -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[onclick]').forEach(function (el) {
      try { var onclick = el.getAttribute('onclick') || ''; var m = onclick.match(/openModal\((\d+)\)/); if (m && !el.hasAttribute('data-index')) el.setAttribute('data-index', m[1]); } catch(e){}
    });
    document.querySelectorAll('.product-name, .explore-product-name, .mini-name').forEach(function (el) { if (!el.hasAttribute('data-desc')) el.setAttribute('data-desc', (el.innerText || '').trim()); });
    document.querySelectorAll('.product-card, .mini-card, .explore-product-card').forEach(function (card) {
      try {
        var idx = card.getAttribute('data-index');
        if (!idx) { var oc = card.getAttribute('onclick') || ''; var mm = oc.match(/openModal\((\d+)\)/); if (mm) idx = mm[1]; }
        var info = card.querySelector('.product-info, .explore-product-info, .mini-info'); if (!info) return;
        if (!info.querySelector('.product-brand') && !info.querySelector('.explore-product-brand')) {
          var brandEl = document.createElement('div'); brandEl.className = card.classList.contains('explore-product-card') ? 'explore-product-brand' : 'product-brand'; brandEl.textContent = ''; var priceEl = info.querySelector('.product-price, .explore-product-price, .mini-price'); if (priceEl) info.insertBefore(brandEl, priceEl); else info.appendChild(brandEl);
        }
        if (!info.querySelector('.add-to-cart-btn') && typeof idx !== 'undefined') { var btn = document.createElement('button'); btn.className = 'add-to-cart-btn'; btn.textContent = 'Add to Cart'; btn.setAttribute('onclick', 'addToCart(' + idx + ', event)'); info.appendChild(btn); }
      // Discount badge: if card has "Flash Sale" badge but no .discount-badge, compute percent from price and price-original
      try {
        if (!card.querySelector('.discount-badge')) {
          var badgeNode = info.querySelector('.product-badge') || info.querySelector('.explore-product-badge');
          if (badgeNode && /flash sale/i.test(badgeNode.innerText || '')) {
            var priceEl = info.querySelector('.product-price, .explore-product-price, .mini-price');
            var origEl = info.querySelector('.price-original');
            function parseNumber(s){ if(!s) return 0; var n = (s+'').replace(/[^0-9\.\,]/g,'').replace(/,/g,''); return Number(n)||0; }
            var p = parseNumber(priceEl ? priceEl.innerText : '');
            var o = parseNumber(origEl ? origEl.innerText : '');
            var val = '';
            if (o > 0 && p > 0 && o > p) val = Math.round((o - p)/o * 100) + '%';
            else val = 'Promo';
            var imgWrap = card.querySelector('.product-image, .explore-product-image, .mini-image');
            if (imgWrap) {
              var d = document.createElement('div'); d.className = 'discount-badge'; d.textContent = val;
              imgWrap.parentNode.insertBefore(d, imgWrap.nextSibling);
            }
          }
        }
      } catch(e){}
      } catch(e){}
    });
  });
</script>
<div id="productModal" class="modal">
  <div class="modal-content">
    <span class="modal-close" onclick="closeModal()">&times;</span>
  <div class="modal-product-image"><img id="modalImage" src="" alt="Product image"></div>
    <h2 class="modal-product-title" id="modalTitle">Product Name</h2>
    <p class="modal-product-brand" id="modalBrand">Brand</p>
    <p class="modal-product-price" id="modalPrice">Rp0</p>
    <p class="modal-product-desc" id="modalDesc">Description</p>
    <button class="modal-add-btn" id="modalAddBtn" onclick="addToCartFromModal(event)">Add to Cart</button>
  </div>
</div>

<!-- CART DIALOG -->
<dialog id="cartModal" style="border:none;border-radius:0;padding:0;width:min(980px,95vw)">
  <button class="cart-close" id="closeCart">✕</button>
  <section class="checkout" style="display:grid;grid-template-columns:1.6fr .9fr;gap:28px;padding:28px">
    <div>
      <h1 style="font:800 36px/1.15 'Inter',sans-serif;margin:6px 0 10px">Checkout</h1>
      <div class="row" style="font-size:20px;color:#374151;margin:12px 0 16px"><span>Total Items:</span> <strong id="cartCount">0</strong></div>
      <div class="items" id="cartItems" style="min-height:260px;border:1px dashed #e5e7eb;border-radius:14px;padding:16px;display:flex;flex-direction:column;gap:12px;overflow-y:auto;max-height:400px">
        <div style="display:flex;align-items:center;justify-content:center;color:#6b7280">Your cart is empty</div>
      </div>
    </div>
    <aside style="background:#fff;border:1px solid #eee;border-radius:16px;box-shadow:0 10px 28px rgba(0,0,0,.06);padding:22px">
      <h3 style="font:800 24px/1.2 'Inter';margin:0 0 16px">Total Amount</h3>
      <div style="display:flex;justify-content:space-between;margin:8px 0;color:#374151"><span>Subtotal</span><span id="cartSubtotal">Rp 0</span></div>
      <div style="display:flex;justify-content:space-between;margin:8px 0;color:#374151"><span>Shipping</span><span>Rp 0</span></div>
      <div style="font:800 24px/1.2 'Inter';color:#111827;margin-top:10px">Amount: <span id="cartTotal">Rp 0</span></div>
      <div style="margin-top:18px"><button style="background:#10b981;color:#fff;border:none;border-radius:12px;padding:14px 16px;font-weight:800;width:100%;cursor:pointer">Place Order</button></div>
    </aside>
  </section>
</dialog>

<!-- LOGIN / REGISTER -->
<dialog id="loginModal" style="border:none;border-radius:16px;padding:0;max-width:420px;width:92%">
  <form method="dialog" style="padding:22px 22px 10px">
    <h3 style="margin:0 0 16px;font:700 20px/1.2 'Inter'">Log in to <span style="color:#ff7ab8">Beauté Verse</span></h3>
    <p style="font-size:14px;margin-bottom:12px;color:#b6a7c3">Please log in with your email and password</p>
    <label style="display:block;margin-bottom:10px">Email<br>
      <input required type="email" placeholder="you@example.com" style="width:100%;padding:12px 14px;border:1px solid #e5e7eb;border-radius:10px;margin-top:6px">
    </label>
    <label style="display:block;margin-bottom:12px">Password<br>
      <input required type="password" placeholder="••••••••" style="width:100%;padding:12px 14px;border:1px solid #e5e7eb;border-radius:10px;margin-top:6px">
    </label>
    <p style="font-size:13px;color:#b6a7c3;margin:8px 0 12px">Don't have an account? <a href="#" id="openRegister" style="color:#ff7ab8;font-weight:700">Sign up here</a></p>
    <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:6px">
      <button type="button" id="loginCancel" style="background:#f3f4f6;border:none;padding:10px 14px;border-radius:10px">Cancel</button>
      <button value="login" style="background:#ff7ab8;color:#fff;border:none;padding:10px 14px;border-radius:10px;font-weight:700">Login</button>
    </div>
  </form>
</dialog>

<dialog id="registerModal" style="border:none;border-radius:16px;padding:0;max-width:460px;width:92%">
  <form id="registerForm" style="padding:22px 22px 14px">
    <h3 style="margin:0 0 6px;font:700 20px/1.2 'Inter'">Create Account <span style="color:#ff7ab8">Beauté Verse</span></h3>
    <p style="font-size:14px;color:#b6a7c3;margin:0 0 14px">Sign up to continue.</p>
    <label style="display:block;margin-bottom:10px">Full Name<br>
      <input required id="regName" type="text" placeholder="Nama kamu" style="width:100%;padding:12px 14px;border:1px solid #e5e7eb;border-radius:10px;margin-top:6px">
    </label>
    <label style="display:block;margin-bottom:10px">Email<br>
      <input required id="regEmail" type="email" placeholder="you@example.com" style="width:100%;padding:12px 14px;border:1px solid #e5e7eb;border-radius:10px;margin-top:6px">
    </label>
    <label style="display:block;margin-bottom:6px">Password<br>
      <input required id="regPass" type="password" placeholder="At least 6 characters" style="width:100%;padding:12px 14px;border:1px solid #e5e7eb;border-radius:10px;margin-top:6px">
    </label>
    <label style="display:flex;align-items:center;gap:8px;font-size:14px;color:#b6a7c3;margin:8px 0 14px">
      <input type="checkbox" id="regAgree"> I agree to the Terms
    </label>
    <div id="regError" style="display:none;color:#ef4444;font-size:13px;margin-bottom:8px">Lengkapi data & centang persetujuan.</div>
    <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:6px">
      <button type="button" id="regCancel" style="background:#f3f4f6;border:none;padding:10px 14px;border-radius:10px">Cancel</button>
      <button type="button" id="createAccount" style="background:#ff7ab8;color:#fff;border:none;padding:10px 14px;border-radius:10px;font-weight:700">Create Account</button>
    </div>
  </form>
</dialog>
@endsection

@push('scripts')
<script>
  const products = [
    {title:"Shea Body Butter",brand:"The Body Shop",price:240000,desc:"An iconic ultra-rich moisturizer with shea butter that delivers up to 48 hours of deep hydration. Thick yet non-greasy, it nourishes dry skin.", image: "{{ asset('images/image41.jpg') }}"},
  {title:"Into The Night Body Lotion",brand:"Bath & Body Works",price:290000,desc:"A luxurious body lotion with notes of raspberry noir, amber, and musk. Silky smooth texture absorbs quickly.", image: "{{ asset('images/image42.jpg') }}"},
  {title:"Sleepy Body Lotion",brand:"LUSH",price:380000,desc:"A calming lavender & tonka-scented body lotion that softens skin and promotes relaxation before bedtime.", image: "{{ asset('images/image43.jpg') }}"},
  {title:"Self-Love Body Oil",brand:"Bopo Women",price:310000,desc:"A lightweight body oil with avocado and jojoba oils that absorbs quickly without greasiness.", image: "{{ asset('images/image44.jpg') }}"},
  {title:"Gluta-Hya Flawless Bright Serum Lotion",brand:"Vaseline",price:58000,desc:"A brightening serum-lotion with glutathione and hyaluronic acid that deeply hydrates and promotes radiant skin.", image: "{{ asset('images/image45.jpg') }}"},
  {title:"Extra White Repair & Protect SPF30",brand:"Nivea",price:55000,desc:"A vitamin C enriched body lotion that brightens and shields skin from harmful UV rays with SPF30 protection.", image: "{{ asset('images/image46.jpg') }}"},
  {title:"Atoderm Ultra-Nourishing Cream",brand:"Bioderma",price:350000,desc:"A rich moisturizer for very dry and sensitive skin that restores the skin barrier and prevents moisture loss.", image: "{{ asset('images/image47.jpg') }}"},
  {title:"Bronzing Lotion",brand:"Bali Body",price:390000,desc:"A tinted bronzing body lotion that gives an instant sun-kissed glow. Enriched with aloe vera and cocoa butter.", image: "{{ asset('images/image48.jpg') }}"},
  {title:"SA Smoothing Cleanser",brand:"CeraVe",price:280000,desc:"A body cleanser with salicylic acid and ceramides that smooths rough, bumpy skin and supports the skin barrier.", image: "{{ asset('images/image49.jpg') }}"},
  {title:"Exfoliating Body Polish Crushed Macadamia & Rice Milk",brand:"Dove",price:95000,desc:"A gentle body polish with crushed macadamia and rice milk that exfoliates and nourishes skin.", image: "{{ asset('images/image50.jpg') }}"},
  {title:"Melrose Place Body Cleanser",brand:"OUAI",price:420000,desc:"A rose-scented body wash that cleanses without stripping natural oils. Leaves skin silky smooth.", image: "{{ asset('images/image51.jpg') }}"},
  {title:"Brazilian Bum Bum Cream",brand:"Sol de Janeiro",price:620000,desc:"A cult-favorite body cream with pistachio and caramel scent that smooths, firms, and hydrates skin.", image: "{{ asset('images/image52.jpg') }}"},
  {title:"Oatmeal & Shea Butter Body Wash",brand:"St. Ives",price:68000,desc:"A creamy body wash with oatmeal and shea butter to soothe dry, sensitive skin.", image: "{{ asset('images/image53.jpg') }}"},
  {title:"Hydro Boost Whipped Body Balm",brand:"Neutrogena",price:220000,desc:"A lightweight whipped body balm with hyaluronic acid that delivers long-lasting moisture without heaviness.", image: "{{ asset('images/image54.jpg') }}"},
  {title:"pH5 Shower Oil",brand:"Eucerin",price:330000,desc:"A gentle shower oil that cleanses while preserving skin's pH balance and natural barrier.", image: "{{ asset('images/image55.jpg') }}"},
  {title:"Almond Shower Oil",brand:"L'Occitane",price:450000,desc:"A luxurious shower oil infused with sweet almond oil that transforms into a rich, creamy foam.", image: "{{ asset('images/image56.jpg') }}"},
  {title:"Rose Milk Bath Salts",brand:"Maison Fleurette",price:150000,desc:"Indulgent bath salts blended with rose and milk to soften and relax the body.", image: "{{ asset('images/image57.jpg') }}"},
  {title:"Cocoa Butter Formula Lotion",brand:"Palmer's",price:95000,desc:"A classic cocoa butter lotion enriched with vitamin E that deeply moisturizes and helps diminish stretch marks.", image: "{{ asset('images/image58.jpg') }}"},
  {title:"Seaweed Bath Soap",brand:"Sensatia Botanicals",price:85000,desc:"A natural soap enriched with seaweed extract and essential oils that gently cleanses while supporting skin health.", image: "{{ asset('images/image59.jpg') }}"},
    {title:"Skincare Oil",brand:"Bio-Oil",price:160000,desc:"A multi-purpose skin oil that helps reduce the appearance of scars, stretch marks, and uneven skin tone.", image: "{{ asset('images/image60.jpg') }}"}
  ];

  let currentProductIndex = -1;

  function getCart(){
    const cart = localStorage.getItem('beauteCart');
    return cart ? JSON.parse(cart) : [];
  }

  function saveCart(cart){
    localStorage.setItem('beauteCart', JSON.stringify(cart));
    updateCartBadge();
  }

  function updateCartBadge(){
    const cart = getCart();
    const badge = document.querySelector('.badge');
    if (badge) badge.textContent = cart.length;
  }

  function renderCartItems(){
    const cart = getCart();
    const cartItems = document.getElementById('cartItems');
    const cartCount = document.getElementById('cartCount');
    const cartSubtotal = document.getElementById('cartSubtotal');
    const cartTotal = document.getElementById('cartTotal');

    cartCount.textContent = cart.length;

    if(cart.length === 0){
      cartItems.innerHTML = '<div style="display:flex;align-items:center;justify-content:center;color:#6b7280">Your cart is empty</div>';
      cartSubtotal.textContent = 'Rp 0';
      cartTotal.textContent = 'Rp 0';
      return;
    }

    let subtotal = 0;
    cartItems.innerHTML = cart.map((item, idx) => {
      subtotal += item.price;
      return `
        <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:10px;padding:12px;display:flex;justify-content:space-between;align-items:center;gap:12px">
          <div style="flex:1">
            <div style="font-weight:600;color:#111827;margin-bottom:4px">${item.title}</div>
            <div style="color:#10b981;font-weight:700">Rp ${item.price.toLocaleString('id-ID')}</div>
          </div>
          <div style="display:flex;align-items:center;gap:8px">
            <button style="background:#fee2e2;color:#dc2626;border:none;padding:6px 10px;border-radius:6px;cursor:pointer;font-weight:600;font-size:12px;transition:all .2s" onclick="removeFromCart(${idx})">Remove</button>
          </div>
        </div>
      `;
    }).join('');

    cartSubtotal.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    cartTotal.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
  }

  function removeFromCart(index){
    const cart = getCart();
    cart.splice(index, 1);
    saveCart(cart);
    renderCartItems();
  }

  function addToCart(index, event){
    event.stopPropagation();
    const cart = getCart();
    cart.push(products[index]);
    saveCart(cart);
    alert('Produk ditambahkan ke keranjang!');
  }

  function addToCartFromModal(event){
    event.stopPropagation();
    if(currentProductIndex >= 0){
      const cart = getCart();
      cart.push(products[currentProductIndex]);
      saveCart(cart);
      alert('Produk ditambahkan ke keranjang!');
      closeModal();
    }
  }

  function openModal(index){
    currentProductIndex = index;
    const modal = document.getElementById('productModal');
    const p = products[index];
    document.getElementById('modalTitle').textContent = p.title;
    document.getElementById('modalBrand').textContent = p.brand;
    document.getElementById('modalPrice').textContent = 'Rp' + p.price.toLocaleString('id-ID');
    document.getElementById('modalDesc').textContent = p.desc;
    const modalImg = document.getElementById('modalImage');
    if(modalImg){
      modalImg.src = p.image || '';
      modalImg.onerror = function(){ this.style.display = 'none'; };
      modalImg.style.display = p.image ? 'block' : 'none';
    }
    modal.style.display = 'block';
  }

  function closeModal(){
    const modal = document.getElementById('productModal');
    const modalImg = document.getElementById('modalImage');
    if(modalImg) modalImg.src = '';
    if(modal) modal.style.display = 'none';
    currentProductIndex = -1;
  }

  function scrollCarousel(id, dir){
    const c = document.getElementById(id);
    c.scrollBy({left: dir * 250, behavior: 'smooth'});
  }

  function switchCategory(id){
    document.querySelectorAll('.category-carousel').forEach(e => e.classList.add('hidden'));
    document.getElementById(id).classList.remove('hidden');
    document.querySelectorAll('.category-tabs li').forEach(e => e.classList.remove('active'));
    event.target.classList.add('active');
  }

  function loadMoreExplore(){
    const more = document.getElementById('moreExplore');
    const btn = document.getElementById('loadMoreBtn');
    if(more){
      more.classList.remove('hidden');
      // ensure the newly revealed cards participate in grid layout
      more.style.display = 'contents';
    }
    if(btn) btn.style.display = 'none';
  }

  window.onclick = function(e){
    const m = document.getElementById('productModal');
    if(e.target == m) m.style.display = 'none';
  }

  // Search: filter semua section (flash, tabs, explore)
  function filterProducts(searchTerm){
    const term = searchTerm.toLowerCase();

    document.querySelectorAll('#flashSaleCarousel .product-card').forEach(card=>{
      const name = card.querySelector('.product-name').textContent.toLowerCase();
      card.style.display = name.includes(term) ? '' : 'none';
    });

    document.querySelectorAll('.category-carousel .mini-card').forEach(card=>{
      const name = card.querySelector('.mini-name').textContent.toLowerCase();
      card.style.display = name.includes(term) ? '' : 'none';
    });

    document.querySelectorAll('.explore-product-card').forEach(card=>{
      const name = card.querySelector('.explore-product-name').textContent.toLowerCase();
      card.style.display = name.includes(term) ? '' : 'none';
    });
  }

  const loginModal = document.getElementById('loginModal');
  const registerModal = document.getElementById('registerModal');
  const cartModal = document.getElementById('cartModal');

  document.getElementById('openLogin').addEventListener('click', (e)=>{ 
    e.preventDefault(); 
    loginModal.showModal(); 
  });

  document.getElementById('openCart').addEventListener('click',(e)=>{ 
    e.preventDefault(); 
    renderCartItems();
    cartModal.showModal();
  });

  document.getElementById('closeCart').addEventListener('click',()=>{ cartModal.close(); });
  document.getElementById('loginCancel').addEventListener('click',()=> loginModal.close());

  const regLink = document.getElementById('openRegister'); 
  if(regLink){
    regLink.addEventListener('click', (e)=>{
      e.preventDefault();
      registerModal.showModal();
    });
  }

  const regName = document.getElementById('regName'); 
  const regEmail = document.getElementById('regEmail'); 
  const regPass = document.getElementById('regPass'); 
  const regAgree = document.getElementById('regAgree'); 
  const regError = document.getElementById('regError');

  document.getElementById('regCancel').addEventListener('click', ()=> registerModal.close());
  document.getElementById('createAccount').addEventListener('click', ()=>{ 
    const ok = regName.value.trim() && regEmail.value.trim() && regPass.value.length >= 6 && regAgree.checked; 
    if(!ok){ 
      regError.style.display='block'; 
      return; 
    } 
    regError.style.display='none'; 
    localStorage.setItem('bv_registered', '1'); 
    registerModal.close(); 
    loginModal.showModal();
  });

  document.addEventListener('DOMContentLoaded', function(){
    updateCartBadge();
    const searchInput = document.getElementById('searchInput');
    if(searchInput){
      searchInput.addEventListener('input', function(e){
        filterProducts(e.target.value);
      });
    }
  });
</script>
@endpush