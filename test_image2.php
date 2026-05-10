<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$p = App\Models\Product::where('slug', 'chau-lan-ho-diep-hong-dam')->first();
echo 'URL: ' . $p->displayImage(1200) . "\n";
