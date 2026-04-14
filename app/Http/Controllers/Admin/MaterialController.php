<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Repositories\Manager\MaterialRepository;
use App\Models\Material;
use Carbon\Carbon;
use Session;
use Hash;
use DB;

class MaterialController extends Controller
{
    protected $material;

    public function __construct(Material $material)
    {
        $this->material = new MaterialRepository($material);
    }
    public function index()
    {
        return view("admin.manager.material");
    }
    public function get()
    {
        $data = $this->material->get_material();
        return $this->material->send_response(201, $data, null);
    }
    public function get_one($id)
    {
        $data = $this->material->get_one($id);
        return $this->material->send_response(200, $data, null);
    }
    public function store(Request $request)
    {
        $data = [
            "name" => $request->data_name,
        ];
        DB::table('material')->insert($data);
        return $this->material->send_response(201, null, null);
    }
    public function update(Request $request)
    {
        $id = $request->data_id;
        $data_update = [
            "name" => $request->data_name,
        ];
        DB::table('material')->where('id', $id)->update($data_update);
        return $this->material->send_response(200, null, null);
    }

    public function delete($id)
    {
        DB::table('material')->where('id', $id)->delete();
        return $this->material->send_response(200, "Delete successful", null);
    }
}
