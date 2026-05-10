@extends('layouts.app')
@section('title', 'Giỏ Hàng')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 pt-24">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-10" data-aos="fade-up">
            <h1 class="text-3xl md:text-4xl font-serif font-bold text-white">Giỏ Hàng Của Bạn</h1>
            <p class="text-surface-variant mt-2">Xem lại các sản phẩm bạn đã chọn trước khi thanh toán.</p>
        </div>

        @if(session('success'))
            <div class="bg-jade-600/10 border border-jade-500/50 text-jade-400 px-4 py-3 rounded-lg text-sm mb-8" role="alert" data-aos="fade-up">
                {{ session('success') }}
            </div>
        @endif

        @if(count($cart) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-6" data-aos="fade-up" data-aos-delay="100">
                    @foreach($cart as $id => $details)
                        <div class="glass p-4 rounded-2xl flex flex-col sm:flex-row items-center gap-6 border border-earth-500/10 hover:border-earth-500/30 transition-colors">
                            <!-- Image -->
                            <div class="w-full sm:w-32 h-32 flex-shrink-0 bg-surface-dim rounded-xl overflow-hidden border border-earth-500/20">
                                @if(isset($details['image']) && $details['image'])
                                    <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-earth-500/30">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Details -->
                            <div class="flex-grow text-center sm:text-left w-full">
                                <h3 class="text-xl font-serif text-white font-semibold mb-1">{{ $details['name'] }}</h3>
                                <div class="text-jade-400 font-bold">{{ number_format($details['price'], 0, ',', '.') }}đ</div>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center gap-6 w-full sm:w-auto justify-between sm:justify-end">
                                <!-- Update Quantity -->
                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center bg-surface-base rounded-full border border-earth-500/30 p-1">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown(); this.parentNode.submit();" class="w-8 h-8 flex items-center justify-center text-surface-variant hover:text-white transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                    </button>
                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-12 text-center bg-transparent text-white font-medium focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" onchange="this.form.submit()">
                                    <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp(); this.parentNode.submit();" class="w-8 h-8 flex items-center justify-center text-surface-variant hover:text-white transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    </button>
                                </form>

                                <!-- Remove -->
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <button type="submit" class="p-2 text-red-400/70 hover:text-red-400 hover:bg-red-400/10 rounded-full transition-colors" title="Xóa">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Summary -->
                <div class="lg:col-span-1" data-aos="fade-up" data-aos-delay="200">
                    <div class="glass p-8 rounded-3xl sticky top-24 border border-earth-500/20">
                        <h2 class="text-2xl font-serif text-white mb-6">Tóm tắt đơn hàng</h2>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-surface-variant">
                                <span>Tạm tính</span>
                                <span>{{ number_format($total, 0, ',', '.') }}đ</span>
                            </div>
                            <div class="flex justify-between text-surface-variant">
                                <span>Phí vận chuyển</span>
                                <span>Miễn phí</span>
                            </div>
                            <div class="border-t border-earth-500/20 pt-4 flex justify-between items-center">
                                <span class="text-white font-medium">Tổng cộng</span>
                                <span class="text-2xl font-bold text-jade-400">{{ number_format($total, 0, ',', '.') }}đ</span>
                            </div>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="block w-full bg-jade-600 hover:bg-jade-500 text-surface-base text-center py-4 rounded-xl font-semibold text-lg transition-all shadow-[0_0_20px_rgba(0,168,107,0.4)]">
                            Tiến hành thanh toán
                        </a>
                        <a href="{{ route('search') }}" class="block w-full text-center mt-4 text-surface-variant hover:text-white transition-colors text-sm">
                            <i class="fas fa-arrow-left mr-2"></i>Tiếp tục mua sắm
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="text-center py-24 bg-surface-bright/30 rounded-3xl border border-earth-500/10" data-aos="fade-up">
                <div class="w-32 h-32 mx-auto mb-6 bg-surface-dim rounded-full flex items-center justify-center border border-earth-500/20 shadow-inner">
                    <svg class="w-12 h-12 text-earth-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-serif text-white mb-2">Giỏ hàng của bạn đang trống</h3>
                <p class="text-surface-variant mb-8">Có vẻ như bạn chưa chọn sản phẩm nào. Hãy khám phá các bó hoa tuyệt đẹp của chúng tôi nhé!</p>
                <a href="{{ route('search') }}" class="inline-block bg-earth-500 hover:bg-earth-400 text-surface-base px-8 py-3 rounded-full font-medium transition-colors">
                    Khám phá ngay
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
