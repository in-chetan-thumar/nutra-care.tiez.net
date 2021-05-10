<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository
{
	public $news;

	public function __construct(News $news)
	{
		$this->news = $news;
	}

    public function getById($id)
    {
        return $this->news->where('id',$id)->first();
    }

    public function getAll()
    {
        return $this->news->get();
    }

    public function getByCategory($category)
    {
        $listing = $this->news
        ->whereHas('news_category', function($role_qry) use($category){
            $role_qry->where('category', $category);
        });
        return $listing->get();
    }

    public function getFirstWhere($data = []){
        return $this->news->when($data,function($qry) use($data){
            if(count($data)){
                foreach($data as $key => $value){
                    $qry->where($key,$value);
                }
            }
            return $qry;
        })->first();
    }

    public function getAllWhere($data = []){
        return $this->news->when($data,function($qry) use($data){
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
        //$listing = $this->news->with(['category'])
        $listing = $this->news
        ->when($filters,function($qry) use($filters){
            if(isset($filters['status']) && $filters['status'] != ''){
                $qry->where('is_active', $filters['status']);
            }

            if(isset($filters['category']) && $filters['category'] != ''){
                $qry->whereHas('category', function ($cateory_qry) use($filters){
                    $cateory_qry->where('id', $filters['category']);
                });
            }

            if(isset($filters['search']) && $filters['search'] != ''){
                $qry->where(function($search_qry) use($filters){
                    $search_qry->where('title','LIKE','%'.$filters['search'].'%');
                });
            }
            return $qry;
        })->orderBy('id', 'desc');

        if($paginate){
            return $listing->paginate($per_page);
        }
        
        return $listing->get();
    }
}
