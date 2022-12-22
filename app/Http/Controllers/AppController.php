<?php

namespace App\Http\Controllers;

use App\Models\Sermon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources;

class AppController extends Controller
{
    public function dashboard()
    {
        $sermons = Sermon::orderBy("published_at","desc")->limit(5)->get();
        return response()->json(Resources\SermonResource::collection($sermons),200);
    }
}
