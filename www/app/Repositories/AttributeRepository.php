<?php

namespace App\Repositories;

use App\Models\Attributes;

class AttributeRepository
{
    public $attribute;

    public function __construct(Attributes $attribute)
    {
        $this->attribute = $attribute;
    }

    public function getById($id)
    {
        return $this->attribute->where('id', $id)->first();
    }

    public function getAll()
    {
        return $this->attribute->get();
    }


    public function getListing($filters = [], $paginate = true, $per_page = null)
    {
        $listing = $this->attribute->when($filters, function ($qry) use ($filters) {

            if (isset($filters['search']) && $filters['search'] != '') {
                $qry->where(function ($search_qry) use ($filters) {
                    $search_qry->where('attribute_name', 'LIKE', '%' . $filters['search'] . '%');
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
