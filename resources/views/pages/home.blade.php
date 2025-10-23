@extends('layouts.app')

@section('title', 'Beauté Verse — Home')

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
  /* Hero (full-bleed) */
  .hero{position:relative;border-radius:var(--radius);overflow:visible;background:#fafafa;box-shadow:var(--shadow);width:100vw;margin-left:calc(50% - 50vw);padding-inline:20px}
  .slides{display:flex;transition:transform .5s ease}
  .slide{min-width:100%;}
  /* Arrow buttons (left/right) - glyph-only controls inside the hero image */
  .arrow{position:absolute;top:50%;transform:translateY(-50%);width:auto;height:auto;border-radius:0;display:flex;align-items:center;justify-content:center;color:var(--rose);background:transparent;border:none;font-size:34px;padding:6px 8px;cursor:pointer;z-index:40}
  .arrow.prev{left:12px}
  .arrow.next{right:12px}
  .arrow:hover{filter:brightness(0.9);transform:translateY(-50%) scale(1.05)}
  /* Dots (small circular indicators centered under hero) */
  .dots{position:absolute;left:50%;transform:translateX(-50%);bottom:18px;display:flex;gap:10px;z-index:35}
  .dots button{appearance:none;border:none;background:transparent;padding:0;margin:0;cursor:pointer}
  .dots .dot{width:12px;height:12px;border-radius:50%;background:#fae9f1;border:1px solid rgba(0,0,0,0.03);transition:transform .15s,box-shadow .15s,background .15s}
  .dots .dot.active{background:var(--rose);box-shadow:0 8px 20px rgba(255,122,184,0.18);transform:scale(1.06)}
  /* Footer */
  footer{margin:40px 0 60px}
  .foot{display:flex;justify-content:space-between;align-items:center;border-top:1px solid #eee;padding-top:20px}
  .foot a{padding:8px 10px;border-radius:8px}
  .foot a:hover{background:#f6f7f8}
  /* Responsive */
  @media (max-width: 900px){
    .topbar{flex-wrap:wrap}
  }
  /* Products scroller */
  .products{margin-top:28px}
  .products h2{font:600 28px/1.3 'Playfair Display',serif;font-style:italic;color:var(--rose);letter-spacing:.5px;}
  .product-row{display:flex;gap:18px;overflow:auto;padding:6px 4px 6px 2px;scroll-snap-type:x mandatory}
  .product-card{min-width:260px;max-width:260px;background:#fff;border-radius:14px;box-shadow:0 8px 24px rgba(0,0,0,.06);scroll-snap-align:start;border:1px solid #eee}
  .product-thumb{width:100%;height:240px;border-top-left-radius:14px;border-top-right-radius:14px;object-fit:cover;display:block}
  .product-body{padding:14px}
  .product-title{font:700 18px/1.25 'Inter',sans-serif;margin:4px 0 6px}
  .product-brand{color:#6b7280;font-size:14px;margin:0 0 10px}
  .product-price{color:#10b981;font-weight:800;font-size:18px}
  .product-row::-webkit-scrollbar{height:10px}
  .product-row::-webkit-scrollbar-thumb{background:#e5e7eb;border-radius:999px}
  /* Product card styles from makeup.blade.php for consistent appearance */
  .product-card{flex:0 0 calc(20% - 16px);min-width:200px;background:white;border-radius:12px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.1);transition:all .3s ease;scroll-snap-align:start;position:relative;cursor:pointer}
  .product-card:hover{transform:translateY(-8px);box-shadow:0 8px 20px rgba(0,0,0,.15)}
  .product-image{width:100%;height:200px;background:linear-gradient(135deg,#f5f5f5 0%,#e0e0e0 100%);display:flex;align-items:center;justify-content:center;font-size:12px;color:#999;position:relative}
  .product-image img{width:100%;height:100%;object-fit:cover}
  .discount-badge{position:absolute;top:12px;left:12px;background-color:#FF1493;color:white;padding:6px 10px;border-radius:4px;font-weight:bold;font-size:12px}

  /* Compact flash sale badge (match Loveshine card): small pill inside image */
  .product-image .discount-badge,
  .explore-product-image .discount-badge,
  .mini-image .discount-badge {
    top:10px; left:10px; position:absolute; background:#ff1493; color:#fff; font-weight:700; font-size:13px; padding:6px 8px; border-radius:10px; box-shadow:0 6px 16px rgba(255,20,147,.12);
  }
  .product-info{padding:16px}
  .product-badge{display:inline-block;background-color:#FFE4E1;color:#FF1493;padding:4px 12px;border-radius:20px;font-size:11px;font-weight:600;margin-bottom:8px;text-transform:uppercase}
  .product-name{font-size:14px;font-weight:600;color:#333;margin-bottom:8px;line-height:1.4}

  /* hide badges everywhere by default; only show inside flash-sale-section */
  .product-badge, .explore-product-badge { display:none }

  /* show flash sale badges inside the flash sale section */
  .flash-sale-section .product-badge,
  .flash-sale-section .explore-product-badge,
  .flash-sale-section .product-info .product-badge { display:inline-block; background-color:#FFE4E1;color:#FF1493;padding:4px 12px;border-radius:20px;font-size:11px;font-weight:600;margin-bottom:8px;text-transform:uppercase }
  .product-brand{font-size:12px;color:#999;margin-bottom:8px}
  .product-price{font-size:14px;font-weight:700;color:#10b981;margin-bottom:8px}
  .price-original{font-size:12px;color:#999;text-decoration:line-through;margin-left:8px}
  .add-to-cart-btn{width:100%;background:linear-gradient(135deg,#FF1493 0%,#FF69B4 100%);color:white;border:none;padding:10px;border-radius:6px;cursor:pointer;font-weight:600;font-size:12px;transition:all .3s ease}
  .add-to-cart-btn:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(255,20,147,.3)}
  /* Product modal styles (same as makeup) */
  .modal{display:none;position:fixed;z-index:1000;left:0;top:0;width:100%;height:100%;background-color:rgba(0,0,0,.5)}
  .modal-content{background-color:#fefefe;margin:5% auto;padding:30px;border-radius:12px;width:90%;max-width:600px;max-height:80vh;overflow-y:auto}
  .modal-close{color:#aaa;float:right;font-size:28px;font-weight:bold;cursor:pointer}
  .modal-close:hover{color:#000}
  .modal-product-image{width:100%;height:300px;background:#fff;border-radius:12px;margin-bottom:20px;display:flex;align-items:center;justify-content:center;color:#999}
  .modal-product-image img{max-width:130%;max-height:130%;object-fit:contain;border-radius:12px}
  .modal-product-title{font-size:24px;font-weight:700;color:#333;margin-bottom:8px}
  .modal-product-brand{font-size:14px;color:#999;margin-bottom:16px}
  .modal-product-price{font-size:20px;font-weight:700;color:#10b981;margin-bottom:16px}
  .modal-product-desc{font-size:14px;color:#666;line-height:1.6;margin-bottom:20px}
  .modal-add-btn{width:100%;background:linear-gradient(135deg,#FF1493 0%,#FF69B4 100%);color:white;border:none;padding:14px;border-radius:8px;cursor:pointer;font-weight:600;font-size:16px;transition:all .3s ease}
  .modal-add-btn:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(255,20,147,.3)}
  /* Cart / Checkout */
  #cartModal{border:none;border-radius:0;padding:0;width:min(980px,95vw)}
  #cartModal::backdrop{background:rgba(0,0,0,.35)}
  .checkout{display:grid;grid-template-columns:1.6fr .9fr;gap:28px;padding:28px}
  .checkout h1{font:800 36px/1.15 'Inter',sans-serif;margin:6px 0 10px}
  .items{min-height:260px;border:1px dashed #e5e7eb;border-radius:14px;padding:16px;display:flex;align-items:center;justify-content:center;color:#6b7280}
  .summary{background:#fff;border:1px solid #eee;border-radius:16px;box-shadow:0 10px 28px rgba(0,0,0,.06);padding:22px}
  .summary h3{font:800 24px/1.2 'Inter';margin:0 0 16px}
  .row{display:flex;justify-content:space-between;margin:8px 0;color:#374151}
  .total{font:800 24px/1.2 'Inter';color:#111827;margin-top:10px}
  .btn-primary{background:#10b981;color:#fff;border:none;border-radius:12px;padding:14px 16px;font-weight:800;width:100%;cursor:pointer}
  .cart-close{position:absolute;top:10px;right:14px;background:#f3f4f6;border:none;border-radius:12px;padding:8px 10px;cursor:pointer}
  @media (max-width:900px){.checkout{grid-template-columns:1fr;}}
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

  <main class="container">
    {{-- HERO --}}
    <section class="hero" aria-label="Promotions carousel" style="display:flex;gap:26px;align-items:stretch;padding:26px;border-radius:var(--radius);background:radial-gradient(120% 120% at 10% 0%, #ffe7f2 0%, #fff9fd 45%, #fff 100%);box-shadow:var(--shadow)">
      <!-- Left slider -->
      <div style="flex:2;position:relative;border-radius:22px;overflow:hidden;background:#f7f7f7">
        <div id="slides" class="slides" style="height:420px">
          <div class="slide"><img src="{{ asset('images/1.png') }}" style="width:100%;height:420px;object-fit:cover" alt="Hero 1"></div>
          <div class="slide"><img src="{{ asset('images/2.jpg') }}" style="width:100%;height:420px;object-fit:cover" alt="Hero 2"></div>
          <div class="slide"><img src="{{ asset('images/3.jpg') }}" style="width:100%;height:420px;object-fit:cover" alt="Hero 3"></div>
          <div class="slide"><img src="{{ asset('images/4.jpg') }}" style="width:100%;height:420px;object-fit:cover" alt="Hero 4"></div>
          <div class="slide"><img src="{{ asset('images/5.jpg') }}" style="width:100%;height:420px;object-fit:cover" alt="Hero 5"></div>
        </div>
  <button id="prev" class="arrow prev">❮</button>
  <button id="next" class="arrow next">❯</button>
        <div id="dots" class="dots" style="left:50%;transform:translateX(-50%);"></div>
      </div>
      <!-- Right copy -->
      <aside style="flex:1;background:rgba(255,192,214,.35);backdrop-filter:saturate(140%) blur(1px);border-radius:22px;padding:28px 30px;display:flex;flex-direction:column;justify-content:center;box-shadow:0 10px 30px rgba(255,164,197,.25)">
        <div style="color:var(--rose);font-weight:700;letter-spacing:.4px;margin-bottom:8px">Fresh Arrivals</div>
        <h2 style="font-family:'Playfair Display',serif;font-size:40px;line-height:1.12;margin:0 0 12px">Glow With Confidence</h2>
        <p style="color:#8b8fa1;margin:0 0 22px;font-size:18px">Explore curated picks from top brands, now on promo.</p>
        <a href="#" id="shopNow" class="cta" style="align-self:flex-start;background:var(--rose);color:#fff;border:none;border-radius:999px;padding:12px 24px;font-weight:800;box-shadow:0 10px 18px rgba(255,122,184,.25)">Shop Now →</a>
      </aside>
    </section>

    {{-- PRODUCTS 1 --}}
    <section class="products">
      <h2>Glow Up Makeup Essentials</h2>
      <div class="product-row">
        <div class="product-card" data-index="5" onclick="openModal(5)">
            <div class="product-image"><img src="{{ asset('images/image6.jpg') }}" alt="Soft Pinch Liquid Blush"></div>
            <div class="product-info">
              <div class="product-name" data-desc="A creamy liquid blush for a natural flushed look">Soft Pinch Liquid Blush</div>
              <div class="product-brand">Rare Beauty</div>
              <div class="product-price">Rp380.000</div>
              <button class="add-to-cart-btn" onclick="addToCart(5, event)">Add to Cart</button>
            </div>
          </div>
        <div class="product-card" data-index="9" onclick="openModal(9)">
            <div class="product-image"><img src="{{ asset('images/image10.jpg') }}" alt="Gimme Brow+ Volumizing Eyebrow Gel"></div>
            <div class="product-info">
              <div class="product-name" data-desc="A volumizing brow gel for fuller-looking brows">Gimme Brow+ Volumizing Eyebrow Gel</div>
              <div class="product-brand">Benefit Cosmetics</div>
              <div class="product-price">Rp430.000</div>
              <button class="add-to-cart-btn" onclick="addToCart(9, event)">Add to Cart</button>
            </div>
          </div>
        <div class="product-card" data-index="4" onclick="openModal(4)">
            <div class="product-image"><img src="{{ asset('images/image5.jpg') }}" alt="Hoola Matte Powder Bronzer"></div>
            <div class="product-info">
              <div class="product-name" data-desc="A matte bronzer to add warm, sun-kissed color">Hoola Matte Powder Bronzer</div>
              <div class="product-brand">Benefit Cosmetics</div>
              <div class="product-price">Rp450.000</div>
              <button class="add-to-cart-btn" onclick="addToCart(4, event)">Add to Cart</button>
            </div>
          </div>
        <div class="product-card" data-index="2" onclick="openModal(2)">
            <div class="product-image"><img src="{{ asset('images/image3.jpg') }}" alt="Airbrush Flawless Foundation"></div>
            <div class="product-info">
              <div class="product-name" data-desc="A longwear foundation for a flawless, airbrushed finish">Airbrush Flawless Foundation</div>
              <div class="product-brand">Charlotte Tilbury</div>
              <div class="product-price">Rp900.000</div>
              <button class="add-to-cart-btn" onclick="addToCart(2, event)">Add to Cart</button>
            </div>
          </div>
    <div class="product-card" data-index="0" onclick="openModal(0)">
      <div class="product-image"><img src="{{ asset('images/image1.jpg') }}" alt="Loveshine Lip Oil Stick">
      </div>
      <div class="product-info">
        <div class="product-name" data-desc="A nourishing lip oil stick for glossy, hydrated lips">Loveshine Lip Oil Stick</div>
        <div class="product-brand">YSL Beauty</div>
        <div class="product-price">Rp780.000</div>
        <button class="add-to-cart-btn" onclick="addToCart(0, event)">Add to Cart</button>
      </div>
    </div>
    </section>

    {{-- PRODUCTS 2 --}}
    <section class="products">
    <h2>Best Skincare For You!</h2>
      <div class="product-row">
        <div class="product-card" data-index="22" onclick="openModal(22)">
          <div class="product-image"><img src="{{ asset('images/image23.jpg') }}" alt="Resveratrol Lift Serum"></div>
          <div class="product-info">
            <div class="product-name" data-desc="Serum dengan kandungan resveratrol untuk membantu menjaga elastisitas kulit">Resveratrol Lift Serum</div>
            <div class="product-brand">Caudalie</div>
            <div class="product-price">Rp650.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(22, event)">Add to Cart</button>
          </div>
        </div>
        <div class="product-card" data-index="24" onclick="openModal(24)">
          <div class="product-image"><img src="{{ asset('images/image25.jpg') }}" alt="Future Screen SPF50"></div>
          <div class="product-info">
            <div class="product-name" data-desc="Sunscreen broad spectrum SPF50 untuk perlindungan harian">Future Screen SPF50</div>
            <div class="product-brand">Ultra Violette</div>
            <div class="product-price">Rp390.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(24, event)">Add to Cart</button>
          </div>
        </div>
        <div class="product-card" data-index="23" onclick="openModal(23)">
          <div class="product-image"><img src="{{ asset('images/image24.jpg') }}" alt="Brazilian Bum Bum Cream"></div>
          <div class="product-info">
            <div class="product-name" data-desc="Moisturizer tubuh dengan tekstur rich dan aroma khas Brazil">Brazilian Bum Bum Cream</div>
            <div class="product-brand">Sol de Janeiro</div>
            <div class="product-price">Rp480.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(23, event)">Add to Cart</button>
          </div>
        </div>
        <div class="product-card" data-index="25" onclick="openModal(25)">
          <div class="product-image"><img src="{{ asset('images/image26.jpg') }}" alt="Vanilla Body Mist"></div>
          <div class="product-info">
            <div class="product-name" data-desc="Body mist dengan aroma vanilla yang lembut">Vanilla Body Mist</div>
            <div class="product-brand">Kayali</div>
            <div class="product-price">Rp310.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(25, event)">Add to Cart</button>
          </div>
        </div>
        <div class="product-card" data-index="26" onclick="openModal(26)">
          <div class="product-image"><img src="{{ asset('images/image27.jpg') }}" alt="Aromatherapy Sleep Lotion"></div>
          <div class="product-info">
            <div class="product-name" data-desc="Lotion aromaterapi untuk membantu relaksasi sebelum tidur">Aromatherapy Sleep Lotion</div>
            <div class="product-brand">Bath & Body Works</div>
            <div class="product-price">Rp290.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(26, event)">Add to Cart</button>
          </div>
        </div>
      </div>
    </section>

    {{-- PRODUCTS 3 --}}
    <section class="products">
    <h2>Top Bodycare You’ll Love</h2>
      <div class="product-row">
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
    </section>
  </main>

  {{-- FOOTER --}}
  <footer class="container" style="margin-top:80px;padding-top:50px;border-top:1px solid #eee">
    <div style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:40px">
      <div style="font-family:'Playfair Display',serif;font-size:32px;font-weight:600">
        Beauté Verse
        <span style="display:block;margin-top:4px;font-size:16px;color:#6b7280;font-weight:400">Your Trusted Beauty Destination</span>
      </div>
      <nav style="display:flex;flex-direction:column;gap:10px;font-weight:500;min-width:160px">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('about') }}">About Us</a>
        <a href="{{ route('contact') }}">Contact Us</a>
      </nav>
      <div style="display:flex;flex-direction:column;gap:8px;min-width:200px">
        <h4 style="margin:0;font-weight:600">Customer Care</h4>
        <span>cs@beauteverse.com</span>
        <span>0811 987 888 (WhatsApp)</span>
      </div>
    </div>
    <div style="margin-top:40px;font-size:14px;color:#6b7280;text-align:center">© 2025 Beauté Verse. All Rights Reserved.</div>
  </footer>

  {{-- CART MODAL --}}
  <dialog id="cartModal">
    <button class="cart-close" id="closeCart">✕</button>
    <section class="checkout">
      <div>
        <h1>Checkout</h1>
        <div class="row" style="font-size:20px;color:#374151;margin:12px 0 16px"><span>Total Items:</span> <strong id="cartCount">0</strong></div>
        <div class="items" id="cartItems">Your cart is empty</div>
      </div>
      <aside class="summary">
        <h3>Total Amount</h3>
        <div class="row"><span>Subtotal</span><span id="cartSubtotal">Rp 0</span></div>
        <div class="row"><span>Shipping</span><span>Rp 0</span></div>
        <div class="total">Amount: <span id="cartTotal">Rp 0</span></div>
        <div style="margin-top:18px"><button class="btn-primary">Place Order</button></div>
      </aside>
    </section>
  </dialog>

  {{-- PRODUCT DETAILS MODAL (for cards) --}}
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('[onclick]').forEach(function (el) { try { var onclick = el.getAttribute('onclick') || ''; var m = onclick.match(/openModal\((\d+)\)/); if (m && !el.hasAttribute('data-index')) el.setAttribute('data-index', m[1]); } catch(e){} });
      document.querySelectorAll('.product-name, .explore-product-name, .mini-name').forEach(function (el) { if (!el.hasAttribute('data-desc')) el.setAttribute('data-desc', (el.innerText || '').trim()); });
      document.querySelectorAll('.product-card, .mini-card, .explore-product-card').forEach(function (card) {
        try {
          var idx = card.getAttribute('data-index'); if (!idx) { var oc = card.getAttribute('onclick') || ''; var mm = oc.match(/openModal\((\d+)\)/); if (mm) idx = mm[1]; }
          var info = card.querySelector('.product-info, .explore-product-info, .mini-info'); if (!info) return;
          if (!info.querySelector('.product-brand') && !info.querySelector('.explore-product-brand')) { var brandEl = document.createElement('div'); brandEl.className = card.classList.contains('explore-product-card') ? 'explore-product-brand' : 'product-brand'; brandEl.textContent = ''; var priceEl = info.querySelector('.product-price, .explore-product-price, .mini-price'); if (priceEl) info.insertBefore(brandEl, priceEl); else info.appendChild(brandEl); }
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
  <div id="productModal" class="modal" aria-hidden="true">
    <div class="modal-content">
      <span class="modal-close" id="productModalClose">✕</span>
      <div class="modal-product-image" id="modalImageWrap"><img id="modalImage" src="" alt=""></div>
      <div class="modal-product-title" id="modalTitle">Product Title</div>
      <div class="modal-product-brand" id="modalBrand">Brand</div>
      <div class="modal-product-price" id="modalPrice">Rp 0</div>
      <div class="modal-product-desc" id="modalDesc">Description</div>
      <button id="modalAddBtn" class="modal-add-btn">Add to Cart</button>
    </div>
  </div>

  {{-- LOGIN / REGISTER --}}
  <dialog id="loginModal" style="border:none;border-radius:16px;padding:0;max-width:420px;width:92%">
    <form method="dialog" style="padding:22px 22px 10px">
      <h3 style="margin:0 0 16px;font:700 20px/1.2 'Inter'">Log in to <span style="color:var(--rose)">Beauté Verse</span></h3>
      <p style="font-size:14px;margin-bottom:12px;color:var(--muted)">Please log in with your email and password</p>
      <label style="display:block;margin-bottom:10px">Email<br>
        <input required type="email" placeholder="you@example.com" style="width:100%;padding:12px 14px;border:1px solid #e5e7eb;border-radius:10px;margin-top:6px">
      </label>
      <label style="display:block;margin-bottom:12px">Password<br>
        <input required type="password" placeholder="••••••••" style="width:100%;padding:12px 14px;border:1px solid #e5e7eb;border-radius:10px;margin-top:6px">
      </label>
      <p style="font-size:13px;color:var(--muted);margin:8px 0 12px">Don't have an account? <a href="#" id="openRegister" style="color:var(--rose);font-weight:700">Sign up here</a></p>
      <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:6px">
        <button type="button" id="loginCancel" style="background:#f3f4f6;border:none;padding:10px 14px;border-radius:10px">Cancel</button>
        <button value="login" style="background:var(--rose);color:#fff;border:none;padding:10px 14px;border-radius:10px;font-weight:700">Login</button>
      </div>
    </form>
  </dialog>

  <dialog id="registerModal" style="border:none;border-radius:16px;padding:0;max-width:460px;width:92%">
    <form id="registerForm" style="padding:22px 22px 14px">
      <h3 style="margin:0 0 6px;font:700 20px/1.2 'Inter'">Create Account <span style="color:var(--rose)">Beauté Verse</span></h3>
      <p style="font-size:14px;color:var(--muted);margin:0 0 14px">Sign up to continue.</p>
      <label style="display:block;margin-bottom:10px">Full Name<br>
        <input required id="regName" type="text" placeholder="Nama kamu" style="width:100%;padding:12px 14px;border:1px solid #e5e7eb;border-radius:10px;margin-top:6px">
      </label>
      <label style="display:block;margin-bottom:10px">Email<br>
        <input required id="regEmail" type="email" placeholder="you@example.com" style="width:100%;padding:12px 14px;border:1px solid #e5e7eb;border-radius:10px;margin-top:6px">
      </label>
      <label style="display:block;margin-bottom:6px">Password<br>
        <input required id="regPass" type="password" placeholder="At least 6 characters" style="width:100%;padding:12px 14px;border:1px solid #e5e7eb;border-radius:10px;margin-top:6px">
      </label>
      <label style="display:flex;align-items:center;gap:8px;font-size:14px;color:var(--muted);margin:8px 0 14px">
        <input type="checkbox" id="regAgree"> I agree to the Terms
      </label>
      <div id="regError" style="display:none;color:#ef4444;font-size:13px;margin-bottom:8px">Lengkapi data & centang persetujuan.</div>
      <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:6px">
        <button type="button" id="regCancel" style="background:#f3f4f6;border:none;padding:10px 14px;border-radius:10px">Cancel</button>
        <button type="button" id="createAccount" style="background:var(--rose);color:#fff;border:none;padding:10px 14px;border-radius:10px;font-weight:700">Create Account</button>
      </div>
    </form>
  </dialog>
@endsection

@push('scripts')
<script>
  const slides = document.getElementById('slides');
  const total = slides.children.length;
  let idx = 0;
  const dots = document.getElementById('dots');

  function renderDots(){
    dots.innerHTML = '';
    for(let i = 0; i < total; i++){
      const d = document.createElement('button');
      d.className = 'dot' + (i === idx ? ' active' : '');
      d.setAttribute('aria-label', 'Go to slide ' + (i + 1));
      // klik dot -> set index dan update
      d.onclick = () => { idx = i; update(); };
      dots.appendChild(d);
    }
  }

  function update(){
    slides.style.transform = `translateX(-${idx * 100}%)`;
    Array.from(dots.children).forEach((el, i) => {
      el.classList.toggle('active', i === idx);
    });
  }

  document.getElementById('prev').onclick = () => { idx = (idx - 1 + total) % total; update(); }
  document.getElementById('next').onclick = () => { idx = (idx + 1) % total; update(); }

  renderDots();
  update();

  // autoplay with pause on hover for prev/next/dots/slides
  let auto = setInterval(()=>{ idx = (idx + 1) % total; update(); }, 6000);
  ['prev','next','dots','slides'].forEach(id=>{
    const el = (id === 'dots' ? dots : document.getElementById(id));
    if(!el) return;
    el.addEventListener('mouseenter', ()=> clearInterval(auto));
    el.addEventListener('mouseleave', ()=>{ auto = setInterval(()=>{ idx = (idx + 1) % total; update(); }, 6000); });
  });

  // ===== Login/Register
  const loginModal = document.getElementById('loginModal');
  const registerModal = document.getElementById('registerModal');
  const shopNow = document.getElementById('shopNow');
  if (shopNow) shopNow.addEventListener('click', (e)=>{ e.preventDefault(); loginModal.showModal(); });
  document.getElementById('openLogin').addEventListener('click', (e)=>{ e.preventDefault(); loginModal.showModal(); });
  const regLink = document.getElementById('openRegister'); if(regLink){ regLink.addEventListener('click', (e)=>{e.preventDefault();registerModal.showModal()}); }
  const regName = document.getElementById('regName'); const regEmail = document.getElementById('regEmail'); const regPass = document.getElementById('regPass'); const regAgree = document.getElementById('regAgree'); const regError = document.getElementById('regError');
  document.getElementById('regCancel').addEventListener('click', ()=> registerModal.close());
  document.getElementById('loginCancel').addEventListener('click',()=> loginModal.close());
  document.getElementById('createAccount').addEventListener('click', ()=>{
    const ok = regName.value.trim() && regEmail.value.trim() && regPass.value.length >= 6 && regAgree.checked;
    if(!ok){ regError.style.display='block'; return; }
    regError.style.display='none';
    localStorage.setItem('bv_registered','1');
    registerModal.close();
    loginModal.showModal();
  });

  // ===== Cart (localStorage)
  function getCart(){ try{ return JSON.parse(localStorage.getItem('beauteCart')||'[]'); }catch(e){ return []; } }
  function saveCart(cart){
    localStorage.setItem('beauteCart', JSON.stringify(cart));
    updateCartBadge();
    renderCartItems();
  }
  function updateCartBadge(){
    const cart = getCart();
    const badge = document.querySelector('.badge');
    if(badge) badge.textContent = cart.length;
  }
  function renderCartItems(){
    const cart = getCart();
    const cartItems = document.getElementById('cartItems');
    const cartCount = document.getElementById('cartCount');
    const cartSubtotal = document.getElementById('cartSubtotal');
    const cartTotal = document.getElementById('cartTotal');
    const money = n => 'Rp ' + Number(n||0).toLocaleString('id-ID');

    cartCount.textContent = cart.length;
    if(cart.length === 0){
      cartItems.textContent = 'Your cart is empty';
      cartSubtotal.textContent = 'Rp 0';
      cartTotal.textContent = 'Rp 0';
      return;
    }
    let subtotal = 0;
    cartItems.innerHTML = cart.map((item, idx) => {
      subtotal += Number(item.price||0);
      return `
        <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:10px;padding:12px;display:flex;justify-content:space-between;align-items:center;gap:12px">
          <div style="flex:1">
            <div style="font-weight:600;color:#111827;margin-bottom:4px">${item.title||'-'}</div>
            <div style="color:#10b981;font-weight:700">${money(item.price)}</div>
          </div>
          <button style="background:#fee2e2;color:#dc2626;border:none;padding:6px 10px;border-radius:6px;cursor:pointer;font-weight:600;font-size:12px" onclick="removeFromCart(${idx})">Remove</button>
        </div>
      `;
    }).join('');
    cartSubtotal.textContent = money(subtotal);
    cartTotal.textContent = money(subtotal);
  }
  function removeFromCart(index){
    const cart = getCart();
    cart.splice(index,1);
    saveCart(cart);
  }
  window.removeFromCart = removeFromCart; // expose

  document.getElementById('openCart').addEventListener('click',(e)=>{ 
    e.preventDefault(); 
    renderCartItems();
    document.getElementById('cartModal').showModal();
  });
  document.getElementById('closeCart').addEventListener('click',()=>{document.getElementById('cartModal').close();});

  document.addEventListener('DOMContentLoaded', updateCartBadge);

  // ===== Product card modal & add-to-cart wiring
  function openProductModalFromCard(card){
    const img = card.querySelector('.product-image img');
    const title = card.querySelector('.product-name')?.textContent || '';
    const brand = card.querySelector('.product-brand')?.textContent || '';
    const priceText = card.querySelector('.product-price')?.textContent || 'Rp 0';
    const price = Number(String(priceText).replace(/[^0-9]/g,'')) || 0;

    const modal = document.getElementById('productModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalBrand = document.getElementById('modalBrand');
    const modalPrice = document.getElementById('modalPrice');
    const modalDesc = document.getElementById('modalDesc');
    const modalAdd = document.getElementById('modalAddBtn');

    modalImage.src = img ? img.src : '';
    modalTitle.textContent = title;
    modalBrand.textContent = brand;
    modalPrice.textContent = priceText;
    modalDesc.textContent = card.querySelector('.product-name')?.getAttribute('data-desc') || '';

    modalAdd.onclick = function(){
      const cart = getCart();
      cart.push({ title: title, price: price, qty: 1 });
      saveCart(cart);
      modal.style.display = 'none';
      modal.setAttribute('aria-hidden','true');
    };

    modal.style.display = 'block';
    modal.setAttribute('aria-hidden','false');
  }

  document.getElementById('productModalClose').addEventListener('click', ()=>{
    const modal = document.getElementById('productModal');
    modal.style.display = 'none';
    modal.setAttribute('aria-hidden','true');
  });

  // delegate clicks for product cards and Add to Cart buttons
  document.addEventListener('click', function(e){
    const card = e.target.closest('.product-card');
    if(card && !e.target.classList.contains('add-to-cart-btn')){
      // open modal
      openProductModalFromCard(card);
      return;
    }
    if(e.target.classList.contains('add-to-cart-btn')){
      // add to cart from card
      const cardElm = e.target.closest('.product-card');
      if(!cardElm) return;
      const title = cardElm.querySelector('.product-name')?.textContent || '';
      const priceText = cardElm.querySelector('.product-price')?.textContent || 'Rp 0';
      const price = Number(String(priceText).replace(/[^0-9]/g,'')) || 0;
      const cart = getCart();
      cart.push({ title: title, price: price, qty:1 });
      saveCart(cart);
      e.stopPropagation();
    }
  });
</script>
@endpush