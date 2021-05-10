<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Session;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * to maintain relationship with Roles table.
     */
    public function role()
    {
        return $this->belongsTo('App\Models\MasterRoles', 'role_id', 'id');
    }

    public function isAdmin()
    {
        return ($this->role->role_code == config('constants.ROLES.ADMIN')) ? true : false;
    }

    /**
     * [role_code description]
     * @return [type] [description]
     */
    public function role_code()
    {

        if (Session::has('role')) {
            $user_role = Session::get('role');
        } else {
            $user_role = $this->role;
        }

        return $user_role->role_code;
    }

    /**
     * [hasAnyRole description]
     * @param  [type]  $roles [description]
     * @return boolean        [description]
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    /**
     * [hasRole description]
     * @param  [type]  $role [description]
     * @return boolean       [description]
     */
    public function hasRole($role)
    {

        if (Session::has('role')) {
            $user_role = Session::get('role');
        } else {
            $user_role = $this->role;
        }

        return $user_role->role_code == $role;
    }
}
