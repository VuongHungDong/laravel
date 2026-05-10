@extends('layouts.app')
@section('title', $product->name)

@section('content')

<!-- Breadcrumb -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-4">
    <nav class="flex items-center gap-2 text-sm text-surface-variant" data-aos="fade-right">
        <a href="/" class="hover:text-jade-400 transition-colors">Trang chủ</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="/category" class="hover:text-jade-400 transition-colors">Danh mục</a>
        @if($product->category)
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-earth-300">{{ $product->category->name }}</span>
        @endif
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-white font-medium truncate max-w-[200px]">{{ $product->name }}</span>
    </nav>
</div>

<!-- Product Detail Section -->
<section class="pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">

            <!-- Product Image -->
            <div class="relative" data-aos="fade-right">
                <div class="aspect-[4/5] rounded-3xl overflow-hidden border border-earth-500/20 bg-surface-dim shadow-[0_20px_60px_rgba(0,0,0,0.5)]">
                    @if($product->hasImage())
                        <img src="{{ $product->displayImage(1200) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-1000"
                             id="product-main-image">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-earth-500/30">
                            <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                </div>

                <!-- Floating badges -->
                @if($product->quantity <= 5 && $product->quantity > 0)
                <div class="absolute top-6 left-6 bg-earth-500 text-surface-base text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">
                    Chỉ còn {{ $product->quantity }} sản phẩm
                </div>
                @elseif($product->quantity <= 0)
                <div class="absolute top-6 left-6 bg-red-500 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">
                    Hết hàng
                </div>
                @endif

                <!-- Views badge -->
                <div class="absolute bottom-6 right-6 glass px-4 py-2 rounded-full text-sm flex items-center gap-2">
                    <svg class="w-4 h-4 text-jade-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    <span class="text-white font-medium">{{ number_format($product->view) }}</span>
                    <span class="text-surface-variant">lượt xem</span>
                </div>
            </div>

            <!-- Product Info -->
            <div class="flex flex-col justify-center" data-aos="fade-left">
                <!-- Category -->
                @if($product->category)
                <div class="mb-4">
                    <span class="inline-block text-xs font-bold tracking-widest uppercase text-jade-400 bg-jade-600/10 border border-jade-600/30 px-4 py-1.5 rounded-full">
                        {{ $product->category->name }}
                    </span>
                </div>
                @endif

                <!-- Title -->
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-white mb-6 leading-tight">
                    {{ $product->name }}
                </h1>

                <!-- Price -->
                <div class="flex items-baseline gap-4 mb-8">
                    <span class="text-4xl font-bold text-earth-300">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                    <span class="text-sm text-surface-variant">Đã bao gồm VAT</span>
                </div>

                <!-- Divider -->
                <div class="border-t border-earth-500/20 mb-8"></div>

                <!-- Description -->
                <div class="mb-8">
                    <h3 class="text-sm font-semibold text-earth-300 uppercase tracking-wider mb-3">Mô tả sản phẩm</h3>
                    <p class="text-surface-variant leading-relaxed text-base">
                        {{ $product->description }}
                    </p>
                </div>

                <!-- Product Details Grid -->
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="glass rounded-xl p-4 text-center">
                        <div class="text-jade-400 mb-1">
                            <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <div class="text-white font-semibold">{{ $product->quantity > 0 ? 'Còn hàng' : 'Hết hàng' }}</div>
                        <div class="text-xs text-surface-variant mt-1">{{ $product->quantity }} sản phẩm</div>
                    </div>
                    <div class="glass rounded-xl p-4 text-center">
                        <div class="text-jade-400 mb-1">
                            <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="text-white font-semibold">Giao nhanh 2H</div>
                        <div class="text-xs text-surface-variant mt-1">Nội thành HCM</div>
                    </div>
                    <div class="glass rounded-xl p-4 text-center">
                        <div class="text-jade-400 mb-1">
                            <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <div class="text-white font-semibold">Bảo hành</div>
                        <div class="text-xs text-surface-variant mt-1">Tươi 3 ngày</div>
                    </div>
                    <div class="glass rounded-xl p-4 text-center">
                        <div class="text-jade-400 mb-1">
                            <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        <div class="text-white font-semibold">Thanh toán</div>
                        <div class="text-xs text-surface-variant mt-1">COD / Online</div>
                    </div>
                </div>

                <!-- Quantity & Add to Cart -->
                @if($product->quantity > 0)
                <div class="flex flex-col sm:flex-row items-stretch gap-4 mb-6">
                    <!-- Quantity Selector -->
                    <div class="flex items-center bg-surface-dim rounded-xl border border-earth-500/30 px-2">
                        <button type="button" id="qty-minus" class="w-10 h-12 flex items-center justify-center text-surface-variant hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                        </button>
                        <input type="number" id="product-qty" value="1" min="1" max="{{ $product->quantity }}" class="w-16 text-center bg-transparent text-white text-lg font-semibold focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                        <button type="button" id="qty-plus" class="w-10 h-12 flex items-center justify-center text-surface-variant hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </button>
                    </div>

                    <!-- Add to Cart Button -->
                    <button type="button" id="detail-add-cart" class="flex-grow bg-jade-600 hover:bg-jade-500 text-white py-4 px-8 rounded-xl font-semibold text-lg transition-all duration-300 shadow-[0_0_25px_rgba(0,168,107,0.4)] hover:shadow-[0_0_35px_rgba(0,168,107,0.6)] flex items-center justify-center gap-3"
                            data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Thêm vào giỏ hàng
                    </button>
                </div>
                @else
                <div class="mb-6">
                    <button disabled class="w-full bg-surface-dim text-surface-variant py-4 px-8 rounded-xl font-semibold text-lg cursor-not-allowed border border-earth-500/20">
                        Sản phẩm đã hết hàng
                    </button>
                </div>
                @endif

                <!-- Buy Now -->
                @if($product->quantity > 0)
                <a href="{{ route('checkout.index') }}" class="block w-full text-center border-2 border-earth-500/50 hover:border-earth-500 text-earth-300 hover:text-white py-3 px-8 rounded-xl font-medium transition-all duration-300">
                    Mua ngay
                </a>
                @endif
            </div>

        </div>
    </div>
