<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Relation to the contacts table with foreign-key of owner_id and relate to
    // owner_id attribute/collumn on contacts table
    // --- it means to find contact/user that owned by the current user
    public function contacts(){
        return $this->hasMany(Contact::class, 'owner_id', 'id');
    }
   
    // Relation to the contacts table with foreign-key of user_id and relate to
    // user_id attribute/collumn on contacts table
    // --- it means to find user identity of the contact
    public function ownedBy(){
        return $this->hasMany(Contact::class, 'user_id', 'id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
