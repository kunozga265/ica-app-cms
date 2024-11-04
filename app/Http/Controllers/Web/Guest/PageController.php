<?php

namespace App\Http\Controllers\Web\Guest;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Sermon;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class PageController extends Controller
{

    public function home()
    {
        $now = Carbon::now();
        $sermons = Sermon::where("published_at", "<=", $now->getTimestamp())->orderBy("published_at", "desc")->limit(10)->get();
        return view("guest.home", compact("sermons"));
    }

    public function sermon($slug)
    {
        $sermon = Sermon::where('slug', '=', $slug)->first();
        if (!is_object($sermon))
            return Redirect::back()->with('error', 'Sermon not found');
        else {
            //update view
            $view = View::where("sermon_id", $sermon->id)->first();
            $view->update([
                "count" => ($view->count) + 1
            ]);

            if ($sermon->series_id != null)
                $sermonSeries = Sermon::where("series_id", "=", $sermon->series_id)->where("id", "!=", $sermon->id)->orderBy("published_at", "desc")->get();
            else
                $sermonSeries = [];

            $now = Carbon::now();
            $prev = Sermon::where("published_at", "<=", $now->getTimestamp())->where("published_at", "<", $sermon->published_at)->orderBy("published_at", "desc")->first();
            $next = Sermon::where("published_at", "<=", $now->getTimestamp())->where("published_at", ">", $sermon->published_at)->orderBy("published_at", "asc")->first();

            return view('guest.sermon', compact('sermon', 'sermonSeries','next','prev'));

        }
    }


}
