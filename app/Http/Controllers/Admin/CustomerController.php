<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Repositories\CustomerRepository;
use App\Models\Customer;
use Carbon\Carbon;
use Session;
use Hash;
use DB;

class CustomerController extends Controller
{
    protected $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = new CustomerRepository($customer);
    }
    public function index()
    {
        return view("admin.manager.customer");
    }
    public function get()
    {
        $data = $this->customer->get_customer();
        return $this->customer->send_response(201, $data, null);
    }
    public function get_one($id)
    {
        $data = $this->customer->get_one($id);
        return $this->customer->send_response(200, $data, null);
    }
}
