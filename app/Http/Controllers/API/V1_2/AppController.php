<?php

namespace App\Http\Controllers\API\V1_2;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Cell;
use App\Models\Event;
use App\Models\Page;
use App\Models\Prayer;
use App\Models\Series;
use App\Models\Sermon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources;

class AppController extends Controller
{

    public $paginate=20;


    public function dashboard(Request $request, $timestamp)
    {
        if(!isset($timestamp)){
            return response()->json([
                "message" => "Timestamp is required."
            ],400);
        }

        $next_meeting_date = null;
        if($request->query("code") !== null){
            $cell = Cell::where("code",$request->query("code"))->first();
            if(is_object($cell)){
                $next_meeting_date = $cell->nextMeetingDate();
            }
        }

        //get prayer points
//        $now=Carbon::now()->getTimestamp(collection);
        if($timestamp == 0){
            $now=Carbon::now()->getTimestamp();
            $prayers=Prayer::where('date','<=',$now)->orderBy('date','desc')->limit((new \App\Http\Controllers\API\V1_1\AppController())->paginate)->get();
            $sermons= Sermon::orderBy("published_at","desc")->limit((new AppController())->paginate)->get();
            $series= Series::where("first_sermon_date","!=",null)->orderBy("first_sermon_date","desc")->limit((new AppController())->paginate)->get();
            $events= Event::orderBy("start_date","desc")->limit((new AppController())->paginate)->get();
            $authors= Author::all();
        }
        else{
            $prayers = Prayer::where('date', '>', $timestamp)->orWhere('updated_at', '>', Carbon::createFromTimestamp($timestamp))->orderBy('date', 'desc')->limit((new AppController())->paginate)->get();
            $sermons = Sermon::where('published_at', '>', $timestamp)->orWhere('updated_at', '>', Carbon::createFromTimestamp($timestamp))->orderBy("published_at", "desc")->limit((new AppController())->paginate)->get();
            $series = Series::where('updated_at', '>', Carbon::createFromTimestamp($timestamp))->where("first_sermon_date", "!=", null)->orderBy("first_sermon_date", "desc")->limit((new AppController())->paginate)->get();
            $events = Event::where('start_date', '>', $timestamp)->orWhere('updated_at', '>', Carbon::createFromTimestamp($timestamp))->orderBy("start_date", "desc")->limit((new AppController())->paginate)->get();
            $authors = Author::where('updated_at', '>', Carbon::createFromTimestamp($timestamp))->get();
        }

        $announcements = Page::where("name","announcements")->first();
        $fundraising = Page::where("name","fundraising")->first();

        return response()->json([
            'sermons'   => Resources\V1_2\SermonResource::collection($sermons),
            'series'    => Resources\SeriesResource::collection($series),
            'authors'   => Resources\AuthorResource::collection($authors),
            'prayer_points'   => Resources\PrayerResource::collection($prayers),
            'events'    => Resources\EventResource::collection($events),
            'announcements'    => new Resources\PageResource($announcements),
            'fundraising'    => new Resources\PageResource($fundraising),
            'next_meeting_date'    => $next_meeting_date,

        ]);
    }
}
