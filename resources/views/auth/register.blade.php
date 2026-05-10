@extends('layouts.app')
@section('title', 'Đăng ký')

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
                Tạo tài khoản mới
            </h2>
            <p class="mt-2 text-center text-sm text-surface-variant">
                Tham gia cùng Jade Blossom ngay hôm nay
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
            @csrf

            <!-- Bắt lỗi đăng ký -->
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
                    <label for="name" class="block text-sm font-medium text-surface-variant mb-1">Họ và tên</label>
                    <input id="name" name="name" type="text" autocomplete="name" required class="appearance-none relative block w-full px-4 py-3 bg-surface-base/50 border border-earth-500/30 placeholder-surface-variant/50 text-white rounded-lg focus:outline-none focus:ring-1 focus:ring-jade-500 focus:border-jade-500 focus:z-10 sm:text-sm transition-colors" placeholder="Nhập họ và tên" value="{{ old('name') }}">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-surface-variant mb-1">Địa chỉ Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none relative block w-full px-4 py-3 bg-surface-base/50 border border-earth-500/30 placeholder-surface-variant/50 text-white rounded-lg focus:outline-none focus:ring-1 focus:ring-jade-500 focus:border-jade-500 focus:z-10 sm:text-sm transition-colors" placeholder="Nhập email của bạn" value="{{ old('email') }}">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="gender" class="block text-sm font-medium text-surface-variant mb-1">Giới tính</label>
                        <select id="gender" name="gender" class="appearance-none relative block w-full px-4 py-3 bg-surface-base/50 border border-earth-500/30 text-white rounded-lg focus:outline-none focus:ring-1 focus:ring-jade-500 focus:border-jade-500 focus:z-10 sm:text-sm transition-colors [&>option]:bg-surface-bright [&>option]:text-white">
                            <option value="">Chọn giới tính</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Nam</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Nữ</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Khác</option>
                        </select>
                    </div>
                    <div>
                        <label for="birthday" class="block text-sm font-medium text-surface-variant mb-1">Ngày sinh</label>
                        <input id="birthday" name="birthday" type="date" class="appearance-none relative block w-full px-4 py-3 bg-surface-base/50 border border-earth-500/30 placeholder-surface-variant/50 text-white rounded-lg focus:outline-none focus:ring-1 focus:ring-jade-500 focus:border-jade-500 focus:z-10 sm:text-sm transition-colors [color-scheme:dark]" value="{{ old('birthday') }}">
                    </div>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-surface-variant mb-1">Mật khẩu</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required class="appearance-none relative block w-full px-4 py-3 bg-surface-base/50 border border-earth-500/30 placeholder-surface-variant/50 text-white rounded-lg focus:outline-none focus:ring-1 focus:ring-jade-500 focus:border-jade-500 focus:z-10 sm:text-sm transition-colors" placeholder="Nhập mật khẩu (tối thiểu 6 ký tự)">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-surface-variant mb-1">Xác nhận mật khẩu</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required class="appearance-none relative block w-full px-4 py-3 bg-surface-base/50 border border-earth-500/30 placeholder-surface-variant/50 text-white rounded-lg focus:outline-none focus:ring-1 focus:ring-jade-500 focus:border-jade-500 focus:z-10 sm:text-sm transition-colors" placeholder="Nhập lại mật khẩu">
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-surface-base bg-jade-600 hover:bg-jade-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-jade-500 transition-all duration-300 shadow-[0_0_15px_rgba(0,168,107,0.3)]">
                    Đăng ký
                </button>
            </div>
            
            <div class="text-center text-sm text-surface-variant mt-4">
                Đã có tài khoản? 
                <a href="{{ route('login') }}" class="font-medium text-jade-400 hover:text-jade-300 transition-colors">Đăng nhập</a>
            </div>
        </form>
    </div>
</div>
@endsection
