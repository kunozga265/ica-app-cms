<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Register extends Model
{
    use HasFactory;

    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_register', 'register_id', 'member_id');
    }

    public function ministry()
    {
        return $this->belongsTo(Ministry::class);
    }


    public function isAuthRegistered()
    {
        $user = User::find(Auth::id());
        if (is_object($user) && $user?->member != null) {
            return $this->members()->where('member_id', $user->member?->id)->exists();
        } else {
            return false;
        }
    }



    protected $fillable = [
        "code",
        "name",
        "ministry_id",
        "date",
    ];
}
