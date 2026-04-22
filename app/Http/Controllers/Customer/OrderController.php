<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Repositories\Manager\OrderRepository;
use App\Models\Order;
use App\Models\OrderDetail;

use App\Repositories\Manager\ProductRepository;
use App\Models\Product;

use Carbon\Carbon;
use Session;
use Hash;
use DB;

class OrderController extends Controller
{

    protected $order;
    protected $order_detail;
    protected $product;

    public function __construct(Order $order, OrderDetail $order_detail, Product $product)
    {
        $this->order             = new OrderRepository($order);
        $this->order_detail      = new OrderRepository($order_detail);

        $this->product           = new ProductRepository($product);
    }
    public function get(Request $request, $id)
    {
        $data = $this->order_detail->get_sub_order($id);
        return $this->order_detail->send_response(200, $data, null);
    }
    public function create(Request $request)
    {
        list($user_id, $token) = explode('$', $request->cookie('_token_'), 2);
        $data_login     = $request->data_login;

        $data_item     = array_values(array_filter(explode("-", (string) $request->data_item), function ($v) {
            return (string) $v !== '';
        }));
        $data_quantity = array_map('trim', explode("-", (string) $request->data_quantity));
        $data_prices   = $request->data_prices;

        $data_username  = $request->data_username;
        $data_address   = $request->data_address;
        $data_telephone = $request->data_telephone;
        $data_email     = $request->data_email;
        $data_payment   = $request->data_payment;

        $data_order_create = [
            "customer_id"           => $user_id,
            "status_customer"       => $data_login,
            "subtotal"              => $data_prices,
            "discount"              => 0,
            "total"                 => $data_prices,
            "username"              => $data_username,
            "email"                 => $data_email,
            "address"               => $data_address,
            "telephone"             => $data_telephone,
            "payment"               => $data_payment,
        ];
        $order_create = $this->order->create($data_order_create);

        foreach ($data_item as $key => $product_var_id) {
            $line = $this->product->get_one_cart_by_product_var_id($product_var_id);
            if (! $line) {
                continue;
            }
            $product_id = (int) $line->id;
            $unit       = (float) (isset($line->var_prices) && $line->var_prices !== null && $line->var_prices !== ''
                ? $line->var_prices
                : $line->prices);
            $disc       = (float) ($line->discount ?? 0);
            $qty        = isset($data_quantity[$key]) && $data_quantity[$key] !== ''
                ? (int) $data_quantity[$key]
                : 1;
            if ($qty < 1) {
                $qty = 1;
            }
            $line_unit_after = $disc == 0.0
                ? $unit
                : $unit - ($unit * $disc / 100.0);
            $total_price     = $qty * $line_unit_after;

            $size_label_parts = [];
            if (! empty($line->size_name)) {
                $size_label_parts[] = $line->size_name;
            }
            if (! empty($line->color_name)) {
                $size_label_parts[] = $line->color_name;
            }

            $data_detail = [
                "order_id"    => $order_create->id,
                "product_id"  => $product_var_id,
                "quantity"    => (string) $qty,
                "discount"    => (string) $disc,
                "price"       => (string) $unit,
                "total_price" => (string) $total_price,
            ];
            $this->order_detail->create($data_detail);
        }

        return $order_create;
    }
}
