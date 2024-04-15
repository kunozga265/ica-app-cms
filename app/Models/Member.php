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

    public function cell()
    {
        return $this->belongsTo(Cell::class);
    }

    public function leadershipCell()
    {
        return $this->hasOne(Cell::class,"leader_id","id");
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function attendanceCount()
    {
        if($this->attendances()->count() == 1){
            return $this->attendances()->count() ." Meeting";
        }else{
            return $this->attendances()->count() ." Meetings";
        }
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
