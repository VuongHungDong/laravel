@extends('layouts.app')
@section('title', 'Trang chủ')

@section('content')
<!-- Hero Section with Parallax -->
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0 rellax" data-rellax-speed="-5">
        <!-- Botanical background image placeholder -->
        <div class="w-full h-full bg-[url('https://images.unsplash.com/photo-1558231580-b74ccbb15620?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center opacity-30 mix-blend-luminosity"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-surface-base/50 via-surface-base/80 to-surface-base"></div>
    </div>
    
    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
        <h1 class="hero-title text-5xl md:text-7xl font-serif font-bold text-white mb-6 tracking-tight">
            Nghệ thuật hoa tươi <br/>
            <span class="text-outline text-earth-500 italic">đánh thức cảm xúc</span>
        </h1>
        <p class="hero-subtitle text-lg md:text-xl text-surface-variant mb-10 font-sans font-light max-w-2xl mx-auto">
            Khám phá bộ sưu tập hoa tươi cao cấp được thiết kế thủ công tỉ mỉ, mang thiên nhiên và sự tĩnh lặng vào không gian của bạn.
        </p>
        <div class="hero-cta flex gap-4 justify-center">
            <a href="/category" class="bg-jade-600 hover:bg-jade-500 text-surface-base px-8 py-4 rounded-full text-lg font-medium transition-all duration-300 shadow-[0_0_30px_rgba(0,168,107,0.4)] hover:shadow-[0_0_40px_rgba(0,168,107,0.6)] transform hover:-translate-y-1">
                Khám phá ngay
            </a>
            <a href="#featured" class="border border-earth-500/50 text-earth-300 hover:border-earth-500 px-8 py-4 rounded-full text-lg font-medium transition-all duration-300 backdrop-blur-sm">
                Tìm hiểu thêm
            </a>
        </div>
    </div>

    <!-- Scroll down indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
        <svg class="w-6 h-6 text-earth-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
    </div>
</section>

<!-- Featured Products (Swiper) -->
<section id="featured" class="py-24 bg-surface-base relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12" data-aos="fade-up">
            <div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-white mb-2">Bộ sưu tập nổi bật</h2>
                <p class="text-surface-variant">Những thiết kế được yêu thích nhất tháng này</p>
            </div>
            <div class="hidden md:flex gap-2">
                <button class="swiper-btn-prev w-10 h-10 rounded-full border border-earth-500/30 flex items-center justify-center text-earth-300 hover:bg-earth-500/10 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></button>
                <button class="swiper-btn-next w-10 h-10 rounded-full border border-earth-500/30 flex items-center justify-center text-earth-300 hover:bg-earth-500/10 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></button>
            </div>
        </div>

        <div class="swiper featuredSwiper" data-aos="fade-up" data-aos-delay="200">
            <div class="swiper-wrapper">
                @foreach($featuredProducts as $product)
                <div class="swiper-slide">
                    <div class="group relative bg-surface-bright rounded-2xl overflow-hidden hover:shadow-[0_10px_40px_rgba(0,0,0,0.5)] transition-all duration-500 h-full flex flex-col border border-earth-500/10">
                        <a href="{{ route('product.show', $product->slug) }}" class="block h-64 sm:h-72 w-full overflow-hidden relative flex-shrink-0">
                            @if($product->hasImage())
                                <img src="{{ $product->displayImage(1974) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-surface-dim flex items-center justify-center text-earth-500/30">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </a>
                        <div class="p-6 flex-grow flex flex-col justify-between">
                            <div>
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <h3 class="font-serif text-xl font-bold text-white mb-1 group-hover:text-jade-400 transition-colors line-clamp-1">{{ $product->name }}</h3>
                                </a>
                                <p class="text-sm text-surface-variant mb-4 line-clamp-2">{{ $product->description }}</p>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-earth-300">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                                <button type="button" class="btn-add-cart bg-jade-600 hover:bg-jade-500 text-white text-sm px-4 py-2 rounded-full font-medium transition-all duration-300 shadow-[0_0_10px_rgba(0,168,107,0.3)]" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}">
                                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Thêm
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Animated Info Section (GSAP Focus) -->
<section class="py-32 bg-surface-dim relative overflow-hidden">
    <div class="absolute -right-64 -top-64 w-128 h-128 bg-jade-900 rounded-full blur-[150px] opacity-50"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="gsap-text-block">
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-white mb-6 leading-tight">Mang thiên nhiên <br/><span class="text-earth-500 italic">vào cuộc sống</span></h2>
                <p class="text-lg text-surface-variant mb-8 leading-relaxed">Mỗi bó hoa tại Jade Blossom là một tác phẩm nghệ thuật độc bản. Chúng tôi chọn lọc kỹ lưỡng những đóa hoa tươi nhất từ các nhà vườn chuẩn quốc tế, kết hợp với phong cách cắm hoa hiện đại để tạo nên trải nghiệm thị giác tuyệt vời.</p>
                <button onclick="showAlert('Dịch vụ thiết kế', 'Chúng tôi sẽ liên hệ tư vấn thiết kế hoa riêng cho bạn.', 'info')" class="flex items-center gap-2 text-jade-400 font-semibold hover:text-jade-300 transition-colors group">
                    Đặt thiết kế riêng 
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </button>
            </div>
            <div class="relative gsap-image-block">
                <div class="aspect-square rounded-full overflow-hidden relative z-10 border border-earth-500/20 p-2">
                    <img src="https://images.unsplash.com/photo-1508611394142-6e2740fcae47?q=80&w=1964&auto=format&fit=crop" class="w-full h-full object-cover rounded-full filter sepia-[0.3] hover:sepia-0 transition-all duration-1000" alt="Cắm hoa nghệ thuật" />
                </div>
                <!-- Decorative element -->
                <div class="absolute -bottom-10 -left-10 w-40 h-40 border border-jade-600 rounded-full animate-[spin_10s_linear_infinite]"></div>
            </div>
        </div>
    </div>
