<?php

namespace App\Repositories;

use App\Models\WallpaperCategory;
use App\Models\Wallpaper;

use File, Storage;

class WallpaperCategoryRepository
{
	public $wallpaper_category;

	public function __construct(WallpaperCategory $wallpaper_category)
	{
		$this->wallpaper_category = $wallpaper_category;
	}

    public function getById($id)
    {
        return $this->wallpaper_category->where('id',$id)->first();
    }

    public function getAll()
    {
        return $this->wallpaper_category->get();
    }

    public function getFirstWhere($data = []){
        return $this->wallpaper_category->when($data,function($qry) use($data){
            if(count($data)){
                foreach($data as $key => $value){
                    $qry->where($key,$value);
                }
            }
            return $qry;
        })->first();
    }

    public function getAllWhere($data = []){
        return $this->wallpaper_category->when($data,function($qry) use($data){
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
        $listing = $this->wallpaper_category
        ->when($filters,function($qry) use($filters){
            if(isset($filters['status']) && $filters['status'] != ''){
                $qry->where('is_active', $filters['status']);
            }

            if(isset($filters['category']) && $filters['category'] != ''){
                $qry->where(function($search_qry) use($filters){
                    $search_qry->where('parent_id', $filters['category']);
                });
            }

            if(isset($filters['search']) && $filters['search'] != ''){
                $qry->where(function($search_qry) use($filters){
                    $search_qry->where('category','LIKE','%'.$filters['search'].'%');
                });
            }

            return $qry;
        })->orderBy('id', 'desc');

        if($paginate){
            return $listing->paginate($per_page);
        }
        
        return $listing->get();
    }

    public function atozActressListing($paginate = true, $per_page = 40)
    {
        $listing = $this->wallpaper_category->where('parent_id', 0)->orderBy('category');

        if($paginate){
            return $listing->paginate($per_page);
        }
        
        return $listing->get();
    }    
    
    public function latestWallpaperUploadedActressCategoryListing($paginate = true, $per_page = 20)
    {
        $listing = $this->wallpaper_category
        ->whereNotNull('last_wallpaper_uploaded_at')
        ->groupBy('parent_id')
        ->orderBy('last_wallpaper_uploaded_at', 'DESC');

        if($paginate){
            return $listing->paginate($per_page);
        }
        
        return $listing->get();
    }

    public function popularWallpaperUploadedActressCategoryListing($paginate = true, $per_page = 20)
    {
        $listing = $this->wallpaper_category
        ->where('parent_id', '>', 0)
        ->groupBy('parent_id')
        ->orderBy('views', 'DESC');

        if($paginate){
            return $listing->paginate($per_page);
        }
        
        return $listing->get();
    }

    public function deleteWallpaperCategoryWithWallpaper($wallpaper_category_id)
    {
        $wallpaper_category = $this->wallpaper_category->find($wallpaper_category_id);
        
        if($wallpaper_category->parent_id == 0){
            
            $wallpaper_sub_category = $this->wallpaper_category->where('parent_id', $wallpaper_category_id)->get();
            foreach($wallpaper_sub_category as $sub_category){
                Wallpaper::where('wallpaper_category_id', $sub_category->id)->forceDelete();
                $sub_category->forceDelete();
            }

            $fileDir = config('constants.WALLPAPER_PHOTO') . $wallpaper_category->id;
            if (File::exists(storage_path('app/'.$fileDir))){
                File::deleteDirectory(storage_path('app/'.$fileDir));
            }
        } else {
            $fileDir = config('constants.WALLPAPER_PHOTO') . $wallpaper_category->parent_id . DIRECTORY_SEPARATOR . $wallpaper_category->id;
            if (File::exists(storage_path('app/'.$fileDir))){
                File::deleteDirectory(storage_path('app/'.$fileDir));
            }
            
        }
        
        Wallpaper::where('wallpaper_category_id', $wallpaper_category_id)->forceDelete();
        $wallpaper_category->forceDelete();

        
        return true;
    }
}