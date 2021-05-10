<?php

namespace App\Repositories;


use App\Models\ContactUs;

class ContactRepository
{
	public $contact;

	public function __construct(ContactUs $contact)
	{
		$this->contact = $contact;
	}

    public function getById($id)
    {
        return $this->contact->where('id',$id)->first();
    }

    public function getAll()
    {
        return $this->contact->get();
    }


    public function getListing($paginate = true, $per_page = null)
    {
        $listing = $this->contact->orderBy('id', 'desc');

        if($paginate){
            return $listing->paginate($per_page);
        }

        return $listing->get();
    }
}
