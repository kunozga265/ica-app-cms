<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;
use Psy\Readline\Hoa\FileException;

class EventController extends Controller
{
  
    public function index()
    {
        $unsorted=Event::orderBy('end_date','desc')->paginate((new AppController())->paginate);
        $sorted=[];

        if ($unsorted->count()!==0){
            $currentMonth=date('F',$unsorted[0]->start_date);
            $currentYear=date('Y',$unsorted[0]->start_date);

            $item=0;
            $index=0;


            foreach ($unsorted as $event){

                if ($item==0){
                    $sorted[0]=[
                        'month'         => $currentMonth,
                        'year'          => $currentYear,
                        'events'       => [$event]
                    ];
                }else{
                    $month=date('F',$unsorted[$item]->date);
                    $year=date('Y',$unsorted[$item]->date);

                    if ($currentMonth===$month && $currentYear===$year){
                        $sorted[$index]['events'][]=$event;
                    }else{
                        $index+=1;
                        $currentMonth=date('F',$unsorted[$item]->date);
                        $currentYear=date('Y',$unsorted[$item]->date);

                        $sorted[$index]=[
                            'month'         => $currentMonth,
                            'year'          => $currentYear,
                            'events'        => [$event]
                        ];
                    }
                }
                $item+=1;
            }
        }
        $events_compound=$sorted;
        $events_unsorted=$unsorted;

        return view('pages.events.index',compact("events_compound", "events_unsorted"));
    }


        public function create()
    {
        return view('pages.events.create');
    }

        public function store(Request $request)
    {

        Validator::make($request->all(),[
            "title"         =>  "required",
            "start_date"      =>  "required",
        ])->validate();


        $start_date_unformatted=explode('-',$request->start_date);
        $start_date=Carbon::create($start_date_unformatted[0],$start_date_unformatted[1],$start_date_unformatted[2],0,0,0);
        $end_date=null;

        if(isset($request->end_date)){
            $end_date_unformatted=explode('-',$request->end_date);
            $end_date=Carbon::create($end_date_unformatted[0],$end_date_unformatted[1],$end_date_unformatted[2],0,0,0)->getTimestamp();
            $duration=Carbon::create($end_date_unformatted[0],$end_date_unformatted[1],$end_date_unformatted[2],0,0,0)->addDay()->getTimestamp();
        }else{
            $duration=Carbon::create($start_date_unformatted[0],$start_date_unformatted[1],$start_date_unformatted[2],0,0,0)->addDay()->getTimestamp();
        }
        
        $slug = Str::slug($request->title).date("-Y-m-d");
        $image = null;

        if (isset($request->image)){
            $filename=$slug.".".$request->image->extension();
            try {
                $request->image->move(public_path('images/events'),$filename);
                $image="images/events/$filename";
            }catch (FileException $exception){
                //catch file exception
            }
        }

        $event=Event::create([
            "image"         => $image,
            'title'         => $request->title,
            "slug"          => $slug,
            'duration'      => $duration,
            'end_date'      => $end_date,
            'start_date'    => $start_date->getTimestamp(),
            'venue'         => $request->venue,
            'time'          => $request->time,
            'body'          => Purifier::clean($request->body),
        ]);

        return Redirect::route('events.show',['id'=>$event->slug])->with('success','Event created!');
    }

        public function show($slug)
    {
        $event = event::where("slug", $slug)->first();
        if (!is_object($event))
            return Redirect::back()->with('error','Event not found');
        else {
            return view('pages.events.show',compact('event'));
        }
    }

        public function edit($slug)
    {
        $event = event::where("slug", $slug)->first();
        if (!is_object($event))
            return Redirect::back()->with('error','Event not found');
        else {
            return view('pages.events.edit',compact('event'));
        }
    }

        public function update(Request $request,$slug)
    {
        $event = event::where("slug", $slug)->first();
        if (!is_object($event))
            return Redirect::back()->with('error','event not found');
        else {
            //update

            Validator::make($request->all(),[
                "title"         =>  "required",
                "start_date"      =>  "required",
            ])->validate();

            $start_date_unformatted=explode('-',$request->start_date);
            $start_date=Carbon::create($start_date_unformatted[0],$start_date_unformatted[1],$start_date_unformatted[2],0,0,0);
            $end_date=null;

            if(isset($request->end_date)){
                $end_date_unformatted=explode('-',$request->end_date);
                $end_date=Carbon::create($end_date_unformatted[0],$end_date_unformatted[1],$end_date_unformatted[2],0,0,0)->getTimestamp();
                $duration=Carbon::create($end_date_unformatted[0],$end_date_unformatted[1],$end_date_unformatted[2],0,0,0)->addDay()->getTimestamp();
            }else{
                $duration=Carbon::create($start_date_unformatted[0],$start_date_unformatted[1],$start_date_unformatted[2],0,0,0)->addDay()->getTimestamp();
            }

            $slug = Str::slug($request->title).date("-Y-m-d");
            
            $event->update([
                'title'         => $request->title,
                "slug"          => $slug,
                'duration'      => $duration,
                'end_date'      => $end_date,
                'start_date'    => $start_date->getTimestamp(),
                'venue'         => $request->venue,
                'time'          => $request->time,
                'body'          => Purifier::clean($request->body),
            ]);

            if(isset($request->image)){
                if(file_exists($event->image)){
                    Storage::disk("public_uploads")->delete($event->image);
                }

                $filename=$slug.".".$request->image->extension();
                try {
                    $request->image->move(public_path('images/events'),$filename);
                    $event->update([
                        "image" => "images/events/$filename"
                    ]);
                }catch (FileException $exception){
                    //catch file exception
                }
            }

            return Redirect::route('events.show',$slug)->with('success','Event updated!');
        }
    }

        public function trash($slug)
    {
        $event = event::where("slug", $slug)->first();
        if (!is_object($event))
            return Redirect::back()->with('error','Event not found');
        else {
            $event->delete();
            return Redirect::route('events.index')->with('success','Event deleted!');
        }
    }
    
}
