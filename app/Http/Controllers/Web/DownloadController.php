<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Download;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;
use Psy\Readline\Hoa\FileException;

class DownloadController extends Controller
{

    public function index()
    {
        $unsorted = Download::orderBy('date', 'desc')->paginate((new AppController())->paginate);
        $sorted = [];

        if ($unsorted->count() !== 0) {
            $currentMonth = date('F', $unsorted[0]->start_date);
            $currentYear = date('Y', $unsorted[0]->start_date);

            $item = 0;
            $index = 0;


            foreach ($unsorted as $object) {

                if ($item == 0) {
                    $sorted[0] = [
                        'month' => $currentMonth,
                        'year' => $currentYear,
                        'downloads' => [$object]
                    ];
                } else {
                    $month = date('F', $unsorted[$item]->date);
                    $year = date('Y', $unsorted[$item]->date);

                    if ($currentMonth === $month && $currentYear === $year) {
                        $sorted[$index]['downloads'][] = $object;
                    } else {
                        $index += 1;
                        $currentMonth = date('F', $unsorted[$item]->date);
                        $currentYear = date('Y', $unsorted[$item]->date);

                        $sorted[$index] = [
                            'month' => $currentMonth,
                            'year' => $currentYear,
                            'downloads' => [$object]
                        ];
                    }
                }
                $item += 1;
            }
        }
        $downloads_compound = $sorted;
        $events_unsorted = $unsorted;

        return view('pages.downloads.index', compact("downloads_compound", "events_unsorted"));
    }


    public function create()
    {
        return view('pages.downloads.create');
    }

    public function store(Request $request)
    {

        Validator::make($request->all(), [
            "title" => "required",
            "type" => "required",
            "date" => "required",
            "path" => "required",
        ])->validate();

        $slug = Str::slug($request->title) . date("-Y-m-d");
        $date=explode('-',$request->date);

        $download = Download::create([
            'title' => $request->title,
            'type' => $request->type,
            'path' => $request->path,
            "slug" => $slug,
            "date" => Carbon::create($date[0],$date[1],$date[2],0,0,0)->getTimestamp(),
            "description" => $request->description,

        ]);

        return Redirect::route('downloads.index')->with('success', 'Downloadable resource created!');
    }

    public function show($slug)
    {
        $download = Download::where("slug", $slug)->first();
        if (!is_object($download))
            return Redirect::back()->with('error', 'Downloadable Resource not found');
        else {
            return view('pages.downloads.show', compact('download'));
        }
    }

    public function edit($slug)
    {
        $download = Download::where("slug", $slug)->first();
        if (!is_object($download))
            return Redirect::back()->with('error', 'Downloadable Resource not found');
        else {
            return view('pages.downloads.edit', compact('download'));
        }
    }

    public function update(Request $request, $slug)
    {
        $download = Download::where("slug", $slug)->first();
        if (!is_object($download))
            return Redirect::back()->with('error', 'Downloadable resource not found');
        else {
            //update

            Validator::make($request->all(), [
                "title" => "required",
                "type" => "required",
                "date" => "required",
                "path" => "required",
            ])->validate();

            $date=explode('-',$request->date);
            $slug = Str::slug($request->title) . date("-Y-m-d");

            $download->update([
                'title' => $request->title,
                'type' => $request->type,
                'path' => $request->path,
                "slug" => $slug,
                "date" => Carbon::create($date[0],$date[1],$date[2],0,0,0)->getTimestamp(),
                "description" => $request->description,
            ]);

            return Redirect::route('downloads.index')->with('success', 'Downloadable resource updated!');
        }
    }

    public function trash($slug)
    {
        $download = Download::where("slug", $slug)->first();
        if (!is_object($download))
            return Redirect::back()->with('error', 'Downloadable resource not found');
        else {
            $download->delete();
            return Redirect::route('downloads.index')->with('success', 'Downloadable resource deleted!');
        }
    }

}