</section>

<!-- Related Products -->
@if($relatedProducts->count() > 0)
<section class="py-20 bg-surface-dim border-t border-earth-500/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12" data-aos="fade-up">
            <h2 class="text-3xl font-serif font-bold text-white mb-2">Sản phẩm liên quan</h2>
            <p class="text-surface-variant">Có thể bạn cũng thích những sản phẩm này</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" data-aos="fade-up" data-aos-delay="100">
            @foreach($relatedProducts as $related)
            <div class="group relative bg-surface-bright rounded-2xl overflow-hidden hover:shadow-[0_10px_40px_rgba(0,0,0,0.5)] transition-all duration-500 h-full flex flex-col border border-earth-500/10">
                <a href="{{ route('product.show', $related->slug) }}" class="block h-56 w-full overflow-hidden flex-shrink-0">
                    @if($related->hasImage())
                        <img src="{{ $related->displayImage(600) }}" alt="{{ $related->name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="w-full h-full bg-surface-dim flex items-center justify-center text-surface-variant transform group-hover:scale-110 transition-transform duration-700">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                </a>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <div>
                        <a href="{{ route('product.show', $related->slug) }}">
                            <h3 class="font-serif text-lg font-bold text-white mb-1 group-hover:text-jade-400 transition-colors line-clamp-1">{{ $related->name }}</h3>
                        </a>
                        <p class="text-xs text-surface-variant mb-3 line-clamp-2">{{ $related->description }}</p>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-earth-300">{{ number_format($related->price, 0, ',', '.') }}đ</span>
                        <button type="button" class="btn-add-cart bg-jade-600 hover:bg-jade-500 text-white text-sm px-4 py-2 rounded-full font-medium transition-all duration-300 shadow-[0_0_10px_rgba(0,168,107,0.3)]" data-product-id="{{ $related->id }}" data-product-name="{{ $related->name }}">
                            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Thêm
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Quantity controls
        var qtyInput = document.getElementById('product-qty');
        var qtyMinus = document.getElementById('qty-minus');
        var qtyPlus = document.getElementById('qty-plus');
        var maxQty = {{ $product->quantity }};

        if (qtyMinus && qtyInput) {
            qtyMinus.addEventListener('click', function() {
                var val = parseInt(qtyInput.value) || 1;
                if (val > 1) {
                    qtyInput.value = val - 1;
                }
            });
        }

        if (qtyPlus && qtyInput) {
            qtyPlus.addEventListener('click', function() {
                var val = parseInt(qtyInput.value) || 1;
                if (val < maxQty) {
                    qtyInput.value = val + 1;
                }
            });
        }

        // Add to cart from detail page (supports custom quantity)
        var detailBtn = document.getElementById('detail-add-cart');
        if (detailBtn) {
            detailBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                var productId = this.getAttribute('data-product-id');
                var productName = this.getAttribute('data-product-name');
                var quantity = parseInt(qtyInput.value) || 1;

                // Disable & loading state
                this.disabled = true;
                var originalHTML = this.innerHTML;
                this.innerHTML = '<svg class="w-6 h-6 inline-block animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Đang thêm vào giỏ...';

                var btn = this;
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: quantity
                    })
                })
                .then(function(response) {
                    if (!response.ok) throw new Error('HTTP ' + response.status);
                    return response.json();
                })
                .then(function(data) {
                    if (data.success) {
                        window.showToast(data.message, 'success');
                        var badge = document.getElementById('cart-count-badge');
                        if (badge) badge.innerText = data.cart_count;
                    } else {
                        window.showToast(data.message || 'Lỗi khi thêm vào giỏ hàng', 'error');
                    }
                })
                .catch(function(error) {
                    console.error('Cart Error:', error);
                    window.showToast('Lỗi kết nối: ' + error.message, 'error');
                })
                .finally(function() {
                    setTimeout(function() {
                        btn.disabled = false;
                        btn.innerHTML = originalHTML;
                    }, 1000);
                });
            });
        }

        // Initialize Tippy tooltips
        try {
            tippy('[data-tippy-content]', {
                placement: 'top',
                theme: 'light',
                animation: 'scale',
            });
        } catch(e) {}
    });
</script>
@endpush
