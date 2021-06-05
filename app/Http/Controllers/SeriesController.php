<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;
use Validator;

class SeriesController extends Controller
{
    public function search($query){
        $series=Series::search($query)->limit(2)->get();
        return response()->json([
            "series" => Resources\SeriesSearchResource::collection($series)
        ],200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $series= Series::where("first_sermon_date","!=",null)->orderBy("first_sermon_date","desc")->paginate(2);
        return response()->json(new Resources\SeriesCollection($series),200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function options()
    {
        $series= Series::orderBy("title","asc")->get();
        return response()->json(Resources\SeriesOptionsResource::collection($series),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            "title"     =>  "required",
        ]);

        if ($validator->fails()){
            return response()->json(["message"=>"Title attribute required"],400);
        }

        $series=new Series([
            "title"             =>  $request->title,
            "slug"              =>  Str::slug($request->title).date("-Y-m-d"),
            "description"       =>  Purifier::clean($request->description),
            "theme_id"          =>  $request->theme_id,
            "first_sermon_date" =>  $request->first_sermon_date,
        ]);

        $series->save();

        return response()->json(["series"=>new Resources\SeriesResource($series)],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($slug)
    {
        $series = Series::where('slug','=',$slug)->first();

        if (!is_object($series))
            return response()->json(["response"=>false],204);
        else {
            $sermons=$series->sermons()->orderBy("published_at","desc")->get();
            return response()->json([
                "series" => new Resources\SeriesResource($series),
                "sermons"=>Resources\SermonResource::collection($sermons)
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $slug)
    {
        $series = Series::where('slug','=',$slug)->first();
        if (!is_object($series))
            return response()->json(["response"=>false],204);
        else {
            $series->update([
                "title"         =>  $request->title,
                "slug"          =>  Str::slug($request->title).date("-Y-m-d"),
                "description"   =>  Purifier::clean($request->description),
                "theme_id"      =>  $request->theme_id,
                "first_sermon_date" =>  $request->first_sermon_date,
            ]);
            return response()->json(["series"=>new Resources\SeriesResource($series)],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($slug)
    {
        $series = Series::where('slug','=',$slug)->first();
        if (!is_object($series))
            return response()->json(["response"=>false],204);
        else {
            $series->delete();
            return response()->json(["response" => true], 200);
        }
    }
}
