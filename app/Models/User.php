<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Models\Ticket;
use App\Models\Invitation;

/**
 * Class User
 * @package App\Models
 */
class User extends BaseModel implements SluggableInterface,AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    use SluggableTrait;


    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
        'unique'     => true,
    ];
    /**
     * The rules used for validation
     *
     * @var array
     */
    protected static $rules = [
        'name' => 'required',
        'email' => array(
            'required',
            'max:50',
            'email',
            'unique:users'
        ),
        'password' => 'required'

    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','gender','date_of_birth','image_url','department_id', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relations
    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id');
    }

    public function createdTickets()
    {
        return $this->hasMany( Ticket::class, 'creator_id' );
    }

    public function tickets()
    {
        return $this->hasMany( Ticket::class, 'assigned_to' );
    }

    public function invitations()
    {
        return $this->hasMany( Invitation::class, 'invited_id' );
    }

    public function sentInvitations()
    {
        return $this->hasMany( Invitation::class, 'inviter_id' );
    }
}
