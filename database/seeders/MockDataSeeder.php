<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MockDataSeeder extends Seeder
{
    /**
     * Dữ liệu demo: danh mục, sản phẩm, biến thể, khách, đơn, kho, slider.
     * Bỏ qua nếu đã có sản phẩm (tránh chạy lặp gây trùng).
     */
    public function run(): void
    {
        if (DB::table('product')->exists()) {
            if ($this->command) {
                $this->command->info('Bỏ qua mock data: bảng product đã có dữ liệu.');
            }
            return;
        }

        $img = 'image-upload/1776789191501057981_1495730628477175_316823837606792328_n.jpg';
        $now = now();

        $adminId = DB::table('admin')->orderBy('id')->value('id');
        if (! $adminId) {
            throw new \RuntimeException('Cần chạy AdminSeeder trước (bảng admin rỗng).');
        }

        $c1 = DB::table('category')->insertGetId([
            'name' => 'Giày thể thao', 'slug' => 'giay-the-thao', 'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);
        $c2 = DB::table('category')->insertGetId([
            'name' => 'Phụ kiện', 'slug' => 'phu-kien', 'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);

        $b1 = DB::table('brand')->insertGetId([
            'name' => 'Ekka Sport', 'description' => 'Thương hiệu demo nội bộ', 'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);
        $b2 = DB::table('brand')->insertGetId([
            'name' => 'Active Line', 'description' => 'Bộ sưu tập mẫu', 'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);

        $colorRed = DB::table('color')->insertGetId([
            'name' => 'Đỏ', 'hex' => '#C62828', 'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);
        $colorBlue = DB::table('color')->insertGetId([
            'name' => 'Xanh dương', 'hex' => '#1565C0', 'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);
        $colorBlack = DB::table('color')->insertGetId([
            'name' => 'Đen', 'hex' => '#212121', 'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);

        $sM = DB::table('size')->insertGetId([
            'name' => '38', 'status' => 1, 'created_at' => $now, 'updated_at' => $now,
        ]);
        $sL = DB::table('size')->insertGetId([
            'name' => '40', 'status' => 1, 'created_at' => $now, 'updated_at' => $now,
        ]);
        $sXL = DB::table('size')->insertGetId([
            'name' => '42', 'status' => 1, 'created_at' => $now, 'updated_at' => $now,
        ]);

        $mFabric = DB::table('material')->insertGetId([
            'name' => 'Lưới & EVA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now,
        ]);
        $mLeather = DB::table('material')->insertGetId([
            'name' => 'Da tổng hợp', 'status' => 1, 'created_at' => $now, 'updated_at' => $now,
        ]);

        $p1 = DB::table('product')->insertGetId([
            'category_id' => $c1,
            'brand_id' => $b1,
            'name' => 'Giày chạy bộ Ekka Pro',
            'slug' => 'giay-chay-bo-ekka-pro',
            'images' => $img.','.$img,
            'banner' => $img,
            'description' => 'Đệm nhẹ, đế chống trượt.',
            'detail' => '<p>Ứng dụng tập luyện hàng ngày.</p>',
            'discount' => 10,
            'trending' => 1,
            'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);
        $p2 = DB::table('product')->insertGetId([
            'category_id' => $c1,
            'brand_id' => $b2,
            'name' => 'Giày cầu lông Active',
            'slug' => 'giay-cau-long-active',
            'images' => $img,
            'banner' => null,
            'description' => 'Bám sân trong nhà tốt.',
            'detail' => null,
            'discount' => 0,
            'trending' => 0,
            'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);

        $pv1 = DB::table('product_var')->insertGetId([
            'product_id' => $p1, 'color_id' => $colorRed, 'size_id' => $sM, 'material_id' => $mFabric,
            'codeSKU' => 'EK-PRO-RED-38', 'prices' => 890000, 'stock' => 50, 'minQuantity' => 1, 'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);
        $pv2 = DB::table('product_var')->insertGetId([
            'product_id' => $p1, 'color_id' => $colorBlue, 'size_id' => $sL, 'material_id' => $mFabric,
            'codeSKU' => 'EK-PRO-BLUE-40', 'prices' => 890000, 'stock' => 30, 'minQuantity' => 1, 'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);
        $pv3 = DB::table('product_var')->insertGetId([
            'product_id' => $p2, 'color_id' => $colorBlack, 'size_id' => $sL, 'material_id' => $mLeather,
            'codeSKU' => 'AC-BLK-40', 'prices' => 1250000, 'stock' => 20, 'minQuantity' => 1, 'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);
        $pv4 = DB::table('product_var')->insertGetId([
            'product_id' => $p2, 'color_id' => $colorRed, 'size_id' => $sXL, 'material_id' => $mLeather,
            'codeSKU' => 'AC-RED-42', 'prices' => 1250000, 'stock' => 12, 'minQuantity' => 1, 'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);

        $cust1 = DB::table('customer')->insertGetId([
            'secret_key' => 100001,
            'ip' => '127.0.0.1',
            'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);
        $cust2 = DB::table('customer')->insertGetId([
            'secret_key' => 100002,
            'ip' => '127.0.0.1',
            'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);

        DB::table('customer_detail')->insert([
            [
                'customer_id' => $cust1, 'name' => 'Nguyễn Văn A', 'phone' => '0901000001',
                'avatar' => null, 'address' => 'Hà Nội', 'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'customer_id' => $cust2, 'name' => 'Trần Thị B', 'phone' => '0901000002',
                'avatar' => null, 'address' => 'TP. Hồ Chí Minh', 'created_at' => $now, 'updated_at' => $now,
            ],
        ]);

        $pwdHash = Hash::make('password');
        DB::table('customer_auth')->insert([
            [
                'customer_id' => $cust1, 'secret_key' => 50001, 'email' => 'user1@example.com', 'password' => $pwdHash,
                'verify_code' => null, 'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'customer_id' => $cust2, 'secret_key' => 50002, 'email' => 'user2@example.com', 'password' => $pwdHash,
                'verify_code' => null, 'created_at' => $now, 'updated_at' => $now,
            ],
        ]);

        $orderId = DB::table('order_time')->insertGetId([
            'shipper_id' => $adminId,
            'customer_id' => $cust1,
            'status_customer' => 1,
            'subtotal' => '1780000',
            'coupon' => '0',
            'discount' => '0',
            'total' => '1780000',
            'username' => 'Nguyễn Văn A',
            'email' => 'user1@example.com',
            'address' => 'Hà Nội',
            'telephone' => '0901000001',
            'payment' => 'cod',
            'order_status' => '3',
            'status' => '1',
            'created_at' => $now, 'updated_at' => $now,
        ]);

        DB::table('order_detail')->insert([
            [
                'order_id' => $orderId, 'product_id' => $pv1,
                'quantity' => '1', 'price' => '890000', 'discount' => '0', 'total_price' => '890000',
                'suborder_status' => '0', 'status' => '1', 'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'order_id' => $orderId, 'product_id' => $pv2,
                'quantity' => '1', 'price' => '890000', 'discount' => '0', 'total_price' => '890000',
                'suborder_status' => '0', 'status' => '1', 'created_at' => $now, 'updated_at' => $now,
            ],
        ]);

        DB::table('warehouse')->insert([
            [
                'product_id' => $p1, 'quantity' => 200, 'status' => '1',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'product_id' => $p2, 'quantity' => 100, 'status' => '1',
                'created_at' => $now, 'updated_at' => $now,
            ],
        ]);

        $whId = DB::table('warehouse_history')->insertGetId([
            'manager_id' => $adminId, 'status' => '1',
            'created_at' => $now, 'updated_at' => $now,
        ]);
        DB::table('warehouse_history_detail')->insert([
            [
                'warehouse_history_id' => $whId, 'product_id' => $p1, 'price' => 700000, 'quantity' => 20, 'status' => '1',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'warehouse_history_id' => $whId, 'product_id' => $p2, 'price' => 900000, 'quantity' => 10, 'status' => '1',
                'created_at' => $now, 'updated_at' => $now,
            ],
        ]);

        DB::table('slider')->insert([
            [
                'url' => $img, 'status' => 1, 'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'url' => 'image-upload/1776817775501057981_1495730628477175_316823837606792328_n.jpg', 'status' => 1,
                'created_at' => $now, 'updated_at' => $now,
            ],
        ]);
    }
}
