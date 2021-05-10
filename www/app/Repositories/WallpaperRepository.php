<?php

namespace App\Repositories;

use App\Models\Wallpaper;

class WallpaperRepository
{
	public $wallpaper;

	public function __construct(Wallpaper $wallpaper)
	{
		$this->wallpaper = $wallpaper;
	}

    public function getById($id)
    {
        return $this->wallpaper->where('id',$id)->first();
    }

    public function getAll()
    {
        return $this->wallpaper->get();
    }

    public function getFirstWhere($data = []){
        return $this->wallpaper->when($data,function($qry) use($data){
            if(count($data)){
                foreach($data as $key => $value){
                    $qry->where($key,$value);
                }
            }
            return $qry;
        })->first();
    }

    public function getAllWhere($data = []){
        return $this->wallpaper->when($data,function($qry) use($data){
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
        $listing = $this->wallpaper
        ->when($filters,function($qry) use($filters){
            if(isset($filters['status']) && $filters['status'] != ''){
                $qry->where('is_active', $filters['status']);
            }

            if(isset($filters['sub_category']) && $filters['sub_category'] != ''){
                $qry->where(function($search_qry) use($filters){
                    $search_qry->where('wallpaper_category_id', $filters['sub_category']);
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