<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Repositories\Manager\OrderRepository;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Repositories\Manager\WarehouseRepository;
use App\Models\Warehouse;

use Carbon\Carbon;
use Session;
use Hash;
use DB;

class OrderController extends Controller
{
    protected $order;
    protected $order_detail;
    protected $warehouse;

    public function __construct(Order $order, OrderDetail $order_detail, Warehouse $warehouse ){
        $this->order            = new OrderRepository($order);
        $this->order_detail     = new OrderRepository($order_detail);
        $this->warehouse                    = new WarehouseRepository($warehouse);
    }
    public function index(){
        return view("admin.manager.order");
    }

    public function get(Request $request){
        $id = $request->id;
        $data = $this->order->get_order($id);
        return $this->order->send_response(201, $data, null);
    }
    public function get_one(Request $request){
        $data_order = $this->order->get_in_order($request->id);
        $data_sub = $this->order_detail->get_full_order($request->id);
        $data = [
            "data_order" => $data_order,
            "data_sub" => $data_sub,
        ];
        return $this->order_detail->send_response(200, $data, null);
    }
    /**
     * order_time.order_status: 0 Chờ xử lý, 1 Chưa hoàn thiện, 2 Đã hoàn thiện,
     * 3 Đã giao hàng (trừ product_var.stock), 4 Hoàn trả (cộng lại stock — chỉ khi chưa ở trạng thái cuối).
     * order_detail.product_id = product_var.id (biến thể).
     * Trạng thái 3 hoặc 4: không cho đổi sang bất kỳ trạng thái nào khác; không cho 3 → 4.
     */
    public function update(Request $request)
    {
        $orderId   = (int) $request->data_id;
        $newStatus = (int) $request->data_status;

        $orderRow = $this->order->get_order_time_row($orderId);
        if (! $orderRow) {
            return $this->order->send_response(404, null, 404);
        }

        $old = (int) $orderRow->order_status;
        if ($old === $newStatus) {
            return $this->order->send_response(201, null, null);
        }

        if (in_array($old, [3, 4], true)) {
            return $this->order->send_response(400, 'ORDER_LOCKED', 400);
        }

        try {
            DB::beginTransaction();

            if ($newStatus === 3) {
                $lines = $this->order_detail->get_order_lines_for_stock($orderId);
                foreach ($lines as $line) {
                    $varId = (int) $line->product_var_id;
                    $qty   = (int) $line->qty_raw;
                    if ($varId < 1 || $qty < 1) {
                        continue;
                    }
                    $rows = $this->warehouse->warehouse_get_item($varId);
                    if (count($rows) === 0) {
                        DB::rollBack();
                        return $this->order->send_response(500, null, null);
                    }
                    $stock = (int) $rows[0]->stock;
                    if ($stock < $qty) {
                        DB::rollBack();
                        return $this->order->send_response(500, null, null);
                    }
                    $this->warehouse->update_item($varId, $stock - $qty);
                }
                $this->order_detail->update_status($orderId);
            } elseif ($newStatus === 4) {
                // Hoàn trả: không cộng kho ở đây (3→4 bị cấm; từ 0/1/2 chưa trừ kho ở bước giao 3).
                $this->order_detail->update_status($orderId);
            }

            $this->order->update(['order_status' => $newStatus], $orderId);
            DB::commit();
            return $this->order->send_response(201, null, null);
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->order->send_response(500, null, null);
        }
    }


    // Statistic
    public function get_total(){
        $turnover = $this->order->get_turnover();
        $item_sell = $this->order->get_item_sell();
        $order_time = $this->order->get_order_time();
        $customer_buy = $this->order->get_customer_buy();

        $data = [
            "turnover"  => $turnover,
            "item_sell"  => $item_sell,
            "order_time"  => $order_time,
            "customer_buy"  => $customer_buy,
        ];
        return $data;
    }
    public function get_best_sale(){
        $best_sale = $this->order->get_best_sale();
        return $best_sale;
    }
    public function get_customer(){
        $customer_new = $this->order->get_customer_new();
        $customer_free = $this->order->get_customer_free();
        $data = [
            "customer_new"  => $customer_new,
            "customer_free"  => $customer_free,
        ];
        return $data;
    }
}
