<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use Illuminate\Support\Facades\File;

$dir = public_path('images/products');
if (!File::exists($dir)) {
    echo "Directory not found.\n";
    exit;
}

$files = File::files($dir);
$count = 0;

foreach ($files as $file) {
    if ($file->getFilename() === 'placeholder.jpg') continue;

    $id = pathinfo($file->getFilename(), PATHINFO_FILENAME);
    $product = Product::find($id);

    if ($product) {
        // Only add if not already has media to avoid duplicates
        if (!$product->hasMedia('product-images')) {
            echo "Migrating image for Product ID {$id}...\n";
            $product->addMedia($file->getPathname())
                ->preservingOriginal() // Keep original file just in case for now
                ->toMediaCollection('product-images');
            $count++;
        } else {
            echo "Product ID {$id} already has media.\n";
        }
    }
}

echo "Migrated {$count} images to Media Library.\n";
