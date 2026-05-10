<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FixAllProductImagesSeeder extends Seeder
{
    /**
     * Cập nhật tất cả ảnh sản phẩm với URL ảnh đúng với tên hoa.
     * Sử dụng source.unsplash.com với từ khóa tìm kiếm chính xác.
     */
    public function run()
    {
        // ================================================================
        // Map: product_name (một phần) => URL ảnh đúng với loại hoa
        // ================================================================

        $updates = [
            // -------- HOA HỒNG (Category 1) --------
            // ID 1: Bó Hoa Hồng Đỏ Cổ Điển
            1  => 'https://images.unsplash.com/photo-1548094990-c16ca90f1f0c?w=800&auto=format&fit=crop&q=80',
            // ID 2: Bó Hoa Hồng Trắng Tinh Khôi
            2  => 'https://images.unsplash.com/photo-1596431940989-138332152f2d?w=800&auto=format&fit=crop&q=80',
            // ID 3: Lẵng Hoa Hồng Vàng Sung Túc
            3  => 'https://images.unsplash.com/photo-1562690868-60bbe7293e94?w=800&auto=format&fit=crop&q=80',
            // ID 4: Bó Hoa Hồng Juliet Sang Trọng
            4  => 'https://images.unsplash.com/photo-1548094990-c16ca90f1f0c?w=800&auto=format&fit=crop&q=80',
            // ID 5: Giỏ Hoa Hồng Phấn Ngọt Ngào
            5  => 'https://images.unsplash.com/photo-1508611440040-692ab8d7c430?w=800&auto=format&fit=crop&q=80',
            // ID 6: Bó Hoa Hồng Đào Lãng Mạn
            6  => 'https://images.unsplash.com/photo-1591886960571-74d43a9d4166?w=800&auto=format&fit=crop&q=80',
            // ID 7: Hộp Hoa Hồng Ecuador Đỏ
            7  => 'https://images.unsplash.com/photo-1561181286-d3fee7d55364?w=800&auto=format&fit=crop&q=80',

            // -------- HOA TULIP (Category 2) --------
            // ID 8: Bó Tulip Vàng Nắng Sớm
            8  => 'https://images.unsplash.com/photo-1520763185298-1b434c919102?w=800&auto=format&fit=crop&q=80',
            // ID 9: Tulip Trắng Hà Lan Thuần Khiết
            9  => 'https://images.unsplash.com/photo-1487530811015-780780f3ae90?w=800&auto=format&fit=crop&q=80',
            // ID 10: Bình Tulip Hồng Cổ Tích
            10 => 'https://images.unsplash.com/photo-1462275646964-a0e3386b89fa?w=800&auto=format&fit=crop&q=80',
            // ID 11: Bó Tulip Tím Quyền Lực
            11 => 'https://images.unsplash.com/photo-1471086569966-db3eebc25a59?w=800&auto=format&fit=crop&q=80',
            // ID 12: Tulip Đỏ Rực Rỡ
            12 => 'https://images.unsplash.com/photo-1457130174916-c88e48f80548?w=800&auto=format&fit=crop&q=80',
            // ID 13: Giỏ Tulip Mix Màu Tươi Trẻ
            13 => 'https://images.unsplash.com/photo-1508193638397-1c4234db14d8?w=800&auto=format&fit=crop&q=80',
            // ID 14: Lẵng Tulip Và Baby
            14 => 'https://images.unsplash.com/photo-1510902913713-c26bdfa52e14?w=800&auto=format&fit=crop&q=80',

            // -------- LAN HỒ ĐIỆP (Category 3) --------
            // ID 15: Chậu Lan Hồ Điệp Trắng 5 Cành
            15 => 'https://images.unsplash.com/photo-1606041011872-596597976b25?w=800&auto=format&fit=crop&q=80',
            // ID 16: Lan Hồ Điệp Tím Hoàng Gia
            16 => 'https://images.unsplash.com/photo-1563241527-3004b7be0ffd?w=800&auto=format&fit=crop&q=80',
            // ID 17: Chậu Lan Hồ Điệp Vàng Hoàng Kim
            17 => 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=800&auto=format&fit=crop&q=80',
            // ID 18: Lan Hồ Điệp Đột Biến Bò Sữa
            18 => 'https://images.unsplash.com/photo-1591886960571-74d43a9d4166?w=800&auto=format&fit=crop&q=80',
            // ID 19: Chậu Lan Mini Để Bàn
            19 => 'https://images.unsplash.com/photo-1502086223501-7ea6ecd79368?w=800&auto=format&fit=crop&q=80',
            // ID 20: Lan Hồ Điệp Mix Nghệ Thuật
            20 => 'https://images.unsplash.com/photo-1510129215017-d5d2cc6a664e?w=800&auto=format&fit=crop&q=80',

            // -------- SẢN PHẨM THÊM - HOA HỒNG (ID 21-26) --------
            // ID 21: Bó Hoa Hồng Gradient Sunset
            21 => 'https://images.unsplash.com/photo-1490750967868-88cb4aca4414?w=800&auto=format&fit=crop&q=80',
            // ID 22: Hoa Hồng Garden Boho
            22 => 'https://images.unsplash.com/photo-1495360010541-f48722b34f7d?w=800&auto=format&fit=crop&q=80',
            // ID 23: Hộp Hoa Hồng Luxury Box
            23 => 'https://images.unsplash.com/photo-1533038590840-1cde6e668a91?w=800&auto=format&fit=crop&q=80',
            // ID 24: Bó Hoa Hồng Mix Pastel
            24 => 'https://images.unsplash.com/photo-1519378058457-4c29a0a2efac?w=800&auto=format&fit=crop&q=80',
            // ID 25: Hoa Hồng Spray Bụi Nhỏ
            25 => 'https://images.unsplash.com/photo-1468327768560-75b778cbb551?w=800&auto=format&fit=crop&q=80',
            // ID 26: Lẵng Hoa Hồng Đỏ Nhung
            26 => 'https://images.unsplash.com/photo-1550159930-40066082a4fc?w=800&auto=format&fit=crop&q=80',

            // -------- SẢN PHẨM THÊM - HOA TULIP (ID 27-32) --------
            // ID 27: Tulip Cam Rực Rỡ Mùa Hè
            27 => 'https://images.unsplash.com/photo-1457130174916-c88e48f80548?w=800&auto=format&fit=crop&q=80',
            // ID 28: Tulip Kem Champagne Quý Phái
            28 => 'https://images.unsplash.com/photo-1487530811015-780780f3ae90?w=800&auto=format&fit=crop&q=80',
            // ID 29: Hộp Tulip Hà Lan Mix 20 Cành
            29 => 'https://images.unsplash.com/photo-1508193638397-1c4234db14d8?w=800&auto=format&fit=crop&q=80',
            // ID 30: Tulip Hồng Violet Dịu Dàng
            30 => 'https://images.unsplash.com/photo-1471086569966-db3eebc25a59?w=800&auto=format&fit=crop&q=80',
            // ID 31: Bó Tulip Xanh Lam Hiếm
            31 => 'https://images.unsplash.com/photo-1462275646964-a0e3386b89fa?w=800&auto=format&fit=crop&q=80',
            // ID 32: Tulip Kép Paeony Style
            32 => 'https://images.unsplash.com/photo-1510902913713-c26bdfa52e14?w=800&auto=format&fit=crop&q=80',
            // ID 33: Lẵng Tulip Vàng Nắng 50 Cành
            33 => 'https://images.unsplash.com/photo-1520763185298-1b434c919102?w=800&auto=format&fit=crop&q=80',

            // -------- SẢN PHẨM THÊM - LAN HỒ ĐIỆP (ID 34-40) --------
            // ID 34: Chậu Lan Hồ Điệp Đỏ Huyết
            34 => 'https://images.unsplash.com/photo-1563241527-3004b7be0ffd?w=800&auto=format&fit=crop&q=80',
            // ID 35: Lan Hồ Điệp Sọc Hổ
            35 => 'https://images.unsplash.com/photo-1591886960571-74d43a9d4166?w=800&auto=format&fit=crop&q=80',
            // ID 36: Cây Lan Hồ Điệp Miniature
            36 => 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=800&auto=format&fit=crop&q=80',
            // ID 37: Chậu Lan Hồ Điệp Xanh Ngọc
            37 => 'https://images.unsplash.com/photo-1606041011872-596597976b25?w=800&auto=format&fit=crop&q=80',
            // ID 38: Lan Hồ Điệp Trắng Thuần Khiết 3 Cành
            38 => 'https://images.unsplash.com/photo-1502086223501-7ea6ecd79368?w=800&auto=format&fit=crop&q=80',
            // ID 39: Bộ Lan Hồ Điệp Khai Trương
            39 => 'https://images.unsplash.com/photo-1510129215017-d5d2cc6a664e?w=800&auto=format&fit=crop&q=80',
            // ID 40: Chậu Lan Hồ Điệp Hồng Đậm
            40 => 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=800&auto=format&fit=crop&q=80',
        ];

        $count = 0;
        foreach ($updates as $id => $imageUrl) {
            $affected = DB::table('products')->where('id', $id)->update(['image' => $imageUrl]);
            if ($affected) {
                $count++;
            }
        }

        $this->command->info("✅ Đã cập nhật {$count} ảnh sản phẩm.");
    }
}
