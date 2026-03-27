<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Repositories\Manager\CarouselRepository;
use App\Models\Carousel;
use Carbon\Carbon;
use Session;
use Hash;
use DB;

class CarouselController extends Controller
{
    protected $carousel;

    public function __construct(Carousel $carousel){
        $this->carousel             = new CarouselRepository($carousel);
    }
    public function index(){
        return view("admin.manager.carousel");
    }
    public function get(){
        $data = $this->carousel->get_carousel();
        return $this->carousel->send_response(201, $data, null);
    }
    public function store(Request $request){ 

        $image_list_prev     = $request->data_images_preview;

        $image_list     = array();
        if ($request->image_list_length > 0) {
            for ($i=0; $i < $request->image_list_length; $i++) { 
                array_push($image_list, $this->carousel->imageInventor('image-upload', $request['image_list_item_'.$i], 1920));
            }
            $data['url'] = $image_list_prev.",".implode(",",$image_list);
        }else{ 
            $data['url'] = $image_list_prev;
        }
        $data_get = $this->carousel->get_carousel();
        if (count($data_get) == 0) {
            $this->carousel->create($data);
        }else{ 
            $id                 = $this->carousel->get_carousel()[0]->id;  
            $this->carousel->update($data, $id);
        }
        return $this->carousel->send_response(200, null, null);
    } 
}
