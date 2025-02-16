<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_role','user_id','role_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function fullName()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function cell()
    {
        return $this->hasOne(Cell::class);
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "avatar",
        "first_name",
        "middle_name",
        "other_name",
        "last_name",
        "member_id",
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
