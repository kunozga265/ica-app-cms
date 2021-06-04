<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Sermon extends Model
{
    use HasFactory;
    use Searchable;

    public function author()
    {
        return $this->belongsTo("App\Models\Author");
    }
    public function series()
    {
        return $this->belongsTo("App\Models\Series");
    }

    public function category()
    {
        return $this->belongsTo("App\Models\Category");
    }

    public function searchableAs(){
      return "sermons_index";
    }

    protected $fillable=[
        "title",
        "slug",
        "subtitle",
        "body",
        "author_id",
        "series_id",
        "category_id",
        "published_at",
    ];
}
