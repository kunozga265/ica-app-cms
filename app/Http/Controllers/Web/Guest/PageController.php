<?php

namespace App\Http\Controllers\Web\Guest;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\AppController;
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
    public function sermons()
    {
        $unsorted = Sermon::orderBy("published_at", "desc")->paginate((new AppController())->paginate);
        $sorted = [];

        if ($unsorted->count() !== 0) {
            $currentMonth = date('F', $unsorted[0]->published_at);
            $currentYear = date('Y', $unsorted[0]->published_at);

            $item = 0;
            $index = 0;


            foreach ($unsorted as $sermon) {

                if ($item == 0) {
                    $sorted[0] = [
                        'month' => $currentMonth,
                        'year' => $currentYear,
                        'sermons' => [$sermon]
                    ];
                } else {
                    $month = date('F', $unsorted[$item]->published_at);
                    $year = date('Y', $unsorted[$item]->published_at);

                    if ($currentMonth === $month && $currentYear === $year) {
                        $sorted[$index]['sermons'][] = $sermon;
                    } else {
                        $index += 1;
                        $currentMonth = date('F', $unsorted[$item]->published_at);
                        $currentYear = date('Y', $unsorted[$item]->published_at);

                        $sorted[$index] = [
                            'month' => $currentMonth,
                            'year' => $currentYear,
                            'sermons' => [$sermon]
                        ];
                    }
                }
                $item += 1;
            }
        }
        $sermons_compound = $sorted;
        $sermons_unsorted = $unsorted;

        return view("guest.sermons", compact("sermons_compound"));
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
