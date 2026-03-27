<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Repositories\Manager\NewsRepository;
use App\Models\News;
use Carbon\Carbon;
use Session;
use Hash;
use DB;


class NewsController extends Controller
{
    protected $news;

    public function __construct(News $news){
        $this->news             = new NewsRepository($news);
    }
    public function index(){
        return view("admin.manager.news");
    }
    public function get(Request $request){ 
        $data = $this->news->get_news();
        return $this->news->send_response(201, $data, null);
    }
    public function store(Request $request){  
        $data = [
            "image"         => $this->news->imageInventor('image-upload', $request->data_images, 500),
            "title"         => $request->data_title, 
            "slug"          => $this->news->to_slug($request->data_title), 
            "description"   => nl2br($request->data_description ?? ""),
            "detail"        => $request->data_detail ?? "", 
        ]; 
        $data_return = $this->news->create($data);
        return $this->news->send_response(201, $data_return, null);
    }
    public function get_one($id){
        $data = $this->news->get_one($id);
        return $this->news->send_response(200, $data, null);
    } 
    public function update(Request $request){
        $id                 = $request->data_id;
        $data_update   = [
            "title"         => $request->data_title, 
            "slug"          => $this->news->to_slug($request->data_title), 
            "description"   => nl2br($request->data_description ?? ""),
            "detail"        => $request->data_detail ?? "", 
        ];
        if ($request->data_images != "undefined") {
            $data_update["image"] = $this->news->imageInventor('image-upload', $request->data_images, 500);
        }
        $this->news->update($data_update, $id);
        return $this->news->send_response(200, null, null);
    }

    public function delete($id){
        $data = $this->news->delete($id);
        return $this->news->send_response(200, "Delete successful", null);
    }
}