</section>

<!-- Service Lottie Section -->
<section class="py-20 bg-surface-base border-t border-earth-500/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
            <div data-aos="fade-up" data-aos-delay="0">
                <div id="lottie-delivery" class="w-24 h-24 mx-auto mb-6 bg-surface-bright rounded-full p-4 border border-earth-500/20"></div>
                <h3 class="text-xl font-serif font-bold text-white mb-2">Giao hoa siêu tốc 2H</h3>
                <p class="text-surface-variant text-sm">Đảm bảo hoa luôn tươi mới khi đến tay người nhận.</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="100">
                <div id="lottie-quality" class="w-24 h-24 mx-auto mb-6 bg-surface-bright rounded-full p-4 border border-earth-500/20"></div>
                <h3 class="text-xl font-serif font-bold text-white mb-2">Chất lượng cao cấp</h3>
                <p class="text-surface-variant text-sm">Hoa nhập khẩu 100% bảo hành độ tươi 3 ngày.</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="200">
                <div id="lottie-support" class="w-24 h-24 mx-auto mb-6 bg-surface-bright rounded-full p-4 border border-earth-500/20"></div>
                <h3 class="text-xl font-serif font-bold text-white mb-2">Hỗ trợ 24/7</h3>
                <p class="text-surface-variant text-sm">Luôn sẵn sàng lắng nghe và tư vấn quà tặng.</p>
            </div>
        </div>
    </div>
</section>

