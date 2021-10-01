<?php

namespace App\Repositories;

use App\Models\Attributes;
use App\Models\Inquiry;

class InquiryRepository
{
    public $inquiry;

    public function __construct(Inquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    public function getById($id)
    {
        return $this->inquiry->where('id', $id)->first();
    }

    public function getAll()
    {
        return $this->inquiry->get();
    }


    public function getListing($filters = [], $paginate = true, $per_page = null)
    {
        $listing = $this->inquiry->when($filters, function ($qry) use ($filters) {

            if (isset($filters['search']) && $filters['search'] != '') {
                $qry->where(function ($search_qry) use ($filters) {
                    $search_qry->where('name', 'LIKE', '%' . $filters['search'] . '%');
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
