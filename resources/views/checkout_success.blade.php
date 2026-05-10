@extends('layouts.app')
@section('title', 'Đặt Hàng Thành Công')

@section('content')
<div class="min-h-screen py-24 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
    <div class="max-w-2xl w-full text-center" data-aos="zoom-in">
        <div class="glass p-12 rounded-3xl border border-jade-500/30 relative overflow-hidden">
            <!-- Decorative background glow -->
            <div class="absolute -top-24 -right-24 w-48 h-48 bg-jade-600/20 rounded-full blur-[50px]"></div>
            <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-earth-500/20 rounded-full blur-[50px]"></div>

            <div class="relative z-10">
                <div class="w-24 h-24 mx-auto bg-jade-600/20 rounded-full flex items-center justify-center mb-8 border border-jade-500/50 shadow-[0_0_30px_rgba(0,168,107,0.3)]">
                    <svg class="w-12 h-12 text-jade-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                
                <h1 class="text-4xl font-serif font-bold text-white mb-4">Đặt Hàng Thành Công!</h1>
                <p class="text-lg text-surface-variant mb-2">Cảm ơn bạn đã mua sắm tại Jade Blossom.</p>
                <p class="text-surface-variant mb-8">Mã đơn hàng của bạn là: <span class="text-jade-400 font-bold">#{{ session('order_id') }}</span></p>

                <div class="bg-surface-base/50 rounded-xl p-6 border border-earth-500/20 mb-8 inline-block text-left">
                    <p class="text-surface-variant text-sm mb-2"><i class="fas fa-info-circle mr-2 text-earth-400"></i>Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất để xác nhận đơn hàng.</p>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('search') }}" class="w-full sm:w-auto px-8 py-3 bg-jade-600 hover:bg-jade-500 text-surface-base rounded-full font-medium transition-colors shadow-[0_0_15px_rgba(0,168,107,0.3)]">
                        Tiếp tục mua sắm
                    </a>
                    <a href="{{ url('/') }}" class="w-full sm:w-auto px-8 py-3 border border-earth-500/30 text-earth-300 hover:text-white hover:bg-earth-500/10 rounded-full font-medium transition-colors">
                        Về trang chủ
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
