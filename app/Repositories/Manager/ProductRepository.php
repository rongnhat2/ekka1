<?php

namespace App\Repositories\Manager;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;
use Session;
use Hash;
use DB;

class ProductRepository extends BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getfree()
    {
        $sql = "SELECT product.*
                    FROM product
                    WHERE discount = 0";
        return DB::select($sql);
    }
    public function get_product()
    {
        return DB::table('product')
            ->leftJoin('category', 'category.id', '=', 'product.category_id')
            ->leftJoin('brand', 'brand.id', '=', 'product.brand_id')
            ->select('product.*', 'category.name as category_name', 'brand.name as brand_name')
            ->orderBy('product.created_at', 'desc')
            ->get();
    }
    public function get_discount()
    {
        $sql = "SELECT product.*, category.name as category_name
                    FROM product
                    LEFT JOIN category
                    ON category.id = product.category_id
                    WHERE product.discount <> 0
                    ORDER BY product.created_at DESC";
        return DB::select($sql);
    }

    public function get_one($id)
    {
        $sql = "SELECT product.*,
                    category.name as category_name
                FROM product 
                LEFT JOIN category
                ON category.id = product.category_id
                WHERE product.id = " . $id;
        return DB::select($sql);
    }
    public function update_trending($id)
    {
        $sql = 'UPDATE product set trending = !trending WHERE id = ' . $id;
        DB::select($sql);
    }



    // Customer
    public function get_all_condition($request)
    {
        $category_id = $request->tag;
        $keyword = $request->keyword;
        list($prices_from, $prices_to) = explode(',', $request->prices, 2);
        $sort = $request->sort;
        $status = $request->status;
        $where_sql = "";

        if ($category_id > 0)
            $where_sql = " AND category_id = " . $category_id;
        if ($keyword != "")
            $where_sql = " AND name like '%" . $keyword . "%'";
        if ($status == "new") {
            $where_sql = " ORDER BY created_at DESC";
        } else if ($status == "1") {
            $where_sql = " AND discount <> 0";
        }
        $sort_by = "";


        $sql = "SELECT * FROM product WHERE prices BETWEEN " . $prices_from . " AND " . $prices_to . $where_sql;
        return DB::select($sql);
    }
    public function get_condition($request, $count)
    {
        $category_id = $request->tag;
        $keyword = $request->keyword;
        $page = $request->page;
        $pageSize = $request->pageSize;
        list($prices_from, $prices_to) = explode(',', $request->prices, 2);
        $sort = $request->sort;
        $status = $request->status;

        $query = DB::table('product')
            ->whereBetween('prices', [$prices_from, $prices_to]);

        if ($category_id > 0) {
            $query->where('category_id', $category_id);
        }

        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        if ($status == "new") {
            $query->orderBy('created_at', 'desc');
        } else if ($status == "1") {
            $query->where('discount', '<>', 0);
        }

        // Sort Options
        if ($sort == 1) {
            $query->orderBy('created_at', 'desc');
        } else if ($sort == 2) {
            $query->orderBy('name', 'asc');
        } else if ($sort == 3) {
            $query->orderBy('name', 'desc');
        } else if ($sort == 4) {
            $query->orderBy('prices', 'asc');
        } else if ($sort == 5) {
            $query->orderBy('prices', 'desc');
        }

        $offset = ($page - 1) * $pageSize;

        $data = $query->limit($pageSize)->offset($offset)->get();

        return $data;
    }

    // Index
    public function get_trending()
    {
        $sql = "SELECT  *
                FROM product 
                WHERE trending = 1";
        return DB::select($sql);
    }
    public function get_new_arrivals()
    {
        $sql = "SELECT *
                    FROM product 
                    ORDER BY product.created_at DESC
                    LIMIT 4";
        return DB::select($sql);
    }
    public function get_with_category($id)
    {
        $sql = "SELECT *
                FROM product 
                WHERE category_id = " . $id . " LIMIT 8";
        return DB::select($sql);
    }
    public function get_best_sale()
    {
        $sql = "SELECT *
                FROM product 
                ORDER BY discount DESC LIMIT 1";
        return DB::select($sql);
    }
    public function get_related($category_id, $id)
    {
        $sql = "SELECT  *
                FROM product 
                WHERE category_id = " . $category_id . " AND id <> " . $id . "
                LIMIT 4";
        return DB::select($sql);
    }
}
