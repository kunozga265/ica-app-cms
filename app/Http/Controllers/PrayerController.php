<?php

namespace App\Http\Controllers;

use App\Http\Resources\PrayerCollection;
use App\Models\Prayer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class PrayerController extends Controller
{
    public function index()
    {
        $now=Carbon::now()->getTimestamp();
        $prayers=Prayer::where('date','<=',$now)->paginate(5);

        return response()->json(new PrayerCollection($prayers));
    }

    public function store(Request $request)
    {

        $validator=Validator::make($request->all(),[
            "title"         =>  "required",
            "date"          =>  "required",
            "body"          =>  "required"
        ]);

        if ($validator->fails()){
            return response()->json(["message"=>"Title, Date and body attributes required."],400);
        }

        $points="";
        foreach ($request->body as $point){
            $points.="<li>$point</li>";
        }

        $date=Carbon::create($request->date["year"],$request->date["month"],$request->date["day"])->getTimestamp();

        $prayer=Prayer::create([
            'title'     => $request->title,
            'date'      => $date,
            'verses'    => $request->verses,
            'body'      => "<ol>$points</ol>"
        ]);

        return response()->json($prayer);
    }
}
