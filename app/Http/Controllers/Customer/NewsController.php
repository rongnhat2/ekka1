<?php

namespace App\Http\Controllers\Customer;

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
    public function get(Request $request){ 
        $data = $this->news->get_news();
        return $this->news->send_response(201, $data, null);
    }
    public function get_one($id){
        $data = $this->news->get_one($id);
        return $this->news->send_response(200, $data, null);
    } 
}
