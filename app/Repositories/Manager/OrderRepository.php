<?php

namespace App\Repositories\Manager;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;
use Session;
use Hash;
use DB;

class OrderRepository extends BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // admin
    public function get_full_order($id)
    {
        return DB::table('order_detail')
            ->join('product_var', 'product_var.id', '=', 'order_detail.product_id')
            ->join('product', 'product.id', '=', 'product_var.product_id')
            ->leftJoin('size', 'size.id', '=', 'product_var.size_id')
            ->leftJoin('color', 'color.id', '=', 'product_var.color_id')
            ->leftJoin('material', 'material.id', '=', 'product_var.material_id')
            ->select(
                'order_detail.*',
                'product_var.id as pv_id',
                'product_var.stock',
                'product.name',
                'product.images',
                'size.name as size_name',
                'color.name as color_name',
                'material.name as material_name'
            )
            ->where('order_detail.order_id', $id)
            ->get();
    }
    public function get_in_order($id)
    {
        $sql = " SELECT *
                    FROM order_time
                    WHERE id = " . $id;
        return DB::select($sql);
    }
    public function update_status($id)
    {
        $sql = "UPDATE order_detail
                SET suborder_status = 1
                WHERE order_id = " . $id;
        return DB::select($sql);
    }

    /**
     * order_detail.product_id = product_var.id (biến thể)
     * Chỉ join product_var, không join size/color để không mất dòng.
     */
    public function get_order_lines_for_stock($orderId)
    {
        return DB::table("order_detail")
            ->join("product_var", "product_var.id", "=", "order_detail.product_id")
            ->where("order_detail.order_id", (int) $orderId)
            ->select(
                "order_detail.id as order_detail_id",
                "order_detail.product_id as product_var_id",
                "order_detail.quantity as qty_raw",
                "product_var.stock as var_stock"
            )
            ->get();
    }

    public function get_order_time_row($id)
    {
        return DB::table("order_time")
            ->where("id", (int) $id)
            ->first();
    }



    public function get_turnover()
    {
        $sql = " SELECT sum(total) as total
                    FROM order_time
                    WHERE order_status = 3";
        return DB::select($sql);
    }
    public function get_item_sell()
    {
        $sql = " SELECT sum(quantity) as total
                    FROM order_time
                    LEFT JOIN order_detail
                    ON order_time.id = order_detail.order_id
                    WHERE order_status = 3";
        return DB::select($sql);
    }
    public function get_order_time()
    {
        $sql = " SELECT count(*) as total
                    FROM order_time
                    WHERE order_status = 3";
        return DB::select($sql);
    }
    public function get_customer_buy()
    {
        $sql = " SELECT count(customer_id) as total
                    FROM order_time
                    WHERE order_status = 3 AND status_customer = 1
                    GROUP BY customer_id";
        return DB::select($sql);
    }
    public function get_best_sale()
    {
        $sql = " SELECT order_detail.product_id, 
                        sum(order_detail.quantity) as total, 
                        warehouse.quantity,
                        product.name,
                        product.images
                    FROM order_time
                    LEFT JOIN order_detail
                    ON order_time.id = order_detail.order_id
                    LEFT JOIN warehouse
                    ON warehouse.product_id = order_detail.product_id
                    LEFT JOIN product
                    ON order_detail.product_id = product.id
                    WHERE order_status = 3
                    GROUP BY order_detail.product_id, 
                            warehouse.quantity,
                            product.name,
                            product.images
                    ORDER BY total DESC LIMIT 5";
        return DB::select($sql);
    }
    public function get_customer_new()
    {
        $sql = "SELECT count(customer_id) as total
                FROM order_time
                WHERE order_status = 3 AND status_customer = 1
                GROUP BY customer_id ";
        return DB::select($sql);
    }
    public function get_customer_free()
    {
        $sql = "SELECT count(customer_id) as total
                FROM order_time
                WHERE order_status = 3 AND status_customer = 0
                GROUP BY customer_id";
        return DB::select($sql);
    }


    // customer
    public function get_order($id)
    {
        $sql = " SELECT * 
                FROM order_time
                WHERE order_status = " . $id;
        return DB::select($sql);
    }
    public function get_sub_order($id)
    {
        return DB::table('order_detail')
            ->join('product_var', 'product_var.id', '=', 'order_detail.product_id')
            ->join('product', 'product.id', '=', 'product_var.product_id')
            ->where('order_id', $id)
            ->get();
    }
}
