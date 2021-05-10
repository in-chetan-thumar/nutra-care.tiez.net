<?php

namespace App\Repositories;

use App\Models\Notification;

class NotificationRepository
{
	public $notification;

	public function __construct(Notification $notification)
	{
		$this->notification = $notification;
	}

    public function getById($id)
    {
        return $this->notification->where('id',$id)->first();
    }

    public function getAll()
    {
        return $this->notification->get();
    }

    public function getFirstWhere($data = []){
        return $this->notification->when($data,function($qry) use($data){
            if(count($data)){
                foreach($data as $key => $value){
                    $qry->where($key,$value);
                }
            }
            return $qry;
        })->first();
    }

    public function getAllWhere($data = []){
        return $this->notification->when($data,function($qry) use($data){
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
        $listing = $this->notification
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