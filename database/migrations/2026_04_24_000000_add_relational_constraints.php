<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Ràng buộc quan hệ (MySQL):
 *
 * - order_detail.product_id  →  product_var.id  (cột tên cũ, nghĩa là biến thể).
 * - warehouse.product_id, warehouse_history_detail.product_id  →  product.id.
 *
 * Chạy: migrate sạch; nếu dữ liệu cũ mồ côi, sửa/xóa bản ghi trước khi chạy.
 */
class AddRelationalConstraints extends Migration
{
    public function up(): void
    {
        if (Schema::getConnection()->getDriverName() !== 'mysql') {
            return;
        }

        $this->alignUnsignedKeyColumns();
        $this->dropLaravelForeignKeys();
        $this->addForeignKeys();
    }

    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() !== 'mysql') {
            return;
        }

        $this->dropLaravelForeignKeys();
    }

    /**
     * Khớp kiểu với cột id tăng (INT UNSIGNED) để tạo FK hợp lệ.
     */
    protected function alignUnsignedKeyColumns(): void
    {
        $alters = [
            'product' => [
                'category_id' => 'INT UNSIGNED NOT NULL',
                'brand_id' => 'INT UNSIGNED NOT NULL',
            ],
            'product_var' => [
                'product_id' => 'INT UNSIGNED NOT NULL',
                'color_id' => 'INT UNSIGNED NOT NULL',
                'size_id' => 'INT UNSIGNED NOT NULL',
                'material_id' => 'INT UNSIGNED NOT NULL',
            ],
            'customer_detail' => [
                'customer_id' => 'INT UNSIGNED NOT NULL',
            ],
            'customer_auth' => [
                'customer_id' => 'INT UNSIGNED NOT NULL',
            ],
            'order_time' => [
                'customer_id' => 'INT UNSIGNED NOT NULL',
                'shipper_id' => 'INT UNSIGNED NULL',
            ],
            'order_detail' => [
                'order_id' => 'INT UNSIGNED NOT NULL',
                'product_id' => 'INT UNSIGNED NOT NULL',
            ],
            'warehouse' => [
                'product_id' => 'INT UNSIGNED NOT NULL',
            ],
            'warehouse_history' => [
                'manager_id' => 'INT UNSIGNED NOT NULL',
            ],
            'warehouse_history_detail' => [
                'warehouse_history_id' => 'INT UNSIGNED NOT NULL',
                'product_id' => 'INT UNSIGNED NOT NULL',
            ],
        ];

        foreach ($alters as $table => $columns) {
            foreach ($columns as $column => $definition) {
                $this->safeStatement(
                    "ALTER TABLE `{$table}` MODIFY `{$column}` {$definition}"
                );
            }
        }
    }

    protected function safeStatement(string $sql): void
    {
        try {
            DB::statement($sql);
        } catch (\Throwable $e) {
            // Cột/kiểu đã đúng hoặc tên bảng khác môi trường — bỏ qua.
        }
    }

    /**
     * Gỡ FK theo tên Laravel mặc định: {bảng}_{cột}_foreign
     */
    protected function dropLaravelForeignKeys(): void
    {
        $drops = [
            'order_detail' => ['order_id', 'product_id'],
            'order_time' => ['customer_id', 'shipper_id'],
            'product_var' => ['product_id', 'color_id', 'size_id', 'material_id'],
            'product' => ['category_id', 'brand_id'],
            'customer_detail' => ['customer_id'],
            'customer_auth' => ['customer_id'],
            'warehouse' => ['product_id'],
            'warehouse_history' => ['manager_id'],
            'warehouse_history_detail' => ['warehouse_history_id', 'product_id'],
        ];

        foreach ($drops as $table => $columns) {
            foreach ($columns as $column) {
                try {
                    Schema::table($table, function (Blueprint $blueprint) use ($column) {
                        $blueprint->dropForeign([$column]);
                    });
                } catch (\Throwable $e) {
                }
            }
        }
    }

    protected function addForeignKeys(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')->on('category')
                ->restrictOnDelete();
            $table->foreign('brand_id')
                ->references('id')->on('brand')
                ->restrictOnDelete();
        });

        Schema::table('product_var', function (Blueprint $table) {
            $table->foreign('product_id')
                ->references('id')->on('product')
                ->cascadeOnDelete();
            $table->foreign('color_id')
                ->references('id')->on('color')
                ->restrictOnDelete();
            $table->foreign('size_id')
                ->references('id')->on('size')
                ->restrictOnDelete();
            $table->foreign('material_id')
                ->references('id')->on('material')
                ->restrictOnDelete();
        });

        Schema::table('customer_detail', function (Blueprint $table) {
            $table->foreign('customer_id')
                ->references('id')->on('customer')
                ->cascadeOnDelete();
        });

        Schema::table('customer_auth', function (Blueprint $table) {
            $table->foreign('customer_id')
                ->references('id')->on('customer')
                ->cascadeOnDelete();
        });

        Schema::table('order_time', function (Blueprint $table) {
            $table->foreign('customer_id')
                ->references('id')->on('customer')
                ->restrictOnDelete();
            $table->foreign('shipper_id')
                ->references('id')->on('admin')
                ->nullOnDelete();
        });

        Schema::table('order_detail', function (Blueprint $table) {
            $table->foreign('order_id')
                ->references('id')->on('order_time')
                ->cascadeOnDelete();
            $table->foreign('product_id')
                ->references('id')->on('product_var')
                ->restrictOnDelete();
        });

        Schema::table('warehouse', function (Blueprint $table) {
            $table->foreign('product_id')
                ->references('id')->on('product')
                ->cascadeOnDelete();
        });

        Schema::table('warehouse_history', function (Blueprint $table) {
            $table->foreign('manager_id')
                ->references('id')->on('admin')
                ->restrictOnDelete();
        });

        Schema::table('warehouse_history_detail', function (Blueprint $table) {
            $table->foreign('warehouse_history_id')
                ->references('id')->on('warehouse_history')
                ->cascadeOnDelete();
            $table->foreign('product_id')
                ->references('id')->on('product')
                ->restrictOnDelete();
        });
    }
}
