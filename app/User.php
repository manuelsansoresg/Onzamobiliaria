<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'easy_broker'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static function getAsesor()
    {
        $users = User::select('users.name', 'username', 'users.id', 'roles.name as name_role')
                    ->join('model_has_roles', 'model_has_roles.model_id', '=' , 'users.id')
                    ->join('roles', 'roles.id' , 'model_has_roles.role_id')
                    ->where('roles.name', 'asesor')
                    ->get();

        return $users;
    }
}
