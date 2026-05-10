<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class FixAndMoreProductsSeeder extends Seeder
{
    // Verified working Unsplash photo IDs for flowers
    // Format: photo-{id}?w=800&auto=format&fit=crop&q=80
    public function run()
    {
        // ================================================================
        // STEP 1: Fix existing broken images with verified working URLs
        // ================================================================
        $fixes = [
            1  => 'https://images.unsplash.com/photo-1591886960571-74d43a9d4166?w=800&auto=format&fit=crop&q=80',
            2  => 'https://images.unsplash.com/photo-1563241527-3004b7be0ffd?w=800&auto=format&fit=crop&q=80',
            3  => 'https://images.unsplash.com/photo-1606041011872-596597976b25?w=800&auto=format&fit=crop&q=80',
            4  => 'https://images.unsplash.com/photo-1470509037663-253afd7f0f51?w=800&auto=format&fit=crop&q=80',
            5  => 'https://images.unsplash.com/photo-1490750967868-88cb4aca4414?w=800&auto=format&fit=crop&q=80',
            6  => 'https://images.unsplash.com/photo-1548094990-c16ca90f1f0c?w=800&auto=format&fit=crop&q=80',
            7  => 'https://images.unsplash.com/photo-1596431940989-138332152f2d?w=800&auto=format&fit=crop&q=80',
            8  => 'https://images.unsplash.com/photo-1562690868-60bbe7293e94?w=800&auto=format&fit=crop&q=80',
            9  => 'https://images.unsplash.com/photo-1508611440040-692ab8d7c430?w=800&auto=format&fit=crop&q=80',
            10 => 'https://images.unsplash.com/photo-1611735341450-74d61e660ad2?w=800&auto=format&fit=crop&q=80',
            11 => 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=800&auto=format&fit=crop&q=80',
            12 => 'https://images.unsplash.com/photo-1561181286-d3fee7d55364?w=800&auto=format&fit=crop&q=80',
            13 => 'https://images.unsplash.com/photo-1520763185298-1b434c919102?w=800&auto=format&fit=crop&q=80',
            14 => 'https://images.unsplash.com/photo-1585914924626-15adac1e6402?w=800&auto=format&fit=crop&q=80',
            15 => 'https://images.unsplash.com/photo-1522748906645-95d8adfd52c7?w=800&auto=format&fit=crop&q=80',
            16 => 'https://images.unsplash.com/photo-1554162464-964f483758b2?w=800&auto=format&fit=crop&q=80',
            17 => 'https://images.unsplash.com/photo-1555955255-6b7b2e4d966a?w=800&auto=format&fit=crop&q=80',
            18 => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&auto=format&fit=crop&q=80',
            19 => 'https://images.unsplash.com/photo-1555955255-6b7b2e4d966a?w=800&auto=format&fit=crop&q=80',
            20 => 'https://images.unsplash.com/photo-1455659817273-f96807779a8a?w=800&auto=format&fit=crop&q=80',
            21 => 'https://images.unsplash.com/photo-1512428559087-560fa5ceab42?w=800&auto=format&fit=crop&q=80',
            22 => 'https://images.unsplash.com/photo-1453728013993-6d66e9c9123a?w=800&auto=format&fit=crop&q=80',
            23 => 'https://images.unsplash.com/photo-1567696911980-2c669fdb56a4?w=800&auto=format&fit=crop&q=80',
            24 => 'https://images.unsplash.com/photo-1502086223501-7ea6ecd79368?w=800&auto=format&fit=crop&q=80',
            25 => 'https://images.unsplash.com/photo-1444021465936-c6ca81d39b84?w=800&auto=format&fit=crop&q=80',
        ];

        foreach ($fixes as $id => $newImage) {
            DB::table('products')->where('id', $id)->update(['image' => $newImage]);
        }

        echo "Fixed " . count($fixes) . " existing product images.\n";

        // ================================================================
        // STEP 2: Add 20 new products with verified working images
        // ================================================================
        $newProducts = [
            // --- Hoa Hồng thêm (cat 1) ---
            [
                'name'        => 'Bó Hoa Hồng Gradient Sunset',
                'description' => 'Hoa hồng chuyển màu hoàng hôn đặc biệt, kết hợp tông cam đào và vàng rực rỡ.',
                'image'       => 'https://images.unsplash.com/photo-1517330049040-8bde3ab18f3e?w=800&auto=format&fit=crop&q=80',
                'price'       => 1350000,
                'quantity'    => 14,
                'category_id' => 1,
                'view'        => 230,
            ],
            [
                'name'        => 'Hoa Hồng Garden Boho',
                'description' => 'Phong cách boho phóng khoáng với hoa hồng vườn nhỏ và lá eucalyptus tươi.',
                'image'       => 'https://images.unsplash.com/photo-1495360010541-f48722b34f7d?w=800&auto=format&fit=crop&q=80',
                'price'       => 890000,
                'quantity'    => 22,
                'category_id' => 1,
                'view'        => 115,
            ],
            [
                'name'        => 'Hộp Hoa Hồng Luxury Box',
                'description' => 'Hoa hồng nhung xếp tầng trong hộp nhung đen sang trọng, quà tặng VIP.',
                'image'       => 'https://images.unsplash.com/photo-1533038590840-1cde6e668a91?w=800&auto=format&fit=crop&q=80',
                'price'       => 4200000,
                'quantity'    => 6,
                'category_id' => 1,
                'view'        => 680,
            ],
            [
                'name'        => 'Bó Hoa Hồng Mix Pastel',
                'description' => 'Tổng hợp hoa hồng nhiều màu pastel nhẹ nhàng, gợi cảm giác bình yên và ngọt ngào.',
                'image'       => 'https://images.unsplash.com/photo-1519378058457-4c29a0a2efac?w=800&auto=format&fit=crop&q=80',
                'price'       => 1050000,
                'quantity'    => 18,
                'category_id' => 1,
                'view'        => 175,
            ],
            [
                'name'        => 'Hoa Hồng Spray Bụi Nhỏ',
                'description' => 'Hoa hồng bụi nhỏ xinh xắn, lý tưởng để cắm bình trang trí không gian sống.',
                'image'       => 'https://images.unsplash.com/photo-1468327768560-75b778cbb551?w=800&auto=format&fit=crop&q=80',
                'price'       => 650000,
                'quantity'    => 30,
                'category_id' => 1,
                'view'        => 88,
            ],
            [
                'name'        => 'Lẵng Hoa Hồng Đỏ Nhung',
                'description' => 'Bó hoa hồng nhung đỏ sậm, đặt trong lẵng tre đan thủ công truyền thống.',
                'image'       => 'https://images.unsplash.com/photo-1550159930-40066082a4fc?w=800&auto=format&fit=crop&q=80',
                'price'       => 1750000,
                'quantity'    => 9,
                'category_id' => 1,
                'view'        => 290,
            ],

            // --- Hoa Tulip thêm (cat 2) ---
            [
                'name'        => 'Tulip Cam Rực Rỡ Mùa Hè',
                'description' => 'Tulip cam tươi tắn đặc trưng mùa hè, mang nguồn năng lượng tràn đầy sức sống.',
                'image'       => 'https://images.unsplash.com/photo-1457130174916-c88e48f80548?w=800&auto=format&fit=crop&q=80',
                'price'       => 980000,
                'quantity'    => 16,
                'category_id' => 2,
                'view'        => 142,
            ],
            [
                'name'        => 'Tulip Kem Champagne Quý Phái',
                'description' => 'Tulip màu kem sữa kết hợp với lá thơm và bông trang trắng tạo nên vẻ đẹp tinh tế.',
                'image'       => 'https://images.unsplash.com/photo-1490750967868-88cb4aca4414?w=800&auto=format&fit=crop&q=80',
                'price'       => 1480000,
                'quantity'    => 11,
                'category_id' => 2,
                'view'        => 198,
            ],
            [
                'name'        => 'Hộp Tulip Hà Lan Mix 20 Cành',
                'description' => 'Giftbox 20 cành tulip Hà Lan nhiều màu, thích hợp để tặng ngày sinh nhật.',
                'image'       => 'https://images.unsplash.com/photo-1444021465936-c6ca81d39b84?w=800&auto=format&fit=crop&q=80',
                'price'       => 2600000,
                'quantity'    => 8,
                'category_id' => 2,
                'view'        => 360,
            ],
            [
                'name'        => 'Tulip Hồng Violet Dịu Dàng',
                'description' => 'Gam màu hồng tím huyền diệu, kết hợp giữa sự lãng mạn và bí ẩn.',
                'image'       => 'https://images.unsplash.com/photo-1508193638397-1c4234db14d8?w=800&auto=format&fit=crop&q=80',
                'price'       => 1320000,
                'quantity'    => 13,
                'category_id' => 2,
                'view'        => 215,
            ],
            [
                'name'        => 'Bó Tulip Xanh Lam Hiếm',
                'description' => 'Tulip xanh lam - giống tulip hiếm có nhất trên thế giới, món quà độc đáo.',
                'image'       => 'https://images.unsplash.com/photo-1471086569966-db3eebc25a59?w=800&auto=format&fit=crop&q=80',
                'price'       => 3800000,
                'quantity'    => 4,
                'category_id' => 2,
                'view'        => 520,
            ],
            [
                'name'        => 'Tulip Kép Paeony Style',
                'description' => 'Tulip kép với nhiều tầng cánh giống mẫu đơn, vẻ đẹp đầy quyến rũ.',
                'image'       => 'https://images.unsplash.com/photo-1510902913713-c26bdfa52e14?w=800&auto=format&fit=crop&q=80',
                'price'       => 2100000,
                'quantity'    => 7,
                'category_id' => 2,
                'view'        => 305,
            ],
            [
                'name'        => 'Lẵng Tulip Vàng Nắng 50 Cành',
                'description' => 'Lẵng hoa hoành tráng với 50 cành tulip vàng, lý tưởng trang trí sân khấu sự kiện.',
                'image'       => 'https://images.unsplash.com/photo-1462275646964-a0e3386b89fa?w=800&auto=format&fit=crop&q=80',
                'price'       => 5500000,
                'quantity'    => 3,
                'category_id' => 2,
                'view'        => 745,
            ],

            // --- Lan Hồ Điệp thêm (cat 3) ---
            [
                'name'        => 'Chậu Lan Hồ Điệp Đỏ Huyết',
                'description' => 'Lan đỏ huyết mang ý nghĩa may mắn, thịnh vượng, đặc biệt phù hợp ngày Tết.',
                'image'       => 'https://images.unsplash.com/photo-1567696911980-2c669fdb56a4?w=800&auto=format&fit=crop&q=80',
                'price'       => 3500000,
                'quantity'    => 7,
                'category_id' => 3,
                'view'        => 460,
            ],
            [
                'name'        => 'Lan Hồ Điệp Sọc Hổ',
                'description' => 'Giống lan quý với vân sọc độc đáo như họa tiết da hổ, cực kỳ thu hút ánh nhìn.',
                'image'       => 'https://images.unsplash.com/photo-1453728013993-6d66e9c9123a?w=800&auto=format&fit=crop&q=80',
                'price'       => 5200000,
                'quantity'    => 4,
                'category_id' => 3,
                'view'        => 830,
            ],
            [
                'name'        => 'Cây Lan Hồ Điệp Miniature',
                'description' => 'Dòng lan tí hon với những chùm hoa nhỏ xinh, thích hợp trưng bày trên kệ sách.',
                'image'       => 'https://images.unsplash.com/photo-1455659817273-f96807779a8a?w=800&auto=format&fit=crop&q=80',
                'price'       => 1200000,
                'quantity'    => 15,
                'category_id' => 3,
                'view'        => 180,
            ],
            [
                'name'        => 'Chậu Lan Hồ Điệp Xanh Ngọc',
                'description' => 'Màu xanh ngọc bích hiếm có trên lan hồ điệp, tạo điểm nhấn phong cách cho không gian.',
                'image'       => 'https://images.unsplash.com/photo-1444021465936-c6ca81d39b84?w=800&auto=format&fit=crop&q=80',
                'price'       => 4100000,
                'quantity'    => 5,
                'category_id' => 3,
                'view'        => 590,
            ],
            [
                'name'        => 'Lan Hồ Điệp Trắng Thuần Khiết 3 Cành',
                'description' => 'Ba cành lan trắng cổ điển trong chậu sứ cao cấp, phù hợp trang trí phòng khách.',
                'image'       => 'https://images.unsplash.com/photo-1606041011872-596597976b25?w=800&auto=format&fit=crop&q=80',
                'price'       => 1800000,
                'quantity'    => 12,
                'category_id' => 3,
                'view'        => 265,
            ],
            [
                'name'        => 'Bộ Lan Hồ Điệp Khai Trương',
                'description' => 'Bộ 3 chậu lan ghép tinh tế dành riêng cho sự kiện khai trương, hội nghị.',
                'image'       => 'https://images.unsplash.com/photo-1563241527-3004b7be0ffd?w=800&auto=format&fit=crop&q=80',
                'price'       => 8500000,
                'quantity'    => 2,
                'category_id' => 3,
                'view'        => 1100,
            ],
            [
                'name'        => 'Chậu Lan Hồ Điệp Hồng Đậm',
                'description' => 'Sắc hồng đậm rực rỡ, biểu trưng cho tình cảm nồng ấm và lời chúc sức khỏe.',
                'image'       => 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=800&auto=format&fit=crop&q=80',
                'price'       => 2900000,
                'quantity'    => 9,
                'category_id' => 3,
                'view'        => 340,
            ],
        ];

        foreach ($newProducts as $data) {
            Product::create($data);
        }

        echo "Added " . count($newProducts) . " new products.\n";
    }
}
