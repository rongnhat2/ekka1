<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Repositories\Manager\BrandRepository;
use App\Models\Brand;
use Carbon\Carbon;
use Session;
use Hash;
use DB;

class BrandController extends Controller
{
    protected $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = new BrandRepository($brand);
    }
    public function index()
    {
        return view("admin.manager.brand");
    }
    public function get()
    {
        $data = $this->brand->get_brand();
        return $this->brand->send_response(201, $data, null);
    }
    public function get_one($id)
    {
        $data = $this->brand->get_one($id);
        return $this->brand->send_response(200, $data, null);
    }
    public function store(Request $request)
    {
        $data = [
            "name" => $request->data_name,
            "description" => $request->data_description,
        ];
        DB::table('brand')->insert($data);
        return $this->brand->send_response(201, null, null);
    }
    public function update(Request $request)
    {
        $id = $request->data_id;
        $data_update = [
            "name" => $request->data_name,
            "description" => $request->data_description,
        ];
        DB::table('brand')->where('id', $id)->update($data_update);
        return $this->brand->send_response(200, null, null);
    }

    public function delete($id)
    {
        DB::table('brand')->where('id', $id)->delete();
        return $this->brand->send_response(200, "Delete successful", null);
    }
}
