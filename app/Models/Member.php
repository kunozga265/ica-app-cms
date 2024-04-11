<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    public function ministries()
    {
        return $this->belongsToMany(Ministry::class, "member_ministry");
    }

    public function fullName()
    {
        return $this->first_name . " " . $this->last_name;
    }

    protected $fillable = [
        "code",
        "avatar",
        "first_name",
        "middle_name",
        "last_name",
        "gender",
        "cell_id",
        "date_of_birth",
        "phone_number",
        "email",
    ];

}
