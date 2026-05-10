<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jade Blossom Marketplace - @yield('title', 'Home')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600&family=Noto+Serif:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <!-- 1. TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        jade: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#59de9b',
                            500: '#40C094',
                            600: '#00A86B', // Primary 
                            700: '#008F5B',
                            800: '#006d43',
                            900: '#003921',
                        },
                        earth: {
                            100: '#feddb3',
                            300: '#e1c299',
                            500: '#D2B48C', // Secondary Light Brown
                            700: '#5b4526',
                            900: '#402d10',
                        },
                        surface: {
                            base: '#131407',
                            dim: '#0e0f03',
                            bright: '#1f2111',
                            text: '#e4e4cc',
                            variant: '#bccabe',
                        }
                    },
                    fontFamily: {
                        serif: ['"Noto Serif"', 'serif'],
                        sans: ['"Be Vietnam Pro"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .glass {
                @apply bg-surface-bright/30 backdrop-blur-md border border-earth-500/20;
            }
            .text-outline {
                -webkit-text-stroke: 1px #D2B48C;
                color: transparent;
            }
        }
        body {
            background-color: #131407;
            color: #e4e4cc;
            overflow-x: hidden;
        }
        ::selection {
            background: #00A86B;
            color: #fff;
        }
        /* Lenis smooth scrolling requires this */
        html.lenis {
            height: auto;
        }
        .lenis.lenis-smooth {
            scroll-behavior: auto;
        }
        .lenis.lenis-smooth [data-lenis-prevent] {
            overscroll-behavior: contain;
        }
        .lenis.lenis-stopped {
            overflow: hidden;
        }
        .lenis.lenis-scrolling iframe {
            pointer-events: none;
        }
    </style>

    <!-- 2. Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <!-- 3. AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- 4. Toastify CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>
