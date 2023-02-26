<?php

namespace App\Http\Controllers\API\V1_0_0;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Prayer;
use App\Models\Series;
use App\Models\Sermon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources;

class AppController extends Controller
{
    public $paginate=20;

    public function dashboard()
    {
        //get sermons
        $sermons = Sermon::orderBy("published_at","desc")->limit(5)->get();

        //get prayer points
        $now=Carbon::now()->getTimestamp();
        $prayer=Prayer::where('date','<=',$now)->orderBy('date','desc')->first();

        return response()->json([
            'sermons'   => Resources\SermonResource::collection($sermons),
            'prayer'    => $prayer
        ]);
    }

    public function seeder(Request $request)
    {
        foreach ($request->sermons as $sermon){
            Sermon::create([
                "title"         =>  $sermon->title,
                "slug"          =>  $sermon->slug,
                "subtitle"      =>  $sermon->subtitle,
                "video_url"     =>  $sermon->video_url,
                "body"          =>  $sermon->body,
                "author_id"     =>  $sermon->author["id"],
                "series_id"     =>  $sermon->series["id"],
                "published_at"  =>  $sermon->published_at
            ]);
        }

        foreach ($request->series as $series) {
            Series::create([
                "title"             =>  $series->title,
                "slug"              =>  $series->slug,
                "description"       =>  $series->description,
            ]);
        }

        foreach ($request->authors as $author) {
            Author::create([
                "avatar"        =>  $author->avatar,
                "name"          =>  $author->name,
                "suffix"        =>  $author->suffix,
                "slug"          =>  $author->slug,
                "title"         =>  $author->title,
                "biography"     =>  $author->biography,
                "ica_pastor"    =>  $author->ica_pastor,
            ]);
        }
        foreach ($request->prayers as $prayer) {
            Prayer::create([
                'title'     => $prayer->title,
                'date'      => $prayer->date,
                'verses'    => $prayer->verses,
                'body'      => $prayer->body
            ]);
        }

        dd("DB Seeded");
    }

}
