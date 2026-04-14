<?php

namespace App\Repositories\Manager;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;
use Session;
use Hash;
use DB;

class MaterialRepository extends BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function get_material()
    {
        $sql = "SELECT *
                    FROM material ";
        return DB::select($sql);
    }

    public function get_one($id)
    {
        $sql = "SELECT * FROM material WHERE id = " . $id;
        return DB::select($sql);
    }
}
