@extends('layouts.app')
@section('title', 'Admin - Quản lý sản phẩm')

@section('content')
<div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4" data-aos="fade-up">
            <div>
                <h1 class="text-3xl font-serif font-bold text-white">Quản lý sản phẩm</h1>
                <p class="text-surface-variant mt-1">Tổng cộng <span class="text-jade-400 font-semibold">{{ $products->count() }}</span> sản phẩm</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="bg-jade-600 hover:bg-jade-500 text-surface-base px-6 py-3 rounded-lg text-sm font-medium transition-all duration-300 shadow-[0_0_15px_rgba(0,168,107,0.3)] flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Thêm sản phẩm
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-jade-600/10 border border-jade-500/50 text-jade-400 px-4 py-3 rounded-lg text-sm mb-6" role="alert" data-aos="fade-up">
                {{ session('success') }}
            </div>
        @endif

        <!-- Products Table -->
        <div class="glass rounded-2xl overflow-hidden" data-aos="fade-up" data-aos-delay="100">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-earth-500/20">
                            <th class="text-left px-6 py-4 text-xs font-semibold text-earth-300 uppercase tracking-wider">ID</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-earth-300 uppercase tracking-wider">Hình ảnh</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-earth-300 uppercase tracking-wider">Tên sản phẩm</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-earth-300 uppercase tracking-wider">Danh mục</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-earth-300 uppercase tracking-wider">Giá</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-earth-300 uppercase tracking-wider">Tồn kho</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-earth-300 uppercase tracking-wider">Lượt xem</th>
                            <th class="text-center px-6 py-4 text-xs font-semibold text-earth-300 uppercase tracking-wider">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr class="border-b border-earth-500/10 hover:bg-surface-bright/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-surface-variant whitespace-nowrap">{{ $product->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($product->hasImage())
                                    <div class="w-16 h-16 flex-shrink-0">
                                        <!-- Bỏ query params lỗi, chỉ giữ nguyên URL hoặc thêm xử lý an toàn -->
                                        <img src="{{ $product->displayImage(200, 200) }}" alt="{{ $product->name }}" class="w-full h-full rounded-lg object-cover border border-earth-500/20">
                                    </div>
                                @else
                                    <div class="w-16 h-16 rounded-lg bg-surface-dim border border-earth-500/20 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-earth-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-medium text-white break-words min-w-[150px]">{{ $product->name }}</p>
                                <p class="text-xs text-surface-variant mt-1 line-clamp-2 min-w-[200px] whitespace-normal">{{ $product->description }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-jade-600/20 text-jade-400 border border-jade-500/30">
                                    {{ $product->category->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-earth-300 font-medium whitespace-nowrap">{{ number_format($product->price, 0, ',', '.') }}đ</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm {{ $product->quantity > 0 ? 'text-jade-400' : 'text-red-400' }}">{{ $product->quantity }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-surface-variant whitespace-nowrap">{{ number_format($product->view) }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 rounded-lg bg-earth-500/10 hover:bg-earth-500/20 text-earth-300 hover:text-earth-100 transition-colors" title="Sửa">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg bg-red-500/10 hover:bg-red-500/20 text-red-400 hover:text-red-300 transition-colors" title="Xóa">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-surface-variant">
                                <svg class="w-12 h-12 mx-auto mb-4 text-earth-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                <p>Chưa có sản phẩm nào.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
