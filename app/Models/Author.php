<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public function sermons()
    {
        return $this->hasMany("App\Models\Sermon");
    }

    protected $fillable=[
        "avatar",
        "name",
        "title",
        "biography",
        "ica_pastor",
        "slug"
    ];

    protected $hidden=[
        "created_at",
        "updated_at",
    ];
}