<!-- AI Recommendation Popup -->
@if(isset($recommendedProducts) && $recommendedProducts->isNotEmpty())
    <div id="ai-popup" class="fixed inset-0 z-[100] flex items-center justify-center pointer-events-none opacity-0 invisible" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"></div>

        <!-- Popup Panel -->
        <div class="relative glass rounded-2xl p-6 md:p-8 max-w-4xl w-[90%] md:w-full mx-4 shadow-2xl pointer-events-auto transform scale-95 opacity-0 transition-all overflow-hidden border border-jade-500/30">
            <!-- Close Button -->
            <button onclick="closeAiPopup()" class="absolute top-4 right-4 text-surface-variant hover:text-white transition-colors bg-black/20 rounded-full p-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Decorative header -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-jade-900/50 text-jade-400 mb-3 border border-jade-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-2xl font-serif font-bold text-white mb-1">Gợi Ý Thông Minh</h3>
                <p class="text-jade-400 text-sm font-medium tracking-wider uppercase">{{ $aiMessage ?? 'Sản phẩm được gợi ý cho bạn' }}</p>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($recommendedProducts as $prod)
                    <div class="group relative bg-surface-base/80 rounded-xl overflow-hidden border border-earth-500/20 hover:border-jade-500/50 transition-all duration-300">
                        <a href="{{ route('product.show', $prod->slug) }}" class="block aspect-[4/5] overflow-hidden">
                            <img src="{{ $prod->displayImage(800) }}" alt="{{ $prod->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <!-- Overlay gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </a>
                        <div class="p-3">
                            <h4 class="text-sm font-medium text-white truncate">{{ $prod->name }}</h4>
                            <p class="text-earth-300 font-semibold mt-1 text-sm">{{ number_format($prod->price, 0, ',', '.') }}đ</p>
                        </div>
                        <div class="absolute inset-x-0 bottom-0 p-3 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            <button class="w-full bg-jade-600 hover:bg-jade-500 text-white text-xs font-medium py-2 rounded shadow-[0_0_10px_rgba(0,168,107,0.5)] transition-all flex items-center justify-center gap-1 btn-add-cart" data-product-id="{{ $prod->id }}" data-product-name="{{ $prod->name }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Mua ngay
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

@endsection

@push('scripts')
<script>
    // Xử lý Popup AI
    const aiPopup = document.getElementById('ai-popup');
    if (aiPopup) {
        const popupPanel = aiPopup.querySelector('.glass');
        
        // Hiện popup sau 3 giây
        setTimeout(() => {
            // Kiểm tra xem user đã đóng popup hôm nay chưa (tránh phiền)
            if (!sessionStorage.getItem('ai_popup_closed')) {
                aiPopup.classList.remove('invisible', 'opacity-0');
                setTimeout(() => {
                    popupPanel.classList.remove('scale-95', 'opacity-0');
                    popupPanel.classList.add('scale-100', 'opacity-100');
                }, 50);
            }
        }, 3000);
    }

    window.closeAiPopup = function() {
        if (aiPopup) {
            const popupPanel = aiPopup.querySelector('.glass');
            popupPanel.classList.remove('scale-100', 'opacity-100');
            popupPanel.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                aiPopup.classList.add('invisible', 'opacity-0');
            }, 300);

            // Lưu trạng thái đã đóng vào session storage
            sessionStorage.setItem('ai_popup_closed', 'true');
        }
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        // Initialize Swiper
        const swiper = new Swiper('.featuredSwiper', {
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            preventClicks: false,
            preventClicksPropagation: false,
            navigation: {
                nextEl: '.swiper-btn-next',
                prevEl: '.swiper-btn-prev',
            },
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
            }
        });

        // Initialize Tippy tooltips
        tippy('.tooltip-btn', {
            placement: 'top',
            theme: 'light',
            animation: 'scale',
        });

        // GSAP Animations
        gsap.from(".hero-title", {
            y: 50,
            opacity: 0,
            duration: 1.2,
            ease: "power3.out",
            delay: 0.2
        });
        
        gsap.from(".hero-subtitle", {
            y: 30,
            opacity: 0,
            duration: 1,
            ease: "power3.out",
            delay: 0.5
        });

        gsap.from(".hero-cta", {
            y: 30,
            opacity: 0,
            duration: 1,
            ease: "power3.out",
            delay: 0.8
        });

        // ScrollTrigger for info section
        gsap.from(".gsap-text-block", {
            scrollTrigger: {
                trigger: ".gsap-text-block",
                start: "top 80%",
            },
            x: -50,
            opacity: 0,
            duration: 1,
            ease: "power2.out"
        });

        gsap.from(".gsap-image-block", {
            scrollTrigger: {
                trigger: ".gsap-image-block",
                start: "top 80%",
            },
            x: 50,
            opacity: 0,
            duration: 1,
            ease: "power2.out"
        });

        // Add dummy Lottie animations (using open source urls for demo)
        lottie.loadAnimation({
            container: document.getElementById('lottie-delivery'),
            renderer: 'svg', loop: true, autoplay: true,
            path: 'https://lottie.host/809c91ee-4dfc-42cb-b1b0-272e5ee965f9/k6K4YxZ2Oa.json' // placeholder
        });
        lottie.loadAnimation({
            container: document.getElementById('lottie-quality'),
            renderer: 'svg', loop: true, autoplay: true,
            path: 'https://lottie.host/d6b83f4b-32db-42cf-90f7-5421c43f36a5/sB71kXQxXU.json' // placeholder
        });
        lottie.loadAnimation({
            container: document.getElementById('lottie-support'),
            renderer: 'svg', loop: true, autoplay: true,
            path: 'https://lottie.host/e474586f-2fb6-455b-9d41-35b88ce8e684/tT0mQY1E1H.json' // placeholder
        });
    });


</script>
@endpush
