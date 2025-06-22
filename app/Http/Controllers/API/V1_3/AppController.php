<?php

namespace App\Http\Controllers\API\V1_3;

use App\Http\Controllers\Controller;
use App\Http\Resources\HighlightResource;
use App\Http\Resources\V1_3\BookmarkResource;
use App\Http\Resources\NoteResource;
use App\Models\Author;
use App\Models\Bookmark;
use App\Models\Cell;
use App\Models\Event;
use App\Models\Highlight;
use App\Models\Note;
use App\Models\Page;
use App\Models\Prayer;
use App\Models\Series;
use App\Models\Sermon;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources;
use Illuminate\Support\Facades\Auth;

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

    public function authData(Request $request)
    {
        $user = User::find(Auth::id());
        return response()->json([
             "highlights" => HighlightResource::collection($user->highlights),
            "bookmarks" => BookmarkResource::collection($user->bookmarks),
            "notes" => NoteResource::collection($user->notes),
        ]);

    }

    public function syncData(Request $request)
    {
        $request->validate([

        ]);


        //highlights
        foreach ($request->highlights["latest"] as $highlight){
            if(!Highlight::where("sermon_id",$highlight["sermonId"])->where("highlight_id", $highlight["highlightId"])->exists()){
                Highlight::create([
                    "sermon_id" => $highlight["sermonId"],
                    "highlight_id" => $highlight["highlightId"],
                    "date" => $highlight["date"],
                    "user_id" => Auth::id(),
                ]);
            }
        }

        foreach ($request->highlights["trashed"] as $highlight){
            $highlight = Highlight::where("sermon_id",$highlight["sermonId"])->where("highlight_id", $highlight["highlightId"])->first();
            if(is_object($highlight)){
                $highlight->delete();
            }
        }

        //bookmarks
        foreach ($request->bookmarks as $bookmark){
            Bookmark::create([
                "sermon_id" => $bookmark["sermonId"],
                "caption" => $bookmark["caption"],
                "caption_id" => $bookmark["captionId"],
                "date" => $bookmark["date"],
                "comment" => $bookmark["comment"],
                "user_id" => Auth::id(),
            ]);
        }

        //notes
        foreach ($request->notes as $note){
            Note::create([
                "sermon_id" => $note["sermonId"],
                "body" => $note["body"],
                "date" => $note["date"],
                "user_id" => Auth::id(),
            ]);
        }

        return response()->json(["message"=>"Successfully synced data"]);
    }
}
