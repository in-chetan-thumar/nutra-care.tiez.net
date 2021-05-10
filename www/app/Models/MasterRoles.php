<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MasterRoles extends Model
{
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
    protected $table = 'master_roles';
    
    /**
	* to maintain relationship with Users table.
	*/
	public function users()
    {
        return $this->hasMany('App\Users','role_id','id');
    }
}
