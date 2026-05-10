@extends('layouts.app')
@section('title', 'Tìm Kiếm')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 pt-24">
    <div class="max-w-7xl mx-auto">
        <!-- Search Header -->
        <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-white mb-6">Khám Phá Cửa Hàng</h1>
            <p class="text-surface-variant text-lg mb-8">Tìm kiếm những đóa hoa hoàn hảo nhất cho mọi dịp đặc biệt.</p>
            
            <form action="{{ route('search') }}" method="GET" class="relative group">
                <input type="text" name="q" value="{{ $query ?? '' }}" placeholder="Nhập tên hoa, danh mục hoặc mô tả..." 
                       class="w-full bg-surface-bright/50 border border-earth-500/30 text-white rounded-full py-4 pl-6 pr-16 focus:outline-none focus:border-jade-500 focus:ring-1 focus:ring-jade-500 transition-all placeholder-surface-variant/70 backdrop-blur-sm text-lg">
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 p-3 bg-jade-600 hover:bg-jade-500 text-white rounded-full transition-colors shadow-[0_0_15px_rgba(0,168,107,0.3)]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </div>

        <!-- Search Results -->
        @if(isset($query) && $query !== '')
            <div class="mb-8" data-aos="fade-up">
                <h2 class="text-2xl font-serif text-white">Kết quả tìm kiếm cho: <span class="text-jade-400 font-italic">"{{ $query }}"</span></h2>
                <p class="text-surface-variant mt-2">Tìm thấy {{ $products->total() }} sản phẩm</p>
            </div>
        @else
            <div class="mb-8" data-aos="fade-up">
                <h2 class="text-2xl font-serif text-white">Gợi ý cho bạn</h2>
            </div>
        @endif

        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" data-aos="fade-up" data-aos-delay="100">
                @foreach($products as $product)
                    <div class="group relative bg-surface-bright rounded-2xl overflow-hidden hover:shadow-[0_10px_40px_rgba(0,0,0,0.5)] transition-all duration-500 h-full flex flex-col border border-earth-500/10">
                        <a href="{{ route('product.show', $product->slug) }}" class="block h-64 sm:h-72 w-full overflow-hidden relative flex-shrink-0 bg-surface-dim">
                            @if($product->hasImage())
                                <img src="{{ $product->displayImage(500, 600) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-earth-500/30">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </a>
                        <div class="p-6 flex-grow flex flex-col justify-between">
                            <div>
                                <div class="text-xs text-jade-500 font-semibold tracking-wider uppercase mb-2">
                                    {{ $product->category->name ?? 'Hoa tươi' }}
                                </div>
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <h3 class="font-serif text-xl font-bold text-white mb-2 group-hover:text-jade-400 transition-colors line-clamp-1" title="{{ $product->name }}">{{ $product->name }}</h3>
                                </a>
                                <p class="text-sm text-surface-variant mb-4 line-clamp-2" title="{{ $product->description }}">{{ $product->description }}</p>
                            </div>
                            <div class="flex justify-between items-center mt-auto">
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
            <div class="mt-12 flex justify-center">
                {{ $products->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-24 bg-surface-bright/30 rounded-3xl border border-earth-500/10" data-aos="fade-up">
                <svg class="w-20 h-20 mx-auto text-earth-500/30 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <h3 class="text-2xl font-serif text-white mb-2">Không tìm thấy sản phẩm nào</h3>
                <p class="text-surface-variant">Vui lòng thử lại với từ khóa khác hoặc quay lại <a href="{{ route('search') }}" class="text-jade-400 hover:underline">tất cả sản phẩm</a>.</p>
            </div>
        @endif
    </div>
</div>
@endsection
