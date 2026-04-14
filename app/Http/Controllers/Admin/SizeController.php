<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Repositories\Manager\SizeRepository;
use App\Models\Size;
use Carbon\Carbon;
use Session;
use Hash;
use DB;

class SizeController extends Controller
{
    protected $size;

    public function __construct(Size $size)
    {
        $this->size = new SizeRepository($size);
    }
    public function index()
    {
        return view("admin.manager.size");
    }
    public function get()
    {
        $data = $this->size->get_size();
        return $this->size->send_response(201, $data, null);
    }
    public function get_one($id)
    {
        $data = $this->size->get_one($id);
        return $this->size->send_response(200, $data, null);
    }
    public function store(Request $request)
    {
        $data = [
            "name" => $request->data_name,
        ];
        DB::table('size')->insert($data);
        return $this->size->send_response(201, null, null);
    }
    public function update(Request $request)
    {
        $id = $request->data_id;
        $data_update = [
            "name" => $request->data_name,
        ];
        DB::table('size')->where('id', $id)->update($data_update);
        return $this->size->send_response(200, null, null);
    }

    public function delete($id)
    {
        DB::table('size')->where('id', $id)->delete();
        return $this->size->send_response(200, "Delete successful", null);
    }
}
