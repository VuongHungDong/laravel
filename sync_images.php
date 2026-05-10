<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;
use Illuminate\Support\Facades\File;

$dir = public_path('images/products');
$files = File::files($dir);

$updatedCount = 0;
$notFound = [];

foreach ($files as $file) {
    $filename = $file->getFilename(); // e.g. "Bó Hoa Hồng Trắng Tinh Khôi.jpg"
    $nameWithoutExt = pathinfo($filename, PATHINFO_FILENAME); // e.g. "Bó Hoa Hồng Trắng Tinh Khôi"
    
    // Find product with this exact name
    $product = Product::where('name', $nameWithoutExt)->first();
    
    if ($product) {
        // Optional: Rename file to ID for safer URLs
        $ext = $file->getExtension();
        $safeFilename = $product->id . '.' . $ext;
        
        $oldPath = $file->getPathname();
        $newPath = $dir . '/' . $safeFilename;
        
        // Rename file
        rename($oldPath, $newPath);
        
        // Update DB
        $product->image = 'images/products/' . $safeFilename;
        $product->save();
        
        echo "✅ Đã đồng bộ: '{$nameWithoutExt}' -> ID: {$product->id}\n";
        $updatedCount++;
    } else {
        $notFound[] = $nameWithoutExt;
    }
}

echo "\nKết quả: Đã đồng bộ {$updatedCount} sản phẩm.\n";

if (count($notFound) > 0) {
    echo "\n⚠️ Các ảnh sau không tìm thấy sản phẩm tương ứng trong database (có thể sai tên):\n";
    foreach ($notFound as $name) {
        echo "- {$name}\n";
    }
}