<body class="font-sans antialiased bg-surface-base text-surface-text selection:bg-jade-600 selection:text-white flex flex-col min-h-screen">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300" id="navbar">
        <div class="glass border-b-0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="/" class="font-serif text-2xl font-bold text-jade-400">Jade<span class="text-earth-500">Blossom</span></a>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-8">
                            <a href="/" class="hover:text-jade-400 px-3 py-2 rounded-md text-sm uppercase tracking-widest transition-colors duration-300">Trang chủ</a>
                            <a href="/category" class="hover:text-jade-400 px-3 py-2 rounded-md text-sm uppercase tracking-widest transition-colors duration-300">Danh mục</a>
                            <a href="/search" class="hover:text-jade-400 px-3 py-2 rounded-md text-sm uppercase tracking-widest transition-colors duration-300">Tìm kiếm</a>
                            <a href="/cart" class="hover:text-jade-400 px-3 py-2 rounded-md text-sm uppercase tracking-widest transition-colors duration-300 flex items-center gap-2">
                                Giỏ hàng 
                                @php
                                    $cartCount = 0;
                                    if(session()->has('cart')) {
                                        $cartCount = array_sum(array_column(session('cart'), 'quantity'));
                                    }
                                @endphp
                                <span id="cart-count-badge" class="bg-jade-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ $cartCount }}</span>
                            </a>
                        </div>
                    </div>
                    <div class="hidden md:flex gap-4 items-center">
                        @auth
                            <div class="relative group">
                                <button class="flex items-center gap-2 text-surface-variant hover:text-jade-400 transition-colors text-sm font-medium">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ Auth::user()->email }}
                                </button>
                                <!-- Dropdown -->
                                <div class="absolute right-0 mt-2 w-48 bg-surface-bright border border-earth-500/20 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right">
                                    <div class="py-1">
                                        @if(Auth::user()->role === 'admin')
                                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-surface-variant hover:bg-surface-base hover:text-jade-400 transition-colors">
                                                Trang quản trị
                                            </a>
                                        @endif
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-surface-variant hover:bg-surface-base hover:text-jade-400 transition-colors">
                                                Đăng xuất
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-earth-500 border border-earth-500/30 hover:border-earth-500 hover:text-earth-300 px-4 py-2 rounded-md text-sm font-medium transition-all duration-300">Đăng nhập</a>
                            <a href="{{ route('register') }}" class="bg-jade-600 hover:bg-jade-500 text-surface-base px-4 py-2 rounded-md text-sm font-medium transition-all duration-300 shadow-[0_0_15px_rgba(0,168,107,0.3)]">Đăng ký</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-surface-dim border-t border-earth-500/10 mt-auto">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <span class="font-serif text-2xl font-bold text-jade-400">Jade<span class="text-earth-500">Blossom</span></span>
                    <p class="mt-4 text-surface-variant text-sm max-w-sm">Không gian nghệ thuật hoa tươi sang trọng, mang đến sự tinh tế và cảm xúc trong từng thiết kế.</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-earth-300 uppercase tracking-wider">Khám phá</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="/" class="text-sm text-surface-variant hover:text-jade-400 transition-colors">Trang chủ</a></li>
                        <li><a href="/category" class="text-sm text-surface-variant hover:text-jade-400 transition-colors">Sản phẩm mới</a></li>
                        <li><a href="/search" class="text-sm text-surface-variant hover:text-jade-400 transition-colors">Tìm kiếm</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-earth-300 uppercase tracking-wider">Hỗ trợ</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#" class="text-sm text-surface-variant hover:text-jade-400 transition-colors">Về chúng tôi</a></li>
                        <li><a href="#" class="text-sm text-surface-variant hover:text-jade-400 transition-colors">Chính sách bảo mật</a></li>
                        <li><a href="#" class="text-sm text-surface-variant hover:text-jade-400 transition-colors">Liên hệ</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 border-t border-earth-500/10 pt-8 flex items-center justify-between">
                <p class="text-sm text-surface-variant">&copy; 2026 Jade Blossom Marketplace. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Libraries JS -->
    <!-- 5. GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    
    <!-- 6. Lenis (Smooth Scroll) -->
    <script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@1.0.27/bundled/lenis.min.js"></script>
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- 7. SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Toastify JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    
    <!-- 8. Tippy.js (Tooltips) & Popper.js -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    
    <!-- 9. Lottie-web -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>
    
    <!-- 10. Rellax.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rellax/1.12.0/rellax.min.js"></script>

    <!-- Global Scripts Initialization -->
    <script>
        // Initialize Lenis (Smooth Scroll) - wrapped in try/catch
        try {
            var lenis = new Lenis({
                duration: 1.2,
                easing: function(t) { return Math.min(1, 1.001 - Math.pow(2, -10 * t)); },
                smooth: true,
            });

            function raf(time) {
                lenis.raf(time);
                requestAnimationFrame(raf);
            }
            requestAnimationFrame(raf);
        } catch(e) {
            console.warn('Lenis init skipped:', e.message);
        }

        // Connect GSAP to Lenis - wrapped in try/catch
        try {
            gsap.registerPlugin(ScrollTrigger);
            if (typeof lenis !== 'undefined') {
                lenis.on('scroll', ScrollTrigger.update);
                gsap.ticker.add(function(time) {
                    lenis.raf(time * 1000);
                });
            }
            gsap.ticker.lagSmoothing(0, 0);
        } catch(e) {
            console.warn('GSAP init skipped:', e.message);
        }

        // Initialize AOS
        try {
            AOS.init({
                duration: 1000,
                once: true,
                offset: 100,
            });
        } catch(e) {
            console.warn('AOS init skipped:', e.message);
        }

        // Initialize Rellax
        try {
            if (document.querySelector('.rellax')) {
                var rellax = new Rellax('.rellax');
            }
        } catch(e) {
            console.warn('Rellax init skipped:', e.message);
        }

        // Navbar blur effect on scroll
        window.addEventListener('scroll', function() {
            var nav = document.getElementById('navbar');
            if (nav) {
                if (window.scrollY > 50) {
                    nav.classList.add('shadow-lg');
                } else {
                    nav.classList.remove('shadow-lg');
                }
            }
        });
    </script>

    <!-- Cart & UI Functions (separate script block so it ALWAYS runs) -->
    <script>
        // Toast notification
        window.showToast = function(msg, type) {
            type = type || 'success';
            try {
                Toastify({
                    text: msg,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: type === "success" ? "#00A86B" : "#D2B48C",
                        color: "#131407",
                        borderRadius: "8px",
                        fontFamily: "Be Vietnam Pro"
                    }
                }).showToast();
            } catch(e) {
                alert(msg);
            }
        };

        // SweetAlert
        window.showAlert = function(title, text, icon) {
            icon = icon || 'success';
            try {
                Swal.fire({
                    title: title,
                    text: text,
                    icon: icon,
                    background: '#1f2111',
                    color: '#e4e4cc',
                    confirmButtonColor: '#00A86B'
                });
            } catch(e) {
                alert(title + ': ' + text);
            }
        };

        // Add to Cart AJAX
        window.addToCart = function(productId, productName) {
            var csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                window.showToast('Lỗi bảo mật. Vui lòng tải lại trang.', 'error');
                return;
            }
            
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                    'Accept': 'application/json'
                },
                credentials: 'same-origin',
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('HTTP ' + response.status);
                }
                return response.json();
            })
            .then(function(data) {
                if (data.success) {
                    window.showToast(data.message, 'success');
                    var badge = document.getElementById('cart-count-badge');
                    if (badge) {
                        badge.innerText = data.cart_count;
                    }
                } else {
                    window.showToast(data.message || 'Lỗi khi thêm vào giỏ hàng', 'error');
                }
            })
            .catch(function(error) {
                console.error('Cart Error:', error);
                window.showToast('Lỗi kết nối: ' + error.message, 'error');
            });
        };

        // Event delegation for .btn-add-cart buttons
        // Uses CAPTURE phase to fire before Swiper blocks clicks
        document.addEventListener('click', function(e) {
            var btn = e.target.closest('.btn-add-cart');
            if (!btn) return;
            
            e.preventDefault();
            e.stopImmediatePropagation();
            
            var productId = btn.getAttribute('data-product-id');
            var productName = btn.getAttribute('data-product-name');
            
            if (!productId) return;
            
            // Disable button temporarily & show loading
            btn.disabled = true;
            var originalHTML = btn.innerHTML;
            btn.innerHTML = '<svg class="w-4 h-4 inline-block animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Đang thêm...';
            
            window.addToCart(productId, productName);
            
            setTimeout(function() {
                btn.disabled = false;
                btn.innerHTML = originalHTML;
            }, 1500);
        }, true);
    </script>

    @stack('scripts')
</body>
</html>
