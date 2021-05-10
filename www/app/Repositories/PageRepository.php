<?php

namespace App\Repositories;

use App\Models\Page;

class PageRepository
{
	public $page;

	public function __construct(Page $page)
	{
		$this->page = $page;
	}

    public function getById($id)
    {
        return $this->page->where('id',$id)->first();
    }

    public function getAll()
    {
        return $this->page->get();
    }


    public function getListing($paginate = true, $per_page = null)
    {
        $listing = $this->page->orderBy('id', 'desc');

        if($paginate){
            return $listing->paginate($per_page);
        }

        return $listing->get();
    }
}
