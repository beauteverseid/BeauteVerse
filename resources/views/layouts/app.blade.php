<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beauté Verse')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400;1,600&display=swap" rel="stylesheet">
    @stack('styles')
    @stack('head')
    <style>body{margin:0}</style>
    </head>
<body>
    @yield('content')
    @if(session('success'))
    <div id="flashAlert" style="position:fixed;top:12px;right:12px;z-index:2000;background:#ecfdf5;color:#065f46;border:1px solid #a7f3d0;padding:10px 14px;border-radius:10px;box-shadow:0 8px 24px rgba(0,0,0,.08);display:flex;gap:10px;align-items:center">
        <span>{{ session('success') }}</span>
        <button onclick="document.getElementById('flashAlert').remove()" style="background:none;border:none;color:#065f46;font-weight:700;cursor:pointer">×</button>
    </div>
    @endif
    @auth
    <form method="POST" action="{{ route('auth.logout') }}" style="position:fixed;bottom:12px;right:12px;z-index:1000">
        @csrf
        <button style="background:#e11d48;color:#fff;border:none;padding:8px 12px;border-radius:8px;font-weight:600">Logout</button>
    </form>
    @endauth
    @include('partials.modals')
    @stack('footer')
    @stack('scripts')
</body>
</html>