<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use Carbon\Carbon;


use Session;
use Hash;
use DB;

class DisplayController extends Controller
{
    public function index(Request $request)
    {
        $page = "page-template-template-homepage-v1";
        return view("customer.index", compact("page"));
    }
    public function product(Request $request)
    {
        $page = "page home page-template-default single-product full-width normal";
        return view("customer.product", compact("page"));
    }
    public function category(Request $request)
    {
        $page = "left-sidebar";
        return view("customer.category", compact("page"));
    }
    public function news(Request $request)
    {
        $page = "left-sidebar";
        return view("customer.news", compact("page"));
    }
    public function news_detail(Request $request)
    {
        $page = "left-sidebar";
        return view("customer.news_detail", compact("page"));
    }

    public function cart(Request $request)
    {
        $page = "page home page-template-default";
        return view("customer.cart", compact("page"));
    }
    public function checkout(Request $request)
    {
        $page = "page home page-template-default";
        return view("customer.checkout", compact("page"));
    }
    public function profile(Request $request)
    {
        $page = "page home page-template-default";
        return view("customer.profile", compact("page"));
    }
    public function login(Request $request)
    {
        $page = "page home page-template-default";
        return view("customer.auth", compact("page"));
    }
    public function register(Request $request)
    {
        $page = "page home page-template-default";
        return view("customer.register", compact("page"));
    }
    public function forgot(Request $request)
    {
        $page = "page home page-template-default";
        return view("customer.forgot", compact("page"));
    }
}
