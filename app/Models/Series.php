<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Series extends Model
{
    use HasFactory;
    use Searchable;

    public function sermons()
    {
        return $this->hasMany("App\Models\Sermon");
    }

    public function theme()
    {
        return$this->belongsTo("App\Models\Theme");
    }

    public function searchableAs(){
      return "series_index";
    }

    protected $fillable=[
        "title",
        "description",
        "slug",
        "theme_id",
        "first_sermon_date",
    ];

    protected $hidden=[
        "created_at",
        "updated_at",
    ];
}
