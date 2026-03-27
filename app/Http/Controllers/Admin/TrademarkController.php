<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Repositories\Manager\TrademarkRepository;
use App\Models\Trademark;
use Carbon\Carbon;
use Session;
use Hash;
use DB;

class TrademarkController extends Controller
{
    protected $trademark;

    public function __construct(Trademark $trademark){
        $this->trademark             = new TrademarkRepository($trademark);
    }
    public function index(){
        return view("admin.manager.trademark");
    }
    public function get(){
        $data = $this->trademark->get_trademark();
        return $this->trademark->send_response(201, $data, null);
    }
    public function get_one($id){
        $data = $this->trademark->get_one($id);
        return $this->trademark->send_response(200, $data, null);
    }
    public function store(Request $request){
        $data = [
            "name"      => $request->data_name,
            "slug"      => $this->trademark->to_slug($request->data_name),
        ];
        $data_return = $this->trademark->create($data);
        return $this->trademark->send_response(201, null, null);
    }
    public function update(Request $request){
        $id                 = $request->data_id;
        $data_update   = [
            "name"      => $request->data_name,
            "slug"      => $this->trademark->to_slug($request->data_name),
        ];
        $this->trademark->update($data_update, $id);
        return $this->trademark->send_response(200, null, null);
    }

    public function delete($id){
        $data = $this->trademark->delete($id);
        return $this->trademark->send_response(200, "Delete successful", null);
    }

}
