@extends('layouts.app')

@section('title', 'Contact Us — Beauté Verse')

@section('content')
  <style>
    :root{--rose:#ff7ab8;--ink:#3a2e3f;--muted:#b6a7c3;--bg:linear-gradient(180deg,#fff7fb,#ffeaf4);--border:#f7d6e6;--container:1300px}
    *{box-sizing:border-box}
    html,body{margin:0;background:var(--bg);color:var(--ink);font:17px/1.7 'Lora', serif}
    a{color:inherit;text-decoration:none}
    .container{max-width:var(--container);margin:auto;padding:0 20px}
    header{padding:18px 0;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:16px}
    .brand{font-family:'Playfair Display',serif;font-weight:700;font-size:28px}
    .back{color:var(--rose);font-weight:700}
    .hero{padding:26px 0}
    h1{font-family:'Playfair Display',serif;font-weight:700;font-size:36px;margin:4px 0 8px}
    p.lead{color:var(--muted);margin:0}
    .grid{display:grid;grid-template-columns:1.2fr .8fr;gap:20px;margin:20px 0 20px;border:1px solid var(--border);border-radius:16px;box-shadow:0 12px 28px rgba(0,0,0,.06)}
    .card.pad{padding:20px}
    label{display:block;font-weight:600;margin:10px 0 6px;padding-left:10px}
    input,textarea{width:100%;padding:12px 14px;border:1px solid #e5e7eb;border-radius:12px;outline:none}
    textarea{min-height:130px;resize:vertical}
    .row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
    .btn{background:var(--rose);color:#fff;border:none;border-radius:12px;padding:12px 16px;font-weight:800;cursor:pointer}
    .info{display:grid;gap:12px}
    .info h3{font-family:'Playfair Display',serif;font-weight:600;font-size:20px;margin:0 0 6px}
    .info .line{display:flex;gap:4px;color:#374151;font-weight:600}
    .muted{color:var(--muted)}
    .map{height:0;background:transparent;border:none}
    footer{padding:24px 0;border-top:1px solid var(--border);color:#6b7280;text-align:center}
    @media (max-width:900px){.grid{grid-template-columns:1fr}.row{grid-template-columns:1fr}}
  </style>

  <header class="container">
    <div class="brand">Beauté Verse</div>
    <a class="back" href="{{ route('home') }}">← Back to Home</a>
  </header>

  <main class="container">
    <section class="hero">
      <h1>Contact Us</h1>
      <p class="lead">Have questions about orders, partnerships, or products? Drop us a message — we’re happy to help ✨</p>
    </section>

    <section class="grid">
      <div class="card">
        <div class="pad">
          <form id="contactForm" method="POST" action="{{ route('contact.submit') }}">
            @csrf
            <div class="row">
              <div>
                <label for="name">Full Name</label>
                <input id="name" name="name" type="text" placeholder="Your name" required />
              </div>
              <div>
                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="you@example.com" required />
              </div>
            </div>
            <div class="row">
              <div>
                <label for="phone">WhatsApp (optional)</label>
                <input id="phone" name="phone" type="tel" placeholder="08xxxx" />
              </div>
              <div>
                <label for="topic">Topic</label>
                <input id="topic" name="topic" type="text" placeholder="Order, product, partnership..." />
              </div>
            </div>
            <label for="message">Message</label>
            <textarea id="message" name="message" placeholder="Type your message here" required></textarea>
            <div style="display:flex;justify-content:flex-end;margin-top:12px">
              <button class="btn" type="submit">Send Message</button>
            </div>
          </form>
        </div>
        <div class="map" aria-label="Map placeholder"></div>
      </div>

      <aside class="card pad">
        <div class="info">
          <h3>Customer Care</h3>
          <div class="line"><a href="mailto:cs@beauteverse.com">cs@beauteverse.com</a></div>
          <div class="line"><a href="https://wa.me/62811987888" target="_blank" rel="noopener">0811 987 888 (WhatsApp)</a></div>
          <div class="line muted">Mon–Fri 09.00–18.00 WIB</div>
          <hr style="border:none;border-top:1px solid #eee;margin:10px 0">
          <h3>Office</h3>
          <div class="line">Jl. Cantik Raya No. 88, Jakarta</div>
          <div class="line muted">Pickup by appointment only</div>
          <hr style="border:none;border-top:1px solid #eee;margin:10px 0">
        </div>
      </aside>
    </section>
  </main>

  <footer>© {{ date('Y') }} Beauté Verse · All rights reserved.</footer>

  <script>
    document.getElementById('contactForm').addEventListener('submit', function(e){
      e.preventDefault();
      const name = document.getElementById('name').value.trim();
      alert('Thanks, ' + (name || 'Beauté Babe') + '! Your message has been received.');
      this.reset();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  </script>
@endsection