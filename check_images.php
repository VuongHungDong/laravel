<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Kiểm tra xem sản phẩm nào đang dùng URL nào
$products = DB::table('products')->select('id','name','category_id','image')->orderBy('category_id')->orderBy('id')->get();

// Các URL đã biết là SAI (không phải hoa)
$bad_urls = [
    '1533038590840-1cde6e668a91' => 'Lá cây/Eucalyptus',
    '1495360010541-f48722b34f7d' => 'Mèo gừng',
    '1487530811015-780780f3ae90' => 'Không xác định',
    '1519378058457-4c29a0a2efac' => 'Có thể không phải hoa',
    '1606041011872-596597976b25' => 'iPhone/Điện thoại',
    '1543466835-00a7907e9de1'    => 'Chó Beagle',
    '1510129215017-d5d2cc6a664e' => 'Không xác định',
    '1598511726623-d2e9996e8bee' => 'Không xác định',
    '1622547748225-3fc4abd2cca0' => '3D Shapes',
];

echo "=== KIỂM TRA ẢNH THEO DANH MỤC ===\n\n";
$current_cat = 0;
foreach ($products as $p) {
    if ($p->category_id != $current_cat) {
        $current_cat = $p->category_id;
        $cat_names = [1 => 'HOA HỒNG', 2 => 'HOA TULIP', 3 => 'LAN HỒ ĐIỆP'];
        echo "\n--- " . ($cat_names[$current_cat] ?? "Cat $current_cat") . " ---\n";
    }
    
    // Extract photo timestamp from URL
    preg_match('/photo-([a-z0-9-]+)\?/', $p->image, $m);
    $photo_id = $m[1] ?? 'unknown';
    
    $is_bad = '';
    foreach ($bad_urls as $bad_part => $reason) {
        if (str_contains($p->image, $bad_part)) {
            $is_bad = " ⚠️ BAD: $reason";
            break;
        }
    }
    
    echo "ID {$p->id}: {$p->name}{$is_bad}\n";
    echo "  URL: ...photo-{$photo_id}\n";
}
