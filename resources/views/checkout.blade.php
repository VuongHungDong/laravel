@extends('layouts.app')
@section('title', 'Thanh Toán')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 pt-24">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-10 text-center" data-aos="fade-up">
            <h1 class="text-3xl md:text-4xl font-serif font-bold text-white">Thanh Toán</h1>
            <p class="text-surface-variant mt-2">Vui lòng điền thông tin giao hàng để hoàn tất đơn hàng.</p>
        </div>

        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg text-sm mb-8 max-w-3xl mx-auto" role="alert" data-aos="fade-up">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Form -->
            <div data-aos="fade-up" data-aos-delay="100">
                <div class="glass p-8 rounded-3xl border border-earth-500/20">
                    <h2 class="text-2xl font-serif text-white mb-6">Thông tin giao hàng</h2>
                    
                    <form action="{{ route('checkout.process') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label for="name" class="block text-sm font-medium text-surface-variant mb-2">Họ và tên</label>
                            <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name ?? '') }}" required
                                   class="w-full bg-surface-base border border-earth-500/30 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-jade-500 focus:ring-1 focus:ring-jade-500 transition-colors">
                            @error('name') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-surface-variant mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email ?? '') }}" required
                                   class="w-full bg-surface-base border border-earth-500/30 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-jade-500 focus:ring-1 focus:ring-jade-500 transition-colors">
                            @error('email') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-surface-variant mb-2">Số điện thoại</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required
                                   class="w-full bg-surface-base border border-earth-500/30 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-jade-500 focus:ring-1 focus:ring-jade-500 transition-colors">
                            @error('phone') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-surface-variant mb-2">Địa chỉ giao hàng (Số nhà, Tên đường, Phường/Xã, Quận/Huyện, Tỉnh/Thành phố)</label>
                            <textarea id="address" name="address" rows="3" required
                                      class="w-full bg-surface-base border border-earth-500/30 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-jade-500 focus:ring-1 focus:ring-jade-500 transition-colors">{{ old('address') }}</textarea>
                            @error('address') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="w-full bg-jade-600 hover:bg-jade-500 text-surface-base py-4 rounded-xl font-bold text-lg transition-all shadow-[0_0_20px_rgba(0,168,107,0.4)] mt-4">
                            Xác nhận đặt hàng
                        </button>
                    </form>
                </div>
            </div>

            <!-- Summary -->
            <div data-aos="fade-up" data-aos-delay="200">
                <div class="glass p-8 rounded-3xl border border-earth-500/20 sticky top-24">
                    <h2 class="text-2xl font-serif text-white mb-6">Đơn hàng của bạn</h2>
                    
                    <div class="space-y-4 mb-6 max-h-96 overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($cart as $details)
                            <div class="flex items-center gap-4 border-b border-earth-500/10 pb-4">
                                <div class="w-16 h-16 rounded-lg bg-surface-dim overflow-hidden flex-shrink-0">
                                    <img src="{{ $details['image'] }}?w=100&h=100&fit=crop" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-grow">
                                    <h4 class="text-white text-sm font-medium">{{ $details['name'] }}</h4>
                                    <p class="text-surface-variant text-xs mt-1">SL: {{ $details['quantity'] }}</p>
                                </div>
                                <div class="text-jade-400 font-medium text-sm">
                                    {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}đ
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-3 pt-4">
                        <div class="flex justify-between text-surface-variant text-sm">
                            <span>Tạm tính</span>
                            <span>{{ number_format($total, 0, ',', '.') }}đ</span>
                        </div>
                        <div class="flex justify-between text-surface-variant text-sm">
                            <span>Phí vận chuyển</span>
                            <span>Miễn phí</span>
                        </div>
                        <div class="border-t border-earth-500/20 pt-4 flex justify-between items-center mt-2">
                            <span class="text-white font-medium text-lg">Tổng cộng</span>
                            <span class="text-2xl font-bold text-jade-400">{{ number_format($total, 0, ',', '.') }}đ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: rgba(139, 115, 85, 0.3);
        border-radius: 10px;
    }
</style>
@endsection
