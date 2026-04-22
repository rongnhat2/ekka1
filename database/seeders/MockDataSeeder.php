<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MockDataSeeder extends Seeder
{
    /**
     * Dữ liệu demo shop thời trang (quần áo): danh mục, sản phẩm, biến thể, khách, đơn, kho, slider.
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
            'name' => 'Áo', 'slug' => 'ao', 'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);
        $c2 = DB::table('category')->insertGetId([
            'name' => 'Quần', 'slug' => 'quan', 'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);

        $b1 = DB::table('brand')->insertGetId([
            'name' => 'Ekka Basic', 'description' => 'Thời trang cơ bản, bền màu, form chuẩn.', 'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);
        $b2 = DB::table('brand')->insertGetId([
            'name' => 'Urban Line', 'description' => 'Phong cách streetwear đô thị cho giới trẻ.', 'status' => 1,
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

        $sS = DB::table('size')->insertGetId([
            'name' => 'S', 'status' => 1, 'created_at' => $now, 'updated_at' => $now,
        ]);
        $sM = DB::table('size')->insertGetId([
            'name' => 'M', 'status' => 1, 'created_at' => $now, 'updated_at' => $now,
        ]);
        $sL = DB::table('size')->insertGetId([
            'name' => 'L', 'status' => 1, 'created_at' => $now, 'updated_at' => $now,
        ]);

        $mCotton = DB::table('material')->insertGetId([
            'name' => 'Cotton 100%', 'status' => 1, 'created_at' => $now, 'updated_at' => $now,
        ]);
        $mDenim = DB::table('material')->insertGetId([
            'name' => 'Denim co giãn', 'status' => 1, 'created_at' => $now, 'updated_at' => $now,
        ]);

        $p1 = DB::table('product')->insertGetId([
            'category_id' => $c1,
            'brand_id' => $b1,
            'name' => 'Áo thun cổ tròn Ekka Basic',
            'slug' => 'ao-thun-co-tron-ekka-basic',
            'images' => $img.','.$img,
            'banner' => $img,
            'description' => 'Cotton mịn, thấm mồ hôi, dễ phối với quần jean hoặc kaki.',
            'detail' => '<p>Form regular, đường may kỹ, giữ form sau nhiều lần giặt.</p>',
            'discount' => 10,
            'trending' => 1,
            'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);
        $p2 = DB::table('product')->insertGetId([
            'category_id' => $c2,
            'brand_id' => $b2,
            'name' => 'Quần jean slim Urban',
            'slug' => 'quan-jean-slim-urban',
            'images' => $img,
            'banner' => null,
            'description' => 'Ống slim vừa, denim co giãn nhẹ, tôn dáng.',
            'detail' => null,
            'discount' => 0,
            'trending' => 0,
            'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);

        $pv1 = DB::table('product_var')->insertGetId([
            'product_id' => $p1, 'color_id' => $colorRed, 'size_id' => $sS, 'material_id' => $mCotton,
            'codeSKU' => 'EK-TS-RED-S', 'prices' => 350000, 'stock' => 50, 'minQuantity' => 1, 'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);
        $pv2 = DB::table('product_var')->insertGetId([
            'product_id' => $p1, 'color_id' => $colorBlue, 'size_id' => $sM, 'material_id' => $mCotton,
            'codeSKU' => 'EK-TS-BLUE-M', 'prices' => 350000, 'stock' => 30, 'minQuantity' => 1, 'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);
        $pv3 = DB::table('product_var')->insertGetId([
            'product_id' => $p2, 'color_id' => $colorBlack, 'size_id' => $sM, 'material_id' => $mDenim,
            'codeSKU' => 'UR-JN-BLK-M', 'prices' => 450000, 'stock' => 20, 'minQuantity' => 1, 'status' => 1,
            'created_at' => $now, 'updated_at' => $now,
        ]);
        $pv4 = DB::table('product_var')->insertGetId([
            'product_id' => $p2, 'color_id' => $colorRed, 'size_id' => $sL, 'material_id' => $mDenim,
            'codeSKU' => 'UR-JN-RED-L', 'prices' => 450000, 'stock' => 12, 'minQuantity' => 1, 'status' => 1,
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
            'subtotal' => '700000',
            'coupon' => '0',
            'discount' => '0',
            'total' => '700000',
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
                'quantity' => '1', 'price' => '350000', 'discount' => '0', 'total_price' => '350000',
                'suborder_status' => '0', 'status' => '1', 'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'order_id' => $orderId, 'product_id' => $pv2,
                'quantity' => '1', 'price' => '350000', 'discount' => '0', 'total_price' => '350000',
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
                'warehouse_history_id' => $whId, 'product_id' => $p1, 'price' => 180000, 'quantity' => 30, 'status' => '1',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'warehouse_history_id' => $whId, 'product_id' => $p2, 'price' => 240000, 'quantity' => 20, 'status' => '1',
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
