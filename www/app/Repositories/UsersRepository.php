<?php

namespace App\Repositories;

use App\User;

class UsersRepository
{
	public $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

    public function getById($id)
    {
        return $this->user->where('id',$id)->first();
    }

    public function getAll()
    {
        return $this->user->get();
    }

    public function getByRoleCode($role_code, $user_id = null)
    {
        $listing = $this->user
        ->whereHas('role', function($role_qry) use($role_code){
            $role_qry->where('role_code', $role_code);
        });
        if($user_id){
            $listing->where('id', '!=', $user_id);
        }
        return $listing->get();
    }

    public function getFirstWhere($data = []){
        return $this->user->when($data,function($qry) use($data){
            if(count($data)){
                foreach($data as $key => $value){
                    $qry->where($key,$value);
                }
            }
            return $qry;
        })->first();
    }

    public function getAllWhere($data = []){
        return $this->user->when($data,function($qry) use($data){
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
        $listing = $this->user->with(['role'])
        ->when($filters,function($qry) use($filters){
            if(isset($filters['status']) && $filters['status'] != ''){
                $qry->where('is_active', $filters['status']);
            }

            if(isset($filters['role']) && $filters['role'] != ''){
                $qry->whereHas('role', function ($role_qry) use($filters){
                    $role_qry->where('id', $filters['role']);
                });
            }

            if(isset($filters['search']) && $filters['search'] != ''){
                $qry->where(function($search_qry) use($filters){
                    $search_qry->where('username','LIKE','%'.$filters['search'].'%')
                        ->orWhere('email','LIKE','%'.$filters['search'].'%')
                        ->orWhere('name','LIKE','%'.$filters['search'].'%')
                        ->orWhere('mobile','LIKE','%'.$filters['search'].'%');
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
