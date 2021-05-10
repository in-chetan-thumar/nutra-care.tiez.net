<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getById($id)
    {
        return $this->category->where('id', $id)->first();
    }

    public function getAll()
    {
        return $this->category->get();
    }


    public function getListing($filters = [], $paginate = true, $per_page = null)
    {
        $listing = $this->category->when($filters, function ($qry) use ($filters) {

            if (isset($filters['search']) && $filters['search'] != '') {
                $qry->where(function ($search_qry) use ($filters) {
                    $search_qry->where('title', 'LIKE', '%' . $filters['search'] . '%');
                });
            }
            return $qry;
        })->orderBy('id', 'desc');

        if ($paginate) {
            return $listing->paginate($per_page);
        }

        return $listing->get();
    }
}
