@extends('layouts.app')
@section('title', $title)

@section('content')
<div class="min-h-[70vh] flex items-center justify-center relative">
    <!-- Background element -->
    <div class="absolute inset-0 z-0">
        <div class="w-full h-full bg-[url('https://images.unsplash.com/photo-1490750967868-88cb4aca4414?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center opacity-10"></div>
    </div>
    
    <div class="text-center z-10 p-12 glass rounded-2xl max-w-2xl mx-4" data-aos="zoom-in">
        <h1 class="text-4xl font-serif font-bold text-jade-400 mb-4">{{ $title }}</h1>
        <p class="text-surface-variant mb-8 text-lg">Trang này đang trong quá trình phát triển (UI mockup placeholder). Bạn đã thấy sự mượt mà của Trang Chủ chứ?</p>
        <a href="/" class="inline-block bg-jade-600 hover:bg-jade-500 text-surface-base px-6 py-3 rounded-full font-medium transition-all duration-300">Quay lại Trang Chủ</a>
    </div>
</div>
@endsection
