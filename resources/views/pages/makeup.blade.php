@extends('layouts.app')

@section('title', 'Makeup - Beauté Verse')

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

  /* Flash sale section with background image */
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
  .product-brand{font-size:12px;color:#999;margin-bottom:8px}
  .product-price{font-size:14px;font-weight:700;color:#10b981;margin-bottom:8px}
  .price-original{font-size:12px;color:#999;text-decoration:line-through;margin-left:8px}
  .add-to-cart-btn{width:100%;background:linear-gradient(135deg,#FF1493 0%,#FF69B4 100%);color:white;border:none;padding:10px;border-radius:6px;cursor:pointer;font-weight:600;font-size:12px;transition:all .3s ease}
  .add-to-cart-btn:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(255,20,147,.3)}

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

  .free-gifts-section{padding:60px 20px;background-color:white;max-width:1200px;margin:0 auto}
  .section-title{font-size:28px;font-weight:700;color:#333;margin-bottom:40px;text-align:left}
  .gifts-grid{display:grid;grid-template-columns:repeat(6,1fr);gap:24px;margin-bottom:40px}
  .gift-card{background:white;border-radius:16px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.1);transition:all .3s ease;cursor:pointer;height:300px}
  .gift-card:hover{transform:translateY(-8px);box-shadow:0 12px 30px rgba(255,20,147,.3)}
  .gift-image{width:100%;height:100%;background:linear-gradient(135deg,#f5f5f5 0%,#e0e0e0 100%);display:flex;align-items:center;justify-content:center;color:#999;font-size:12px}
  .gift-image img{width:100%;height:100%;object-fit:cover}

  .explore-section{background:linear-gradient(135deg,#ffedf0 0%,#FFC0CB 100%);padding:60px 20px}
  .explore-container{max-width:1200px;margin:0 auto}
  .explore-title{font-size:28px;font-weight:700;color:#333;margin-bottom:40px}
  .products-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:20px;margin-bottom:40px}
  .explore-product-card{background:white;border-radius:12px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.1);transition:all .3s ease;position:relative;cursor:pointer}
  .explore-product-card:hover{transform:translateY(-8px);box-shadow:0 8px 20px rgba(0,0,0,.15)}
  .explore-product-image{width:100%;height:180px;background:linear-gradient(135deg,#f5f5f5 0%,#e0e0e0 100%);display:flex;align-items:center;justify-content:center;font-size:12px;color:#999;position:relative}
  .explore-product-image img{width:100%;height:100%;object-fit:cover}
  .explore-product-info{padding:12px}
  /* hide badges everywhere by default; only show inside flash-sale-section */
  .product-badge, .explore-product-badge { display:none }

  /* show flash sale badges inside the flash sale section */
  .flash-sale-section .product-badge,
  .flash-sale-section .explore-product-badge,
  .flash-sale-section .product-info .product-badge { display:inline-block; background-color:#FFE4E1;color:#FF1493;padding:4px 12px;border-radius:20px;font-size:11px;font-weight:600;margin-bottom:8px;text-transform:uppercase }
  .explore-product-name{font-size:12px;font-weight:600;color:#333;margin-bottom:6px;line-height:1.3}
  .explore-product-price{font-size:12px;font-weight:700;color:#10b981}

  .footer-section{background-color:white;padding:60px 20px;border-top:1px solid #f0f0f0}
  .footer-container{max-width:1200px;margin:0 auto}
  .footer-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:40px;text-align:center}
  .footer-item{display:flex;flex-direction:column;align-items:center;gap:16px}
  .footer-icon{width:60px;height:60px;border:2px solid #FF1493;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:28px;color:#FF1493}
  .footer-title{font-size:16px;font-weight:700;color:#333}
  .footer-description{font-size:13px;color:#666;line-height:1.6}

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
}
  .modal-product-title{font-size:24px;font-weight:700;color:#333;margin-bottom:8px}
  .modal-product-brand{font-size:14px;color:#999;margin-bottom:16px}
  .modal-product-price{font-size:20px;font-weight:700;color:#10b981;margin-bottom:16px}
  .modal-product-desc{font-size:14px;color:#666;line-height:1.6;margin-bottom:20px}
  .modal-add-btn{width:100%;background:linear-gradient(135deg,#FF1493 0%,#FF69B4 100%);color:white;border:none;padding:14px;border-radius:8px;cursor:pointer;font-weight:600;font-size:16px;transition:all .3s ease}
  .modal-add-btn:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(255,20,147,.3)}

/* Banner fixed size - FINAL SOLUTION */
.flash-sale-banner, .gifts-banner {
  text-align: center;
  margin:auto;
  padding: 0 20px;
  display: flex;
  justify-content: center;
  object-fit: contain;
  align-items: center;
  width: 100%;
  height: auto;
  max-width: 1200px;
}

.banner-image {
  width: 100%;
  max-width: 1200px;
  height: 220px; /* Ukuran optimal */
  object-fit: cover;
  object-position: center;
  border-radius: 12px;
  display: block;
  margin: 0 auto;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}


  .hidden{display:none}

  /* allow the hidden wrapper to become transparent to the grid when shown
    so its children participate as direct grid items. Keep .hidden to hide it. */
  #moreExplore { display: contents; }
  #moreExplore.hidden { display: none; }

  /* initially show only first 10 items (5 columns x 2 rows) in explore grid */
  #exploreGrid:not(.expanded) > * { display: none; }
  #exploreGrid:not(.expanded) > *:nth-child(-n+10) { display: block; }


  /* FIX ALIGNMENT - TAMBAHKAN INI DI BAGIAN CSS */
.product-card, .mini-card, .explore-product-card {
  display: flex;
  flex-direction: column;
}

.product-info, .mini-info {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.product-price, .mini-price {
  margin-top: auto;
  margin-bottom: 8px;
}

.add-to-cart-btn {
  margin-top: auto;
}

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

  <!-- FLASH SALE SECTION -->
  <section class="flash-sale-section">
    <div class="flash-sale-banner">
  <img src="{{ asset('images/flashsale.jpg') }}" alt="Flash Sale" class="banner-image"/>
</div>
    <div class="carousel-container">
      <div class="carousel-wrapper">
        <div class="carousel" id="flashSaleCarousel">
          <!-- First 10 products (Flash Sale) -->
          <div class="product-card" data-index="0" onclick="openModal(0)">
  <div class="product-image"><img src="{{ asset('images/image1.jpg') }}" alt="product"></div>
  <div class="discount-badge">35%</div>
  <div class="product-info">
    <!-- Konten utama -->
    <div class="product-content">
      <div class="product-badge">Flash Sale</div>
      <div class="product-name">Loveshine Lip Oil Stick YSL Beauty</div>
      <div class="product-brand">YSL Beauty</div>
    </div>
    <!-- Footer dengan harga dan button -->
    <div class="product-footer">
      <div class="product-price">Rp507.000 <span class="price-original">Rp780.000</span></div>
      <button class="add-to-cart-btn" onclick="addToCart(0, event)">Add to Cart</button>
    </div>
  </div>
</div>
          <div class="product-card" data-index="1" onclick="openModal(1)">
            <div class="product-image"><img src="{{ asset('images/image2.jpg') }}" alt="product"></div>
            <div class="discount-badge">30%</div>
            <div class="product-info">
              <div class="product-badge">Flash Sale</div>
              <div class="product-name">Gloss Bomb Universal Lip Luminizer</div>
              <div class="product-brand">Fenty Beauty</div>
              <div class="product-price">Rp224.000 <span class="price-original">Rp320.000</span></div>
              <button class="add-to-cart-btn" onclick="addToCart(1, event)">Add to Cart</button>
            </div>
          </div>
          <div class="product-card" data-index="2" onclick="openModal(2)">
            <div class="product-image"><img src="{{ asset('images/image3.jpg') }}" alt="product"></div>
            <div class="discount-badge">25%</div>
            <div class="product-info">
              <div class="product-badge">Flash Sale</div>
              <div class="product-name">Airbrush Flawless Foundation</div>
              <div class="product-brand">Charlotte Tilbury</div>
              <div class="product-price">Rp675.000 <span class="price-original">Rp900.000</span></div>
              <button class="add-to-cart-btn" onclick="addToCart(2, event)">Add to Cart</button>
            </div>
          </div>
          <div class="product-card" data-index="3" onclick="openModal(3)">
            <div class="product-image"><img src="{{ asset('images/image4.jpg') }}" alt="product"></div>
            <div class="discount-badge">28%</div>
            <div class="product-info">
              <div class="product-badge">Flash Sale</div>
              <div class="product-name">Radiant Creamy Concealer</div>
              <div class="product-brand">NARS</div>
              <div class="product-price">Rp352.800 <span class="price-original">Rp490.000</span></div>
              <button class="add-to-cart-btn" onclick="addToCart(3, event)">Add to Cart</button>
            </div>
          </div>
          <div class="product-card" data-index="4" onclick="openModal(4)">
            <div class="product-image"><img src="{{ asset('images/image5.jpg') }}" alt="product"></div>
            <div class="discount-badge">32%</div>
            <div class="product-info">
              <div class="product-badge">Flash Sale</div>
              <div class="product-name">Hoola Matte Powder Bronzer</div>
              <div class="product-brand">Benefit Cosmetics</div>
              <div class="product-price">Rp306.000 <span class="price-original">Rp450.000</span></div>
              <button class="add-to-cart-btn" onclick="addToCart(4, event)">Add to Cart</button>
            </div>
          </div>
          <div class="product-card" data-index="5" onclick="openModal(5)">
            <div class="product-image"><img src="{{ asset('images/image6.jpg') }}" alt="product"></div>
            <div class="discount-badge">26%</div>
            <div class="product-info">
              <div class="product-badge">Flash Sale</div>
              <div class="product-name">Soft Pinch Liquid Blush</div>
              <div class="product-brand">Rare Beauty</div>
              <div class="product-price">Rp281.200 <span class="price-original">Rp380.000</span></div>
              <button class="add-to-cart-btn" onclick="addToCart(5, event)">Add to Cart</button>
            </div>
          </div>
          <div class="product-card" data-index="6" onclick="openModal(6)">
            <div class="product-image"><img src="{{ asset('images/image7.jpg') }}" alt="product"></div>
            <div class="discount-badge">24%</div>
            <div class="product-info">
              <div class="product-badge">Flash Sale</div>
              <div class="product-name">Positive Light Liquid Luminizer</div>
              <div class="product-brand">Rare Beauty</div>
              <div class="product-price">Rp304.000 <span class="price-original">Rp400.000</span></div>
              <button class="add-to-cart-btn" onclick="addToCart(6, event)">Add to Cart</button>
            </div>
          </div>
          <div class="product-card" data-index="7" onclick="openModal(7)">
            <div class="product-image"><img src="{{ asset('images/image8.jpg') }}" alt="product"></div>
            <div class="discount-badge">29%</div>
            <div class="product-info">
              <div class="product-badge">Flash Sale</div>
              <div class="product-name">Master Mattes Palette – The Neutrals</div>
              <div class="product-brand">Makeup by Mario</div>
              <div class="product-price">Rp532.500 <span class="price-original">Rp750.000</span></div>
              <button class="add-to-cart-btn" onclick="addToCart(7, event)">Add to Cart</button>
            </div>
          </div>
          <div class="product-card" data-index="8" onclick="openModal(8)">
            <div class="product-image"><img src="{{ asset('images/image9.jpg') }}" alt="product"></div>
            <div class="discount-badge">27%</div>
            <div class="product-info">
              <div class="product-badge">Flash Sale</div>
              <div class="product-name">Epic Ink Waterproof Liquid Eyeliner</div>
              <div class="product-brand">NYX Professional Makeup</div>
              <div class="product-price">Rp160.600 <span class="price-original">Rp220.000</span></div>
              <button class="add-to-cart-btn" onclick="addToCart(8, event)">Add to Cart</button>
            </div>
          </div>
          <div class="product-card" data-index="9" onclick="openModal(9)">
            <div class="product-image"><img src="{{ asset('images/image10.jpg') }}" alt="product"></div>
            <div class="discount-badge">31%</div>
            <div class="product-info">
              <div class="product-badge">Flash Sale</div>
              <div class="product-name">Gimme Brow+ Volumizing Eyebrow Gel</div>
              <div class="product-brand">Benefit Cosmetics</div>
              <div class="product-price">Rp296.700 <span class="price-original">Rp430.000</span></div>
              <button class="add-to-cart-btn" onclick="addToCart(9, event)">Add to Cart</button>
            </div>
          </div>
        </div>
        <button class="carousel-btn prev" onclick="scrollCarousel('flashSaleCarousel', -1)">‹</button>
        <button class="carousel-btn next" onclick="scrollCarousel('flashSaleCarousel', 1)">›</button>
      </div>
    </div>
  </section>

  <!-- CATEGORY TABS -->
  <section class="category-section">
    <ul class="category-tabs">
      <li onclick="switchCategory('bestie')" class="active">Bestie Deals For You</li>
      <li onclick="switchCategory('newbeauty')">New Beauty Besties</li>
      <li onclick="switchCategory('musthave')">Must-have Beauties</li>
    </ul>

    <div class="category-carousel" id="bestie">
      <div class="carousel" id="bestieCarousel">
  <div class="mini-card" data-index="10" onclick="openModal(10)">
    <div class="product-image"><img src="{{ asset('images/image11.jpg') }}" alt="product"></div>
    <div class="product-info">
      <div class="product-badge">Bestie</div>
      <div class="product-name">Lash Sensational Sky High Mascara</div>
      <div class="product-brand">Maybelline</div>
      <div class="product-price">Rp210.000</div>
      <button class="add-to-cart-btn" onclick="addToCart(10, event)">Add to Cart</button>
    </div>
  </div>
  <div class="mini-card" data-index="11" onclick="openModal(11)">
    <div class="product-image"><img src="{{ asset('images/image12.jpg') }}" alt="product"></div>
    <div class="product-info">
      <div class="product-badge">Bestie</div>
      <div class="product-name">Smushy Matte Lip Balm</div>
      <div class="product-brand">Glossier</div>
      <div class="product-price">Rp260.000</div>
      <button class="add-to-cart-btn" onclick="addToCart(11, event)">Add to Cart</button>
    </div>
  </div>
  <div class="mini-card" data-index="12" onclick="openModal(12)">
    <div class="product-image"><img src="{{ asset('images/image13.jpg') }}" alt="product"></div>
    <div class="product-info">
      <div class="product-badge">Bestie</div>
      <div class="product-name">A Fine Romance Lipstick</div>
      <div class="product-brand">Charlotte Tilbury</div>
      <div class="product-price">Rp450.000</div>
      <button class="add-to-cart-btn" onclick="addToCart(12, event)">Add to Cart</button>
    </div>
  </div>
  <div class="mini-card" data-index="13" onclick="openModal(13)">
    <div class="product-image"><img src="{{ asset('images/image14.jpg') }}" alt="product"></div>
    <div class="product-info">
      <div class="product-badge">Bestie</div>
      <div class="product-name">Skin Fetish: Glass 001 Setting Spray</div>
      <div class="product-brand">Hourglass</div>
      <div class="product-price">Rp620.000</div>
      <button class="add-to-cart-btn" onclick="addToCart(13, event)">Add to Cart</button>
    </div>
  </div>
  <div class="mini-card" data-index="14" onclick="openModal(14)">
    <div class="product-image"><img src="{{ asset('images/image15.jpg') }}" alt="product"></div>
    <div class="product-info">
      <div class="product-badge">Bestie</div>
      <div class="product-name">Luminous Silk Natural Glow Foundation</div>
      <div class="product-brand">Giorgio Armani</div>
      <div class="product-price">Rp950.000</div>
      <button class="add-to-cart-btn" onclick="addToCart(14, event)">Add to Cart</button>
    </div>
  </div>
      </div>
    </div>

    <div class="category-carousel hidden" id="newbeauty">
      <div class="carousel" id="newbeautyCarousel">
  <div class="mini-card" data-index="15" onclick="openModal(15)">
    <div class="product-image"><img src="{{ asset('images/image16.jpg') }}" alt="product"></div>
    <div class="product-info">
      <div class="product-badge">New</div>
      <div class="product-name">Yummy Skin Glow Serum</div>
      <div class="product-brand">The Ordinary</div>
      <div class="product-price">Rp540.000</div>
      <button class="add-to-cart-btn" onclick="addToCart(15, event)">Add to Cart</button>
    </div>
  </div>
  <div class="mini-card" data-index="16" onclick="openModal(16)">
    <div class="product-image"><img src="{{ asset('images/image17.jpg') }}" alt="product"></div>
    <div class="product-info">
      <div class="product-badge">New</div>
      <div class="product-name">Neon Lashes Mascara</div>
      <div class="product-brand">Benefit</div>
      <div class="product-price">Rp330.000</div>
      <button class="add-to-cart-btn" onclick="addToCart(16, event)">Add to Cart</button>
    </div>
  </div>
  <div class="mini-card" data-index="17" onclick="openModal(17)">
    <div class="product-image"><img src="{{ asset('images/image18.jpg') }}" alt="product"></div>
    <div class="product-info">
      <div class="product-badge">New</div>
      <div class="product-name">Cruelty Free Eyeshadow Palette</div>
      <div class="product-brand">ColourPop</div>
      <div class="product-price">Rp240.000</div>
      <button class="add-to-cart-btn" onclick="addToCart(17, event)">Add to Cart</button>
    </div>
  </div>
  <div class="mini-card" data-index="18" onclick="openModal(18)">
    <div class="product-image"><img src="{{ asset('images/image19.jpg') }}" alt="product"></div>
    <div class="product-info">
      <div class="product-badge">New</div>
      <div class="product-name">Tartelette Double Take Shadow Palette</div>
      <div class="product-brand">Tarte</div>
      <div class="product-price">Rp770.000</div>
      <button class="add-to-cart-btn" onclick="addToCart(18, event)">Add to Cart</button>
    </div>
  </div>
  <div class="mini-card" data-index="19" onclick="openModal(19)">
    <div class="product-image"><img src="{{ asset('images/image20.jpg') }}" alt="product"></div>
    <div class="product-info">
      <div class="product-badge">New</div>
      <div class="product-name">Cloud Paint Blush</div>
      <div class="product-brand">Glossier</div>
      <div class="product-price">Rp280.000</div>
      <button class="add-to-cart-btn" onclick="addToCart(19, event)">Add to Cart</button>
    </div>
  </div>
      </div>
    </div>

    <div class="category-carousel hidden" id="musthave">
      <div class="carousel" id="musthaveCarousel">
  <div class="mini-card" data-index="0" onclick="openModal(0)">
    <div class="product-image"><img src="{{ asset('images/image1.jpg') }}" alt="product"></div>
    <div class="product-info">
      <div class="product-badge">Must-have</div>
      <div class="product-name">Loveshine Lip Oil Stick</div>
      <div class="product-brand">YSL Beauty</div>
      <div class="product-price">Rp780.000</div>
      <button class="add-to-cart-btn" onclick="addToCart(0, event)">Add to Cart</button>
    </div>
  </div>
  <div class="mini-card" data-index="1" onclick="openModal(1)">
    <div class="product-image"><img src="{{ asset('images/image2.jpg') }}" alt="product"></div>
    <div class="product-info">
      <div class="product-badge">Must-have</div>
      <div class="product-name">Gloss Bomb Universal Lip Luminizer</div>
      <div class="product-brand">Fenty Beauty</div>
      <div class="product-price">Rp320.000</div>
      <button class="add-to-cart-btn" onclick="addToCart(1, event)">Add to Cart</button>
    </div>
  </div>
  <div class="mini-card" data-index="2" onclick="openModal(2)">
    <div class="product-image"><img src="{{ asset('images/image3.jpg') }}" alt="product"></div>
    <div class="product-info">
      <div class="product-badge">Must-have</div>
      <div class="product-name">Airbrush Flawless Foundation</div>
      <div class="product-brand">Charlotte Tilbury</div>
      <div class="product-price">Rp900.000</div>
      <button class="add-to-cart-btn" onclick="addToCart(2, event)">Add to Cart</button>
    </div>
  </div>
  <div class="mini-card" data-index="3" onclick="openModal(3)">
    <div class="product-image"><img src="{{ asset('images/image4.jpg') }}" alt="product"></div>
    <div class="product-info">
      <div class="product-badge">Must-have</div>
      <div class="product-name">Radiant Creamy Concealer</div>
      <div class="product-brand">NARS</div>
      <div class="product-price">Rp490.000</div>
      <button class="add-to-cart-btn" onclick="addToCart(3, event)">Add to Cart</button>
    </div>
  </div>
  <div class="mini-card" data-index="4" onclick="openModal(4)">
    <div class="product-image"><img src="{{ asset('images/image5.jpg') }}" alt="product"></div>
    <div class="product-info">
      <div class="product-badge">Must-have</div>
      <div class="product-name">Hoola Matte Powder Bronzer</div>
      <div class="product-brand">Benefit Cosmetics</div>
      <div class="product-price">Rp450.000</div>
      <button class="add-to-cart-btn" onclick="addToCart(4, event)">Add to Cart</button>
    </div>
  </div>
      </div>
    </div>
  </section>

<!-- FREE GIFTS -->
<section class="free-gifts-section">
  <div class="gifts-banner">
    <img src="{{ asset('images/gift.jpg') }}" alt="Free Gifts" class="banner-image"/>
  </div>
</section>

  <!-- EXPLORE MORE -->
  <section class="explore-section">
    <div class="explore-container">
      <h2 class="explore-title">More to explore for you, Bestie!</h2>
      <div class="products-grid" id="exploreGrid">
        {{-- 20 products list (static cards) --}}
        <div class="explore-product-card" data-index="0" onclick="openModal(0)">
          <div class="product-image"><img src="{{ asset('images/image1.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">Loveshine Lip Oil Stick</div>
            <div class="product-brand">YSL Beauty</div>
            <div class="product-price">Rp780.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(0, event)">Add to Cart</button>
          </div>
        </div>
        <div class="explore-product-card" data-index="1" onclick="openModal(1)">
          <div class="product-image"><img src="{{ asset('images/image2.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">Gloss Bomb Universal Lip Luminizer</div>
            <div class="product-brand">Fenty Beauty</div>
            <div class="product-price">Rp320.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(1, event)">Add to Cart</button>
          </div>
        </div>
        <div class="explore-product-card" data-index="2" onclick="openModal(2)">
          <div class="product-image"><img src="{{ asset('images/image3.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">Airbrush Flawless Foundation</div>
            <div class="product-brand">Charlotte Tilbury</div>
            <div class="product-price">Rp900.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(2, event)">Add to Cart</button>
          </div>
        </div>
        <div class="explore-product-card" data-index="3" onclick="openModal(3)">
          <div class="product-image"><img src="{{ asset('images/image4.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">Radiant Creamy Concealer</div>
            <div class="product-brand">NARS</div>
            <div class="product-price">Rp490.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(3, event)">Add to Cart</button>
          </div>
        </div>
        <div class="explore-product-card" data-index="4" onclick="openModal(4)">
          <div class="product-image"><img src="{{ asset('images/image5.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">Hoola Matte Powder Bronzer</div>
            <div class="product-brand">Benefit Cosmetics</div>
            <div class="product-price">Rp450.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(4, event)">Add to Cart</button>
          </div>
        </div>
        <div class="explore-product-card" data-index="5" onclick="openModal(5)">
          <div class="product-image"><img src="{{ asset('images/image6.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">Soft Pinch Liquid Blush</div>
            <div class="product-brand">Rare Beauty</div>
            <div class="product-price">Rp380.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(5, event)">Add to Cart</button>
          </div>
        </div>
        <div class="explore-product-card" data-index="6" onclick="openModal(6)">
          <div class="product-image"><img src="{{ asset('images/image7.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">Positive Light Liquid Luminizer</div>
            <div class="product-brand">Rare Beauty</div>
            <div class="product-price">Rp400.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(6, event)">Add to Cart</button>
          </div>
        </div>
        <div class="explore-product-card" data-index="7" onclick="openModal(7)">
          <div class="product-image"><img src="{{ asset('images/image8.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">Master Mattes Palette – The Neutrals</div>
            <div class="product-brand">Makeup by Mario</div>
            <div class="product-price">Rp750.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(7, event)">Add to Cart</button>
          </div>
        </div>
        <div class="explore-product-card" data-index="8" onclick="openModal(8)">
          <div class="product-image"><img src="{{ asset('images/image9.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">Epic Ink Waterproof Liquid Eyeliner</div>
            <div class="product-brand">NYX Professional Makeup</div>
            <div class="product-price">Rp220.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(8, event)">Add to Cart</button>
          </div>
        </div>
        <div class="explore-product-card" data-index="9" onclick="openModal(9)">
          <div class="product-image"><img src="{{ asset('images/image10.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">Gimme Brow+ Volumizing Eyebrow Gel</div>
            <div class="product-brand">Benefit Cosmetics</div>
            <div class="product-price">Rp430.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(9, event)">Add to Cart</button>
          </div>
        </div>
        <div id="moreExplore" class="hidden">
        <div class="explore-product-card" data-index="10" onclick="openModal(10)">
          <div class="product-image"><img src="{{ asset('images/image11.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">Lash Sensational Sky High Mascara</div>
            <div class="product-brand">Maybelline</div>
            <div class="product-price">Rp210.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(10, event)">Add to Cart</button>
          </div>
        </div>
        <div class="explore-product-card" data-index="11" onclick="openModal(11)">
          <div class="product-image"><img src="{{ asset('images/image12.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">Smushy Matte Lip Balm</div>
            <div class="product-brand">Glossier</div>
            <div class="product-price">Rp260.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(11, event)">Add to Cart</button>
          </div>
        </div>
        <div class="explore-product-card" data-index="12" onclick="openModal(12)">
          <div class="product-image"><img src="{{ asset('images/image13.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">A Fine Romance Lipstick</div>
            <div class="product-brand">Charlotte Tilbury</div>
            <div class="product-price">Rp450.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(12, event)">Add to Cart</button>
          </div>
        </div>
  <div class="explore-product-card" data-index="13" onclick="openModal(13)">
          <div class="product-image"><img src="{{ asset('images/image14.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">Skin Fetish: Glass 001 Setting Spray</div>
            <div class="product-brand">Hourglass</div>
            <div class="product-price">Rp620.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(13, event)">Add to Cart</button>
          </div>
        </div>
  <div class="explore-product-card" data-index="14" onclick="openModal(14)">
          <div class="product-image"><img src="{{ asset('images/image15.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">Luminous Silk Natural Glow Foundation</div>
            <div class="product-brand">Giorgio Armani</div>
            <div class="product-price">Rp950.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(14, event)">Add to Cart</button>
          </div>
        </div>
  <div class="explore-product-card" data-index="15" onclick="openModal(15)">
          <div class="product-image"><img src="{{ asset('images/image16.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">Yummy Skin Glow Serum</div>
            <div class="product-brand">The Ordinary</div>
            <div class="product-price">Rp540.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(15, event)">Add to Cart</button>
          </div>
        </div>
  <div class="explore-product-card" data-index="16" onclick="openModal(16)">
          <div class="product-image"><img src="{{ asset('images/image17.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">Neon Lashes Mascara</div>
            <div class="product-brand">Benefit</div>
            <div class="product-price">Rp330.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(16, event)">Add to Cart</button>
          </div>
        </div>
  <div class="explore-product-card" data-index="17" onclick="openModal(17)">
          <div class="product-image"><img src="{{ asset('images/image18.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">Cruelty Free Eyeshadow Palette</div>
            <div class="product-brand">ColourPop</div>
            <div class="product-price">Rp240.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(17, event)">Add to Cart</button>
          </div>
        </div>
  <div class="explore-product-card" data-index="18" onclick="openModal(18)">
          <div class="product-image"><img src="{{ asset('images/image19.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">Tartelette Double Take Shadow Palette</div>
            <div class="product-brand">Tarte</div>
            <div class="product-price">Rp770.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(18, event)">Add to Cart</button>
          </div>
        </div>
  <div class="explore-product-card" data-index="19" onclick="openModal(19)">
          <div class="product-image"><img src="{{ asset('images/image20.jpg') }}" alt="product"></div>
          <div class="product-info">
            <div class="product-badge">Makeup</div>
            <div class="product-name">Cloud Paint Blush</div>
            <div class="product-brand">Glossier</div>
            <div class="product-price">Rp280.000</div>
            <button class="add-to-cart-btn" onclick="addToCart(19, event)">Add to Cart</button>
          </div>
        </div>
        </div> <!-- #moreExplore -->
      </div>
      <div style="text-align:center;margin-top:18px">
        <button id="loadMoreBtn" class="see-all-btn" onclick="loadMoreExplore()">Load more products</button>
      </div>
    </div>
  </section>

  <script>
    function loadMoreExplore() {
      var grid = document.getElementById('exploreGrid');
      var more = document.getElementById('moreExplore');
      var btn = document.getElementById('loadMoreBtn');
      if (more) more.classList.remove('hidden');
      if (grid) grid.classList.add('expanded');
      if (btn) btn.style.display = 'none';
    }
  </script>

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
    // Normalize product card markup at runtime so all cards follow the "Loveshine" canonical structure
    document.addEventListener('DOMContentLoaded', function () {
      // Add data-index from onclick openModal(...) when missing
      document.querySelectorAll('[onclick]').forEach(function (el) {
        try {
          var onclick = el.getAttribute('onclick') || '';
          var m = onclick.match(/openModal\((\d+)\)/);
          if (m && !el.hasAttribute('data-index')) el.setAttribute('data-index', m[1]);
        } catch (e) { /* ignore */ }
      });

      // Ensure product name elements have a data-desc attribute (use the text as fallback)
      document.querySelectorAll('.product-name, .explore-product-name, .mini-name').forEach(function (el) {
        if (!el.hasAttribute('data-desc')) el.setAttribute('data-desc', (el.innerText || '').trim());
      });

      // Add missing add-to-cart buttons and ensure brand node exists inside product info blocks
      document.querySelectorAll('.product-card, .mini-card, .explore-product-card').forEach(function (card) {
        try {
          var idx = card.getAttribute('data-index');
          if (!idx) {
            var oc = card.getAttribute('onclick') || '';
            var mm = oc.match(/openModal\((\d+)\)/);
            if (mm) idx = mm[1];
          }
          var info = card.querySelector('.product-info, .explore-product-info, .mini-info');
          if (!info) return;

          // Brand
          if (!info.querySelector('.product-brand') && !info.querySelector('.explore-product-brand')) {
            var brandEl = document.createElement('div');
            brandEl.className = card.classList.contains('explore-product-card') ? 'explore-product-brand' : 'product-brand';
            brandEl.textContent = '';
            // insert before price if present, otherwise append
            var priceEl = info.querySelector('.product-price, .explore-product-price, .mini-price');
            if (priceEl) info.insertBefore(brandEl, priceEl);
            else info.appendChild(brandEl);
          }

          // Add-to-cart button
          if (!info.querySelector('.add-to-cart-btn') && typeof idx !== 'undefined') {
            var btn = document.createElement('button');
            btn.className = 'add-to-cart-btn';
            btn.textContent = 'Add to Cart';
            btn.setAttribute('onclick', 'addToCart(' + idx + ', event)');
            info.appendChild(btn);
          }
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
        } catch (e) { /* ignore per-item errs */ }
      });
    });
  </script>
  <div id="productModal" class="modal">
    <div class="modal-content">
      <span class="modal-close" onclick="closeModal()">&times;</span>
      <div class="modal-product-image"><img id="modalImage" src="" alt="product" style="display:none;max-width:100%;height:auto;border-radius:10px" onerror="this.style.display='none';"></div>
      <h2 class="modal-product-title" id="modalTitle">Product Name</h2>
      <p class="modal-product-brand" id="modalBrand">Brand</p>
      <p class="modal-product-price" id="modalPrice">Rp0</p>
      <p class="modal-product-desc" id="modalDesc">Description</p>
      <button class="modal-add-btn" id="modalAddBtn" onclick="addToCartFromModal(event)">Add to Cart</button>
    </div>
  </div>

  <!-- CART & LOGIN DIALOGS -->
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
  {title:"Loveshine Lip Oil Stick",brand:"YSL Beauty",price:780000,desc:"A tinted lip oil that delivers a soft shine and deep hydration. Infused with passion fruit and fig pulp extract, it nourishes lips while giving them a plump, healthy look.", image: "{{ asset('images/image1.jpg') }}"},
  {title:"Gloss Bomb Universal Lip Luminizer",brand:"Fenty Beauty",price:320000,desc:"A non-sticky, high-shine lip gloss enriched with shea butter for intense hydration. The large applicator ensures even coverage and a plumping effect.", image: "{{ asset('images/image2.jpg') }}"},
  {title:"Airbrush Flawless Foundation",brand:"Charlotte Tilbury",price:900000,desc:"A full-coverage, weightless foundation that gives a flawless, airbrushed finish. Its silky formula adapts to skin tone and provides a smooth, natural look.", image: "{{ asset('images/image3.jpg') }}"},
  {title:"Radiant Creamy Concealer",brand:"NARS",price:490000,desc:"A creamy, high-coverage concealer that hides dark circles, blemishes, and redness without creasing. Its hydrating formula glides on smoothly.", image: "{{ asset('images/image4.jpg') }}"},
  {title:"Hoola Matte Powder Bronzer",brand:"Benefit Cosmetics",price:450000,desc:"An iconic matte bronzer delivering a warm, natural-looking contour. Smooth texture blends effortlessly and is perfect for sculpting cheekbones.", image: "{{ asset('images/image5.jpg') }}"},
  {title:"Soft Pinch Liquid Blush",brand:"Rare Beauty",price:380000,desc:"A weightless, long-lasting liquid blush that blends seamlessly for a natural flush. Its hydrating formula gives cheeks a soft, healthy glow.", image: "{{ asset('images/image6.jpg') }}"},
  {title:"Positive Light Liquid Luminizer",brand:"Rare Beauty",price:400000,desc:"A silky liquid highlighter that melts into skin for a soft, natural glow. Lightweight formula enhances cheekbones without glitter or heaviness.", image: "{{ asset('images/image7.jpg') }}"},
  {title:"Master Mattes Palette – The Neutrals",brand:"Makeup by Mario",price:750000,desc:"A 12-shade matte eyeshadow palette inspired by natural skin tones. Perfect for everyday to glam looks, its blendable formula allows seamless transitions.", image: "{{ asset('images/image8.jpg') }}"},
  {title:"Epic Ink Waterproof Liquid Eyeliner",brand:"NYX Professional Makeup",price:220000,desc:"A highly-pigmented, waterproof liquid eyeliner with a precise brush tip for perfect wings every time. Smooth formula glides easily and stays put.", image: "{{ asset('images/image9.jpg') }}"},
  {title:"Gimme Brow+ Volumizing Eyebrow Gel",brand:"Benefit Cosmetics",price:430000,desc:"A tinted eyebrow gel with microfibers that create natural-looking fullness and hold all day long. Smooth and blendable, it shapes brows perfectly.", image: "{{ asset('images/image10.jpg') }}"},
  {title:"Lash Sensational Sky High Mascara",brand:"Maybelline New York",price:210000,desc:"Viral lengthening mascara with a flexible brush for lifted, voluminous lashes from root to tip. Lightweight and non-clumpy, it separates each lash.", image: "{{ asset('images/image11.jpg') }}"},
  {title:"Smushy Matte Lip Balm",brand:"Refy",price:260000,desc:"A matte tinted lip balm that feels weightless and nourishing. Soft, velvety texture glides smoothly and provides a subtle, flattering color.", image: "{{ asset('images/image12.jpg') }}"},
  {title:"A Fine Romance Lipstick",brand:"ILIA",price:450000,desc:"A clean, creamy lipstick that hydrates lips while providing rich pigment and long-lasting comfort. Smooth formula glides easily.", image: "{{ asset('images/image13.jpg') }}"},
  {title:"Skin Fetish: Glass 001 Setting Spray",brand:"Pat McGrath Labs",price:620000,desc:"A luxury setting spray that gives a luminous, glass-skin finish while keeping makeup in place. Lightweight mist refreshes skin and locks in makeup.", image: "{{ asset('images/image14.jpg') }}"},
  {title:"Luminous Silk Natural Glow Foundation",brand:"Armani Beauty",price:950000,desc:"A cult-favorite foundation that provides smooth, buildable coverage with a natural, radiant glow. Lightweight and silky, it blends seamlessly.", image: "{{ asset('images/image15.jpg') }}"},
  {title:"Yummy Skin Glow Serum",brand:"Danessa Myricks Beauty",price:540000,desc:"A serum-primer hybrid that preps skin for makeup with a dewy glow and skincare benefits. Hydrating and lightweight, it creates a smooth canvas.", image: "{{ asset('images/image16.jpg') }}"},
  {title:"Neon Lashes Mascara",brand:"Huda Beauty",price:330000,desc:"A bold, colorful mascara that defines lashes with intense pigment for high-impact, fashion-forward looks. Adds drama, volume, and lift.", image: "{{ asset('images/image17.jpg') }}"},
  {title:"Cruelty Free Eyeshadow Palette",brand:"SHEGLAM",price:240000,desc:"A budget-friendly, cruelty-free eyeshadow palette featuring trendy shades with rich pigmentation. Smooth and blendable formula.", image: "{{ asset('images/image18.jpg') }}"},
  {title:"Tartelette Double Take Shadow Palette",brand:"Tarte",price:770000,desc:"A dual-finish palette with matte and shimmer tones for seamless day-to-night transitions. Highly pigmented and blendable.", image: "{{ asset('images/image19.jpg') }}"},
  {title:"Cloud Paint Blush",brand:"Glossier",price:280000,desc:"A gel-cream blush that blends effortlessly for a sheer, flushed look. Lightweight and buildable, it gives a natural glow to cheeks.", image: "{{ asset('images/image20.jpg') }}"}
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
      if(p && p.image){
        modalImg.src = p.image;
        modalImg.style.display = 'block';
      } else {
        modalImg.style.display = 'none';
      }
    }
    modal.style.display = 'block';
  }

  function closeModal(){
    document.getElementById('productModal').style.display = 'none';
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

  window.onclick = function(e){
    const m = document.getElementById('productModal');
    if(e.target == m) m.style.display = 'none';
  }

  function filterProducts(searchTerm){
    const flashSaleCards = document.querySelectorAll('#flashSaleCarousel .product-card');
    const categoryCards = document.querySelectorAll('.category-carousel .mini-card');
    const exploreCards = document.querySelectorAll('.explore-product-card');

    flashSaleCards.forEach(card => {
      const productName = card.querySelector('.product-name').textContent.toLowerCase();
      card.style.display = productName.includes(searchTerm.toLowerCase()) ? '' : 'none';
    });

    categoryCards.forEach(card => {
      const productName = card.querySelector('.mini-name').textContent.toLowerCase();
      card.style.display = productName.includes(searchTerm.toLowerCase()) ? '' : 'none';
    });

    exploreCards.forEach(card => {
      const productName = card.querySelector('.explore-product-name').textContent.toLowerCase();
      card.style.display = productName.includes(searchTerm.toLowerCase()) ? '' : 'none';
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