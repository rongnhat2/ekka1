<?php

namespace App\Http\Controllers\Customer;

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
    public function get(){
        $data = $this->carousel->get_carousel();
        return $this->carousel->send_response(201, $data, null);
    }
}
