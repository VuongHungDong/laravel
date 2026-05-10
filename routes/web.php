<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    $featuredProducts = \App\Models\Product::inRandomOrder()->take(4)->get();
    return view('welcome', compact('featuredProducts'));
});

// ĐƯỜNG DẪN TẠM THỜI ĐỂ CHẠY SEEDER TRÊN RENDER FREE
Route::get('/run-seeder', function () {
    try {
        echo "Đang bắt đầu chạy Seeder...<br>";
        
        // Tạo Role và Admin
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'RoleSeeder', '--force' => true]);
        echo "1. Đã tạo xong Role và tài khoản Admin.<br>";
        
        // Tạo Sản phẩm mẫu
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'FixAndMoreProductsSeeder', '--force' => true]);
        echo "2. Đã nạp xong Sản phẩm mẫu.<br>";
        
        return "<br><b>THÀNH CÔNG!</b> Bạn có thể quay lại trang chủ và đăng nhập admin ngay bây giờ.";
    } catch (\Exception $e) {
        return "LỖI: " . $e->getMessage();
    }
});

Route::get('/category', function (\Illuminate\Http\Request $request) {
    $categories = \App\Models\Category::withCount('products')->get();

    $query = \App\Models\Product::with('category');

    // Filter by categories
    if ($request->has('category') && is_array($request->category)) {
        $query->whereIn('category_id', $request->category);
    }

    // Filter by max price
    if ($request->filled('max_price')) {
        $query->where('price', '<=', (int) $request->max_price);
    }

    // Sort
    switch ($request->get('sort', 'newest')) {
        case 'price_asc':
            $query->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $query->orderBy('price', 'desc');
            break;
        case 'popular':
            $query->orderBy('view', 'desc');
            break;
        default: // newest
            $query->orderBy('id', 'desc');
            break;
    }

    $products = $query->paginate(12)->withQueryString();
    $selectedCategories = $request->get('category', []);
    $maxPrice = $request->get('max_price', 5000000);
    $currentSort = $request->get('sort', 'newest');

    return view('category', compact('products', 'categories', 'selectedCategories', 'maxPrice', 'currentSort'));
})->name('category');

use App\Http\Controllers\SearchController;

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/product/{slug}', function ($slug) {
    $product = \App\Models\Product::with('category')->where('slug', $slug)->firstOrFail();
    $product->increment('view'); // Tăng lượt xem
    $relatedProducts = \App\Models\Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->inRandomOrder()
        ->take(4)
        ->get();
    return view('product_detail', compact('product', 'relatedProducts'));
})->name('product.show');

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes - Protected by admin middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/products/create', [AdminController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [AdminController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{id}', [AdminController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminController::class, 'destroy'])->name('admin.products.destroy');
});

