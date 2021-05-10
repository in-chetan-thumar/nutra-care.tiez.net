<?php

namespace App\Repositories;

use App\Models\NewsCategory;

class NewsCategoryRepository
{
	public $notification;

	public function __construct(NewsCategory $news_category)
	{
		$this->news_category = $news_category;
	}

    public function getById($id)
    {
        return $this->news_category->where('id',$id)->first();
    }

    public function getAll()
    {
        return $this->news_category->get();
    }

    public function getFirstWhere($data = []){
        return $this->news_category->when($data,function($qry) use($data){
            if(count($data)){
                foreach($data as $key => $value){
                    $qry->where($key,$value);
                }
            }
            return $qry;
        })->first();
    }

    public function getAllWhere($data = []){
        return $this->news_category->when($data,function($qry) use($data){
            if(count($data)){
                foreach($data as $key => $value){
                    $qry->where($key,$value);
                }
            }
            return $qry;
        })->get();
    }

    public function getListing($filters = [], $paginate = true, $per_page = null)
    {
        $listing = $this->news_category
        ->when($filters,function($qry) use($filters){
            if(isset($filters['status']) && $filters['status'] != ''){
                $qry->where('is_active', $filters['status']);
            }

            return $qry;
        })->orderBy('id', 'desc');

        if($paginate){
            return $listing->paginate($per_page);
        }
        
        return $listing->get();
    }
}