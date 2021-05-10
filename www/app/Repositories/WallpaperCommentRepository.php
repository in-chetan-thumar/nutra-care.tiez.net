<?php

namespace App\Repositories;

use App\Models\WallpaperComment;

class WallpaperCommentRepository
{
	public $wallpaper_comment;

	public function __construct(WallpaperComment $wallpaper_comment)
	{
		$this->wallpaper_comment = $wallpaper_comment;
	}

    public function getById($id)
    {
        return $this->wallpaper_comment->where('id',$id)->first();
    }

    public function getAll()
    {
        return $this->wallpaper_comment->get();
    }

    public function getFirstWhere($data = []){
        return $this->wallpaper_comment->when($data,function($qry) use($data){
            if(count($data)){
                foreach($data as $key => $value){
                    $qry->where($key,$value);
                }
            }
            return $qry;
        })->first();
    }

    public function getAllWhere($data = []){
        return $this->wallpaper_comment->when($data,function($qry) use($data){
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
        $listing = $this->wallpaper_comment
        ->when($filters,function($qry) use($filters){
            if(isset($filters['status']) && $filters['status'] != ''){
                $qry->where('is_active', $filters['status']);
            }

            if(isset($filters['wallpaper_id']) && $filters['wallpaper_id'] != ''){
                $qry->where(function($search_qry) use($filters){
                    $search_qry->where('wallpaper_id', $filters['wallpaper_id']);
                });
            }
			
			if(isset($filters['parent_comment_id']) && $filters['parent_comment_id'] != ''){
                $qry->where(function($search_qry) use($filters){
                    $search_qry->where('parent_comment_id', $filters['parent_comment_id']);
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