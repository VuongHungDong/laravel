@extends('layouts.app')
@section('title', 'Danh mục sản phẩm')

@section('content')
<!-- Category Header -->
<section class="relative pt-32 pb-20 bg-surface-base border-b border-earth-500/10 overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-jade-900/30 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-earth-700/20 rounded-full blur-[100px] translate-y-1/3 -translate-x-1/3"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-serif font-bold text-white mb-4" data-aos="fade-down">Bộ sưu tập <span class="text-jade-400">Hoa Tươi</span></h1>
        <p class="text-surface-variant max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">Khám phá vẻ đẹp đa dạng của tự nhiên qua từng thiết kế hoa tinh tế, phù hợp cho mọi dịp đặc biệt.</p>
    </div>
</section>

<!-- Category Layout -->
<section class="py-16 bg-surface-base min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row gap-10">
        
        <!-- Sidebar Filter (Sticky) -->
        <aside class="w-full md:w-1/4" data-aos="fade-right">
            <form id="filter-form" action="{{ route('category') }}" method="GET" class="sticky top-28 glass p-6 rounded-2xl">
                <div class="flex justify-between items-center mb-6 border-b border-earth-500/20 pb-4">
                    <h3 class="font-serif text-xl text-white">Lọc Sản Phẩm</h3>
                    @if(count($selectedCategories) > 0 || $maxPrice < 5000000 || $currentSort !== 'newest')
                    <a href="{{ route('category') }}" class="text-xs text-jade-400 hover:text-jade-300 transition-colors">Xóa bộ lọc</a>
                    @endif
                </div>
                
                <!-- Filter Category -->
                <div class="mb-8">
                    <h4 class="text-sm uppercase tracking-wider text-earth-300 font-semibold mb-4">Loại Hoa</h4>
                    <div class="space-y-3">
                        @foreach($categories as $category)
                        <label class="flex items-center justify-between group cursor-pointer">
                            <div class="flex items-center">
                                <input type="checkbox" name="category[]" value="{{ $category->id }}"
                                       class="form-checkbox bg-transparent border-earth-500/50 text-jade-600 rounded focus:ring-0 focus:ring-offset-0 cursor-pointer"
                                       {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>
                                <span class="ml-3 text-surface-variant group-hover:text-white transition-colors">{{ $category->name }}</span>
                            </div>
                            <span class="text-xs text-surface-variant bg-surface-dim px-2 py-0.5 rounded-full">{{ $category->products_count }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Price Range -->
                <div class="mb-8">
                    <h4 class="text-sm uppercase tracking-wider text-earth-300 font-semibold mb-4">Mức Giá Tối Đa</h4>
                    <input type="range" name="max_price" id="price-range" min="100000" max="5000000" step="100000"
                           value="{{ $maxPrice }}"
                           class="w-full h-1.5 bg-surface-dim rounded-lg appearance-none cursor-pointer accent-jade-500">
                    <div class="flex justify-between text-xs text-surface-variant mt-2">
                        <span>100.000đ</span>
                        <span id="price-display" class="text-jade-400 font-semibold text-sm">{{ number_format($maxPrice, 0, ',', '.') }}đ</span>
                        <span>5.000.000đ</span>
                    </div>
                </div>

                <!-- Sort (hidden, synced from top dropdown) -->
                <input type="hidden" name="sort" id="filter-sort" value="{{ $currentSort }}">

                <button type="submit" class="w-full bg-jade-600 hover:bg-jade-500 text-white py-3 rounded-xl font-medium transition-all duration-300 shadow-[0_0_15px_rgba(0,168,107,0.3)] flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Áp dụng bộ lọc
                </button>
            </form>
        </aside>

        <!-- Product Grid -->
        <div class="w-full md:w-3/4">
            <div class="flex justify-between items-center mb-8">
                <p class="text-surface-variant">Hiển thị <span class="text-white font-medium">{{ $products->total() }}</span> sản phẩm</p>
                <div class="flex items-center gap-2">
                    <span class="text-sm text-surface-variant">Sắp xếp:</span>
                    <select id="sort-select" class="bg-surface-bright border border-earth-500/20 text-white text-sm rounded-lg focus:ring-jade-500 focus:border-jade-500 block p-2.5 outline-none cursor-pointer">
                        <option value="newest" {{ $currentSort == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                        <option value="price_asc" {{ $currentSort == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                        <option value="price_desc" {{ $currentSort == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                        <option value="popular" {{ $currentSort == 'popular' ? 'selected' : '' }}>Phổ biến nhất</option>
                    </select>
                </div>
            </div>

            @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 product-grid" data-aos="fade-up">
                
                @foreach($products as $product)
                <div class="product-card h-full group relative bg-surface-bright rounded-2xl overflow-hidden hover:shadow-[0_10px_40px_rgba(0,0,0,0.5)] transition-all duration-500 border border-earth-500/10 flex flex-col">
                    <a href="{{ route('product.show', $product->slug) }}" class="block h-64 sm:h-72 w-full overflow-hidden relative flex-shrink-0">
                        @if($product->hasImage())
                            <img src="{{ $product->displayImage(1976) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-surface-dim flex items-center justify-center text-earth-500/30">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </a>
                    <div class="p-5 flex-grow flex flex-col justify-between">
                        <div>
                            @if($product->category)
                            <span class="text-xs text-jade-500 font-semibold tracking-wider uppercase">{{ $product->category->name }}</span>
                            @endif
                            <a href="{{ route('product.show', $product->slug) }}">
                                <h3 class="font-serif text-lg font-bold text-white mb-1 group-hover:text-jade-400 transition-colors line-clamp-1">{{ $product->name }}</h3>
                            </a>
                            <p class="text-xs text-surface-variant mb-4 line-clamp-2">{{ $product->description }}</p>
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
                @endforeach

            </div>
            
            <!-- Pagination -->
            <div class="mt-12 flex justify-center" data-aos="fade-up">
                {{ $products->links() }}
            </div>
            @else
            <!-- Empty State -->
            <div class="text-center py-24 bg-surface-bright/30 rounded-3xl border border-earth-500/10" data-aos="fade-up">
                <svg class="w-20 h-20 mx-auto text-earth-500/30 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <h3 class="text-2xl font-serif text-white mb-2">Không tìm thấy sản phẩm</h3>
                <p class="text-surface-variant mb-8">Không có sản phẩm nào phù hợp với bộ lọc của bạn.</p>
                <a href="{{ route('category') }}" class="inline-block bg-jade-600 hover:bg-jade-500 text-white px-8 py-3 rounded-full font-medium transition-all duration-300">
                    Xóa bộ lọc
                </a>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Price range display
        var priceRange = document.getElementById('price-range');
        var priceDisplay = document.getElementById('price-display');
        
        if (priceRange && priceDisplay) {
            priceRange.addEventListener('input', function() {
                var val = parseInt(this.value);
                priceDisplay.textContent = val.toLocaleString('vi-VN') + 'đ';
            });
        }

        // Sort dropdown -> syncs with hidden input and auto-submits
        var sortSelect = document.getElementById('sort-select');
        var filterSort = document.getElementById('filter-sort');
        var filterForm = document.getElementById('filter-form');

        if (sortSelect && filterSort && filterForm) {
            sortSelect.addEventListener('change', function() {
                filterSort.value = this.value;
                filterForm.submit();
            });
        }

        // Initialize tooltips
        try {
            tippy('.tooltip-btn', {
                placement: 'top',
                theme: 'light',
                animation: 'scale',
            });
        } catch(e) {}
    });
</script>
@endpush
