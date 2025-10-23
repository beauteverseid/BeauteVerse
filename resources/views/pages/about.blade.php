@extends('layouts.app')

@section('title', 'About — Beauté Verse')

@section('content')
  <style>
    :root{
      --container:1300px;
      --ink:#3a2e3f;
      --muted:#7b6f80;
      --rose:#ff7ab8;
      --bg:linear-gradient(180deg,#fff7fb,#ffeaf4);
      --card:#ffffff;
      --border:#f7d6e6;
      --shadow:0 20px 50px rgba(255,182,216,.25);
      --radius:20px
    }
    *{box-sizing:border-box}
    html,body{margin:0;background:var(--bg);color:var(--ink);font:17px/1.75 'Lora',serif}
    a{color:inherit;text-decoration:none}
    .container{max-width:var(--container);margin:auto;padding:0 20px}
    header{padding:18px 0;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between}
    .brand{font-family:'Playfair Display',serif;font-weight:700;font-size:28px;letter-spacing:.3px}
    .back{color:var(--rose);font-weight:600}

    .hero{padding:28px 0}
    .hero-wrap{position:relative;border-radius:22px;overflow:hidden;box-shadow:var(--shadow)}
    .hero img{width:100%;height:360px;object-fit:cover;display:block;filter:saturate(1.05)}
    .hero .overlay{position:absolute;inset:0;background:linear-gradient(180deg,rgba(255,255,255,.0),rgba(255,240,247,.85))}

    h1{font-family:'Playfair Display',serif;font-weight:700;font-size:40px;margin:18px 0 8px;color:var(--rose)}
    h2{font-family:'Playfair Display',serif;font-weight:700;font-size:26px;margin:0 0 8px;color:var(--rose)}
    h3{font-family:'Playfair Display',serif;font-weight:600;font-size:18px;margin:0 0 6px;letter-spacing:.8px;color:var(--rose)}
    p.lead{color:var(--muted);margin:0}

    .intro{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:24px;box-shadow:var(--shadow)}

    .grid{display:grid;grid-template-columns:1.2fr .8fr;gap:22px;margin:22px 0 50px}
    .card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow)}
    .pad{padding:22px}

    .values{display:grid;grid-template-columns:1fr 1fr;gap:16px}
    .value{background:#fff;border:1px solid var(--border);border-radius:16px;padding:16px}

    footer{padding:26px 0;border-top:1px solid var(--border);color:var(--rose);text-align:center}

    @media (max-width:1000px){.grid{grid-template-columns:1fr}.hero img{height:260px}.values{grid-template-columns:1fr}}
  </style>

  <header class="container">
    <div class="brand">Beauté Verse</div>
    <a class="back" href="{{ route('home') }}">← Back to Home</a>
  </header>

  <main class="container">
    <section class="hero" aria-label="About illustration">
      <div class="hero-wrap">
        <img alt="Beauté Verse community illustration" src="images/about.jpg"/>
        <div class="overlay"></div>
      </div>
    </section>

    <section class="intro">
      <h1>About Beauté Verse</h1>
      <p class="lead">
        Beauté Verse was born from a Web Programming assignment during the 3rd semester at the Informatics Engineering Department of Institut Teknologi Sepuluh Nopember (ITS). 
        What started as a simple academic project grew into a vision for a modern and accessible beauty e-commerce platform specializing in skincare and makeup.
      </p>
      <p class="lead" style="margin-top:10px">
        Founded by three Informatics Engineering students — 
        <strong>Devina Balqis Aurora</strong>, 
        <strong>Safa Mashita</strong>, and 
        <strong>Via Hana Nurma Putri</strong> — Beauté Verse blends technology, creativity, and a passion for the beauty industry 
        to deliver a personalized, trusted, and seamless shopping experience for everyone.
      </p>
    </section>

    <section class="grid">
      <article class="card pad">
        <h2>Your Online Beauty Destination</h2>
        <p>
          Beauté Verse is your trusted destination for authentic beauty products — makeup, skincare, bodycare, fragrance, and tools — curated for beauty lovers across Indonesia.
        </p>

        <div class="values" style="margin-top:14px">
          <div class="value">
            <h3>Only Authentic & BPOM Ready</h3>
            <p>We work with authorized distributors and brand principals. Products are original and eligible for BPOM registration and local compliance.</p>
          </div>
          <div class="value">
            <h3>Delivery Guaranteed</h3>
            <p>Reliable logistics partners and an in-house fulfillment SOP ensure orders are processed smoothly; returns are simple and hassle-free.</p>
          </div>
          <div class="value">
            <h3>Beauty Journal</h3>
            <p>Discover tips, routines, and brand updates through our journal — helping you craft a routine that fits your unique beauty style.</p>
          </div>
          <div class="value">
            <h3>Community First</h3>
            <p>We listen to our community for product curation and features that make shopping feel warm, safe, and delightful.</p>
          </div>
        </div>
      </article>

      <aside class="card pad">
        <h2>Quick Facts</h2>
        <p><strong>Founded:</strong> 2025</p>
        <p><strong>Origin:</strong> ITS — Informatics Engineering</p>
        <p><strong>Focus:</strong> Skincare & Makeup</p>
        <p><strong>Mission:</strong> Make quality beauty accessible with a trusted, elegant shopping experience.</p>

        <hr style="border:none;border-top:1px solid var(--border);margin:14px 0">

        <h2>Contact</h2>
        <p><a href="mailto:cs@beauteverse.com">cs@beauteverse.com</a></p>
        <p><a href="https://wa.me/62811987888" target="_blank" rel="noopener">0811 987 888 (WhatsApp)</a></p>
      </aside>
    </section>
  </main>

  <footer>© {{ date('Y') }} Beauté Verse · All rights reserved.</footer>
@endsection