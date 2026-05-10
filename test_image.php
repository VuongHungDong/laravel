<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$p = App\Models\Product::find(33);
echo 'HAS_MEDIA: ' . ($p->hasMedia('product-images') ? 'yes' : 'no') . "\n";
echo 'URL: ' . $p->displayImage(1200) . "\n";
