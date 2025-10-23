<!-- Cart Modal -->
<dialog id="cartModal" style="border:none;border-radius:0;padding:0;width:min(980px,95vw)">
    <button class="cart-close" id="closeCart">✕</button>
    <section class="checkout" style="display:grid;grid-template-columns:1.6fr .9fr;gap:28px;padding:28px">
        <div>
            <h1>Shopping Cart</h1>
            <div class="items" id="cartItems">
                <div class="empty">Your cart is empty</div>
            </div>
        </div>
        <div class="summary">
            <h3>Order Summary</h3>
            <div class="row">
                <span>Subtotal</span>
                <span id="subtotal">Rp 0</span>
            </div>
            <div class="row">
                <span>Shipping</span>
                <span>FREE</span>
            </div>
            <div class="row total">
                <span>Total</span>
                <span id="total">Rp 0</span>
            </div>
            <button class="btn-primary">Checkout</button>
        </div>
    </section>
</dialog>

<dialog id="loginModal" style="border:none;border-radius:16px;padding:0;max-width:420px;width:92%">
    <form method="POST" action="{{ route('auth.login') }}" style="padding:22px 22px 10px">
        @csrf
        <h2 style="margin:0 0 16px;font-weight:700">Login to Beauté Verse</h2>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email address" style="width:100%;padding:12px;margin-bottom:8px;border:1px solid #ddd;border-radius:8px">
        @error('email','login')<div style="color:#ff3333;font-size:13px;margin-bottom:8px">{{ $message }}</div>@enderror
        <input type="password" name="password" placeholder="Password" style="width:100%;padding:12px;margin-bottom:12px;border:1px solid #ddd;border-radius:8px">
        @error('password','login')<div style="color:#ff3333;font-size:13px;margin-bottom:8px">{{ $message }}</div>@enderror
        <label style="display:flex;align-items:center;gap:8px;margin-bottom:12px;font-size:14px"><input type="checkbox" name="remember"> Remember me</label>
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
            <button type="submit" style="background:#ff7ab8;color:white;border:none;padding:12px 24px;border-radius:8px;font-weight:600">Login</button>
            <button type="button" id="loginCancel" style="background:none;border:none;color:#666">Cancel</button>
        </div>
        <p style="margin:0;font-size:14px;color:#666;text-align:center">
            Don't have an account? <a href="#" id="openRegister" style="color:#ff7ab8">Register here</a>
        </p>
    </form>
    @if(session('open')==='login' || $errors->getBag('login')->any())
        <script>document.addEventListener('DOMContentLoaded',function(){var m=document.getElementById('loginModal');if(m&&m.showModal)m.showModal();});</script>
    @endif
</dialog>

<dialog id="registerModal" style="border:none;border-radius:16px;padding:0;max-width:460px;width:92%">
    <form method="POST" action="{{ route('auth.register') }}" style="padding:22px 22px 14px">
        @csrf
        <h2 style="margin:0 0 16px;font-weight:700">Create Account</h2>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name" style="width:100%;padding:12px;margin-bottom:8px;border:1px solid #ddd;border-radius:8px">
        @error('name','register')<div style="color:#ff3333;font-size:13px;margin-bottom:8px">{{ $message }}</div>@enderror
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email address" style="width:100%;padding:12px;margin-bottom:8px;border:1px solid #ddd;border-radius:8px">
        @error('email','register')<div style="color:#ff3333;font-size:13px;margin-bottom:8px">{{ $message }}</div>@enderror
        <input type="password" name="password" placeholder="Password (min 6 characters)" style="width:100%;padding:12px;margin-bottom:8px;border:1px solid #ddd;border-radius:8px">
        @error('password','register')<div style="color:#ff3333;font-size:13px;margin-bottom:8px">{{ $message }}</div>@enderror
        <label style="display:flex;align-items:center;margin-bottom:12px;font-size:14px"><input type="checkbox" name="agree" style="margin-right:8px"> I agree to the Terms</label>
        <div style="display:flex;justify-content:space-between;align-items:center">
            <button type="submit" style="background:#ff7ab8;color:white;border:none;padding:12px 24px;border-radius:8px;font-weight:600">Create Account</button>
            <button type="button" id="regCancel" style="background:none;border:none;color:#666">Cancel</button>
        </div>
    </form>
    @if(session('open')==='register' || $errors->getBag('register')->any())
        <script>document.addEventListener('DOMContentLoaded',function(){var m=document.getElementById('registerModal');if(m&&m.showModal)m.showModal();});</script>
    @endif
</dialog>

<!-- Product Modal -->
<div id="productModal" class="modal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModal()">&times;</span>
        <div class="modal-product-image">
            <img id="modalProductImg" src="" alt="">
        </div>
        <h2 class="modal-product-title" id="modalProductTitle"></h2>
        <p class="modal-product-brand" id="modalProductBrand"></p>
        <div class="modal-product-price" id="modalProductPrice"></div>
        <p class="modal-product-desc" id="modalProductDesc"></p>
        <button class="modal-add-btn" onclick="addToCartFromModal(event)">Add to Cart</button>
    </div>
</div>