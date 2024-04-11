<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    use HasFactory;

    public function leader()
    {
        return $this->hasOne(Member::class, "id", "leader_id");
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function getType()
    {
        switch ($this->type){
            case 1:
                return "Pastoral Cell";
            case 2:
                return "Zonal Cell";
            case 3:
                return "114 Community Cell";
            case 4:
                return "Extended Cell";
            default:
                return "Cell";
        }
    }

    public function getParticipants()
    {
        if($this->members()->count() == 1){
            return $this->members()->count() ." Participant";
        }else{
            return $this->members()->count() ." Participants";
        }
    }

    public function meetingsCount()
    {
        if($this->meetings()->count() == 1){
            return $this->meetings()->count() ." Record";
        }else{
            return $this->meetings()->count() ." Records";
        }
    }

    protected $fillable=[
      "code",
      "name",
      "details",
      "location",
      "zone_id",
      "type",
      "leader_id",
      "balance",
    ];
}
