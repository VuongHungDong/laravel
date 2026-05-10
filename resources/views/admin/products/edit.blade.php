@extends('layouts.app')
@section('title', 'Admin - Sửa sản phẩm')

@section('content')
<div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="flex items-center gap-4 mb-8" data-aos="fade-up">
            <a href="{{ route('admin.dashboard') }}" class="p-2 rounded-lg bg-surface-bright hover:bg-earth-500/10 text-surface-variant hover:text-white transition-colors border border-earth-500/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <div>
                <h1 class="text-3xl font-serif font-bold text-white">Sửa sản phẩm</h1>
                <p class="text-surface-variant mt-1">Chỉnh sửa thông tin: <span class="text-jade-400">{{ $product->name }}</span></p>
            </div>
        </div>

        <!-- Form -->
        <div class="glass rounded-2xl p-8" data-aos="fade-up" data-aos-delay="100">
            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg text-sm mb-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Image Preview -->
                @if($product->hasImage())
                <div class="mb-2">
                    <p class="text-sm font-medium text-surface-variant mb-2">Hình ảnh hiện tại</p>
                    <img src="{{ $product->displayImage(300, 200) }}" alt="{{ $product->name }}" class="w-40 h-28 rounded-lg object-cover border border-earth-500/20">
                </div>
                @endif

                <div>
                    <label for="name" class="block text-sm font-medium text-surface-variant mb-2">Tên sản phẩm <span class="text-red-400">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required class="w-full px-4 py-3 bg-surface-base/50 border border-earth-500/30 text-white rounded-lg focus:outline-none focus:ring-1 focus:ring-jade-500 focus:border-jade-500 sm:text-sm transition-colors placeholder-surface-variant/50">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-surface-variant mb-2">Mô tả</label>
                    <textarea name="description" id="description" rows="4" class="w-full px-4 py-3 bg-surface-base/50 border border-earth-500/30 text-white rounded-lg focus:outline-none focus:ring-1 focus:ring-jade-500 focus:border-jade-500 sm:text-sm transition-colors placeholder-surface-variant/50 resize-none">{{ old('description', $product->description) }}</textarea>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-surface-variant mb-2">URL Hình ảnh</label>
                    <input type="url" name="image" id="image" value="{{ old('image', $product->image) }}" class="w-full px-4 py-3 bg-surface-base/50 border border-earth-500/30 text-white rounded-lg focus:outline-none focus:ring-1 focus:ring-jade-500 focus:border-jade-500 sm:text-sm transition-colors placeholder-surface-variant/50">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="price" class="block text-sm font-medium text-surface-variant mb-2">Giá (VNĐ) <span class="text-red-400">*</span></label>
                        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required min="0" step="1000" class="w-full px-4 py-3 bg-surface-base/50 border border-earth-500/30 text-white rounded-lg focus:outline-none focus:ring-1 focus:ring-jade-500 focus:border-jade-500 sm:text-sm transition-colors placeholder-surface-variant/50">
                    </div>
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-surface-variant mb-2">Số lượng <span class="text-red-400">*</span></label>
                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}" required min="0" class="w-full px-4 py-3 bg-surface-base/50 border border-earth-500/30 text-white rounded-lg focus:outline-none focus:ring-1 focus:ring-jade-500 focus:border-jade-500 sm:text-sm transition-colors placeholder-surface-variant/50">
                    </div>
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium text-surface-variant mb-2">Danh mục <span class="text-red-400">*</span></label>
                    <select name="category_id" id="category_id" required class="w-full px-4 py-3 bg-surface-base/50 border border-earth-500/30 text-white rounded-lg focus:outline-none focus:ring-1 focus:ring-jade-500 focus:border-jade-500 sm:text-sm transition-colors">
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 bg-jade-600 hover:bg-jade-500 text-surface-base py-3 px-6 rounded-lg text-sm font-medium transition-all duration-300 shadow-[0_0_15px_rgba(0,168,107,0.3)]">
                        Cập nhật sản phẩm
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 border border-earth-500/30 hover:border-earth-500 text-earth-300 rounded-lg text-sm font-medium transition-all duration-300">
                        Hủy bỏ
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
