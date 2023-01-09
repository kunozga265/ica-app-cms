<?php

namespace App\Http\Controllers;

use App\Models\Prayer;
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
        return response()->json(Resources\SermonResource::collection($sermons),200);
    }
    public function dashboard_1_0_0()
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
}
