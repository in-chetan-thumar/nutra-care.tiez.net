<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;

class ProductRepository
{
	public $product;

	public function __construct(Product $product)
	{
		$this->product = $product;
	}

    public function getById($id)
    {
        return $this->product->where('id',$id)->first();
    }

    public function getAll()
    {
        //dd($this->product->orderBy('id','DESC')->get()->take(15)->pluck('id'), $this->product->count());
        return $this->product->get();
    }

    public function findByID($id)
    {
        return $this->product->findorFail($id);
    }
    public function getListing($filters = [],$paginate = true, $per_page = null)
    {
        $listing = $this->product->when($filters, function ($qry) use ($filters) {
            if (isset($filters['filter']) && $filters['filter'] != '') {
                $qry->where(function ($search_qry) use ($filters) {
                    $search_qry->where('title', 'LIKE', '%' . $filters['filter'] . '%');
                });
            }
            if(isset($filters['category_id']) && $filters['category_id'] != ''){
                $qry->whereHas('category_product_links', function ($cateory_qry) use($filters){
                    $cateory_qry->whereIn('category_id', $filters['category_id']);
                });
            }


            if (isset($filters['search']) && $filters['search'] != '') {
                $qry->where(function ($search_qry) use ($filters) {
                    $search_qry->where('title', 'LIKE', '%' . $filters['search'] . '%');
                });
            }

            if(isset($filters['category']) && $filters['category'] != ''){
                $qry->whereHas('category_product_links', function ($cateory_qry) use($filters){
                    $cateory_qry->where('category_id', $filters['category']);
                });
            }
            return $qry;
        })->orderBy('title',isset($filters['search_by']) ? $filters['search_by']:'ASC');

        if($paginate){
            return $listing->paginate($per_page);
        }
        return $listing->get();
    }
}
