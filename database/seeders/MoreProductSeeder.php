<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class MoreProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            // Category 1: Hoa Hồng (Roses)
            [
                'name' => 'Bó Hoa Hồng Đỏ Cổ Điển',
                'description' => 'Sự lãng mạn vĩnh cửu với 99 đóa hồng đỏ thắm, tượng trưng cho tình yêu trường tồn.',
                'image' => 'https://images.unsplash.com/photo-1548094990-c16ca90f1f0c',
                'price' => 1200000,
                'quantity' => 15,
                'category_id' => 1,
                'view' => 120
            ],
            [
                'name' => 'Bó Hoa Hồng Trắng Tinh Khôi',
                'description' => 'Vẻ đẹp thuần khiết và thanh lịch, là món quà hoàn hảo cho ngày kỷ niệm.',
                'image' => 'https://images.unsplash.com/photo-1596431940989-138332152f2d',
                'price' => 950000,
                'quantity' => 20,
                'category_id' => 1,
                'view' => 85
            ],
            [
                'name' => 'Lẵng Hoa Hồng Vàng Sung Túc',
                'description' => 'Hoa hồng vàng mang lại niềm vui, sự ấm áp và thịnh vượng cho người nhận.',
                'image' => 'https://images.unsplash.com/photo-1562690868-60bbe7293e94',
                'price' => 1500000,
                'quantity' => 10,
                'category_id' => 1,
                'view' => 210
            ],
            [
                'name' => 'Bó Hoa Hồng Juliet Sang Trọng',
                'description' => 'Được mệnh danh là "Hoa hồng triệu đô", Juliet mang vẻ đẹp kiêu sa, quý phái.',
                'image' => 'https://images.unsplash.com/photo-1582794543139-8ac9cb0f7b11',
                'price' => 2800000,
                'quantity' => 5,
                'category_id' => 1,
                'view' => 540
            ],
            [
                'name' => 'Giỏ Hoa Hồng Phấn Ngọt Ngào',
                'description' => 'Sự kết hợp tinh tế của hoa hồng phấn và các loại hoa lá phụ kiện mang đến vẻ đẹp nữ tính.',
                'image' => 'https://images.unsplash.com/photo-1508611440040-692ab8d7c430',
                'price' => 850000,
                'quantity' => 25,
                'category_id' => 1,
                'view' => 150
            ],
            [
                'name' => 'Bó Hoa Hồng Đào Lãng Mạn',
                'description' => 'Màu sắc nhẹ nhàng, tinh tế của hoa hồng đào biểu tượng cho sự biết ơn và trân trọng.',
                'image' => 'https://images.unsplash.com/photo-1591886960571-74d43a9d4166',
                'price' => 1100000,
                'quantity' => 12,
                'category_id' => 1,
                'view' => 95
            ],
            [
                'name' => 'Hộp Hoa Hồng Ecuador Đỏ',
                'description' => 'Hồng Ecuador nhập khẩu với bông to, cánh dày, độ bền cao, được sắp xếp tinh tế trong hộp quà.',
                'image' => 'https://images.unsplash.com/photo-1613589417643-bc07f457cc09',
                'price' => 3500000,
                'quantity' => 8,
                'category_id' => 1,
                'view' => 320
            ],

            // Category 2: Hoa Tulip (Tulips)
            [
                'name' => 'Bó Tulip Vàng Nắng Sớm',
                'description' => 'Những bông tulip vàng rực rỡ như ánh mặt trời, mang năng lượng tích cực cho ngày mới.',
                'image' => 'https://images.unsplash.com/photo-1520763185298-1b434c919102',
                'price' => 1350000,
                'quantity' => 18,
                'category_id' => 2,
                'view' => 180
            ],
            [
                'name' => 'Tulip Trắng Hà Lan Thuần Khiết',
                'description' => 'Tulip trắng nhập khẩu trực tiếp từ Hà Lan, biểu tượng của sự thanh cao và sự khởi đầu mới.',
                'image' => 'https://images.unsplash.com/photo-1512428559087-560fa5ceab42',
                'price' => 1600000,
                'quantity' => 14,
                'category_id' => 2,
                'view' => 250
            ],
            [
                'name' => 'Bình Tulip Hồng Cổ Tích',
                'description' => 'Tulip hồng nhẹ nhàng cắm trong bình pha lê cao cấp, trang trí hoàn hảo cho phòng khách.',
                'image' => 'https://images.unsplash.com/photo-1588667551061-f4044ffc926a',
                'price' => 2200000,
                'quantity' => 6,
                'category_id' => 2,
                'view' => 310
            ],
            [
                'name' => 'Bó Tulip Tím Quyền Lực',
                'description' => 'Màu tím huyền bí, sang trọng làm toát lên khí chất vương giả của người nhận.',
                'image' => 'https://images.unsplash.com/photo-1554162464-964f483758b2',
                'price' => 1450000,
                'quantity' => 9,
                'category_id' => 2,
                'view' => 165
            ],
            [
                'name' => 'Tulip Đỏ Rực Rỡ',
                'description' => 'Tình yêu cháy bỏng và đam mê mãnh liệt được gửi gắm qua những đóa tulip đỏ rực.',
                'image' => 'https://images.unsplash.com/photo-1616782293881-22fb181e1948',
                'price' => 1250000,
                'quantity' => 11,
                'category_id' => 2,
                'view' => 280
            ],
            [
                'name' => 'Giỏ Tulip Mix Màu Tươi Trẻ',
                'description' => 'Sự kết hợp đa sắc màu tạo nên một bức tranh mùa xuân tràn đầy sức sống.',
                'image' => 'https://images.unsplash.com/photo-1550993077-8551a37c35a6',
                'price' => 1800000,
                'quantity' => 15,
                'category_id' => 2,
                'view' => 410
            ],
            [
                'name' => 'Lẵng Tulip Và Baby',
                'description' => 'Sự hòa quyện giữa hoa tulip mạnh mẽ và hoa baby mỏng manh tạo nên nét đẹp độc đáo.',
                'image' => 'https://images.unsplash.com/photo-1522851493774-0f2c41df3c15',
                'price' => 1950000,
                'quantity' => 7,
                'category_id' => 2,
                'view' => 135
            ],

            // Category 3: Lan Hồ Điệp (Orchids)
            [
                'name' => 'Chậu Lan Hồ Điệp Trắng 5 Cành',
                'description' => 'Lan hồ điệp trắng 5 cành vô cùng sang trọng, thích hợp làm quà biếu đối tác, khai trương.',
                'image' => 'https://images.unsplash.com/photo-1600860361280-999d3eb0f935',
                'price' => 2500000,
                'quantity' => 12,
                'category_id' => 3,
                'view' => 520
            ],
            [
                'name' => 'Lan Hồ Điệp Tím Hoàng Gia',
                'description' => 'Sắc tím hoàng gia quý phái, độ bền hoa lên đến 2 tháng.',
                'image' => 'https://images.unsplash.com/photo-1579624599723-5e360982eb4e',
                'price' => 3200000,
                'quantity' => 5,
                'category_id' => 3,
                'view' => 380
            ],
            [
                'name' => 'Chậu Lan Hồ Điệp Vàng Hoàng Kim',
                'description' => 'Mang lại ý nghĩa phong thủy tốt lành, thu hút tài lộc và sự thịnh vượng.',
                'image' => 'https://images.unsplash.com/photo-1614798679693-79d391f63e63',
                'price' => 2800000,
                'quantity' => 8,
                'category_id' => 3,
                'view' => 450
            ],
            [
                'name' => 'Lan Hồ Điệp Đột Biến Bò Sữa',
                'description' => 'Dòng lan đột biến quý hiếm với các đốm vân độc đáo không chậu nào giống chậu nào.',
                'image' => 'https://images.unsplash.com/photo-1589412157796-03c09440da82',
                'price' => 4500000,
                'quantity' => 3,
                'category_id' => 3,
                'view' => 670
            ],
            [
                'name' => 'Chậu Lan Mini Để Bàn',
                'description' => 'Thiết kế nhỏ gọn tinh tế, điểm nhấn hoàn hảo cho bàn làm việc hoặc quầy lễ tân.',
                'image' => 'https://images.unsplash.com/photo-1502086223501-7ea6ecd79368',
                'price' => 850000,
                'quantity' => 20,
                'category_id' => 3,
                'view' => 230
            ],
            [
                'name' => 'Lan Hồ Điệp Mix Nghệ Thuật',
                'description' => 'Tác phẩm nghệ thuật cắm ghép 9 cành lan hồ điệp đa sắc trên lũa gỗ tự nhiên.',
                'image' => 'https://images.unsplash.com/photo-1510129215017-d5d2cc6a664e',
                'price' => 6800000,
                'quantity' => 2,
                'category_id' => 3,
                'view' => 890
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
