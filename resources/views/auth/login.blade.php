@extends('layouts.app')
@section('title', 'Đăng nhập')

@section('content')
<div class="min-h-[calc(100vh-5rem)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 z-0">
        <div class="absolute -right-64 -top-64 w-128 h-128 bg-jade-900 rounded-full blur-[150px] opacity-20"></div>
        <div class="absolute -left-64 -bottom-64 w-128 h-128 bg-earth-900 rounded-full blur-[150px] opacity-20"></div>
    </div>

    <div class="max-w-md w-full space-y-8 glass p-10 rounded-2xl relative z-10" data-aos="fade-up">
        <div>
            <h2 class="mt-2 text-center text-3xl font-serif font-bold text-white tracking-tight">
                Chào mừng trở lại
            </h2>
            <p class="mt-2 text-center text-sm text-surface-variant">
                Đăng nhập để tiếp tục trải nghiệm mua sắm
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Bắt lỗi đăng nhập -->
            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg text-sm" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-surface-variant mb-1">Địa chỉ Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none relative block w-full px-4 py-3 bg-surface-base/50 border border-earth-500/30 placeholder-surface-variant/50 text-white rounded-lg focus:outline-none focus:ring-1 focus:ring-jade-500 focus:border-jade-500 focus:z-10 sm:text-sm transition-colors" placeholder="Nhập email của bạn" value="{{ old('email') }}">
                </div>
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label for="password" class="block text-sm font-medium text-surface-variant">Mật khẩu</label>
                        <a href="#" class="text-xs text-jade-400 hover:text-jade-300 transition-colors">Quên mật khẩu?</a>
                    </div>
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none relative block w-full px-4 py-3 bg-surface-base/50 border border-earth-500/30 placeholder-surface-variant/50 text-white rounded-lg focus:outline-none focus:ring-1 focus:ring-jade-500 focus:border-jade-500 focus:z-10 sm:text-sm transition-colors" placeholder="Nhập mật khẩu">
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-surface-base bg-jade-600 hover:bg-jade-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-jade-500 transition-all duration-300 shadow-[0_0_15px_rgba(0,168,107,0.3)]">
                    Đăng nhập
                </button>
            </div>
            
            <div class="text-center text-sm text-surface-variant mt-4">
                Chưa có tài khoản? 
                <a href="{{ route('register') }}" class="font-medium text-jade-400 hover:text-jade-300 transition-colors">Đăng ký ngay</a>
            </div>
        </form>
    </div>
</div>
@endsection
