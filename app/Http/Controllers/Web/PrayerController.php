<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\PrayerCollection;
use App\Models\Prayer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Mews\Purifier\Facades\Purifier;

class PrayerController extends Controller
{

    public function index()
    {
        $unsorted=Prayer::orderBy('date','desc')->paginate((new AppController())->paginate);
        $sorted=[];

        if ($unsorted->count()!==0){
            $currentMonth=date('F',$unsorted[0]->date);
            $currentYear=date('Y',$unsorted[0]->date);

            $item=0;
            $index=0;


            foreach ($unsorted as $sermon){

                if ($item==0){
                    $sorted[0]=[
                        'month'         => $currentMonth,
                        'year'          => $currentYear,
                        'points'       => [$sermon]
                    ];
                }else{
                    $month=date('F',$unsorted[$item]->date);
                    $year=date('Y',$unsorted[$item]->date);

                    if ($currentMonth===$month && $currentYear===$year){
                        $sorted[$index]['points'][]=$sermon;
                    }else{
                        $index+=1;
                        $currentMonth=date('F',$unsorted[$item]->date);
                        $currentYear=date('Y',$unsorted[$item]->date);

                        $sorted[$index]=[
                            'month'         => $currentMonth,
                            'year'          => $currentYear,
                            'points'        => [$sermon]
                        ];
                    }
                }
                $item+=1;
            }
        }
        $prayers_compound=$sorted;

        return view('pages.prayers.index',compact("prayers_compound"));
    }


    public function create()
    {
        return view('pages.prayers.create');
    }

    public function store(Request $request)
    {

        Validator::make($request->all(),[
            "title"         =>  "required",
            "date"          =>  "required",
            "body"          =>  "required"
        ])->validate();

        $date=explode('-',$request->date);

        $prayer=Prayer::create([
            'title'     => $request->title,
            'date'      => Carbon::create($date[0],$date[1],$date[2],0,0,0)->getTimestamp(),
            'verses'    => $request->verses,
            'body'      => Purifier::clean($request->body),
        ]);

        return Redirect::route('prayers.show',['id'=>$prayer->id])->with('success','Prayer Points created!');
    }

    public function show($id)
    {
        $prayer = Prayer::find($id);
        if (!is_object($prayer))
            return Redirect::back()->with('error','Prayer points not found');
        else {
            return view('pages.prayers.show',compact('prayer'));
        }
    }

    public function edit($id)
    {
        $prayer = Prayer::find($id);
        if (!is_object($prayer))
            return Redirect::back()->with('error','Prayer points not found');
        else {
            return view('pages.prayers.edit',compact('prayer'));
        }
    }

    public function update(Request $request,$id)
    {
        $prayer = Prayer::find($id);
        if (!is_object($prayer))
            return Redirect::back()->with('error','Prayer points not found');
        else {
            //update

            Validator::make($request->all(),[
                "title"         =>  "required",
                "date"          =>  "required",
                "body"          =>  "required"
            ])->validate();

            $date=explode('-',$request->date);

            $prayer->update([
                'title'     => $request->title,
                'date'      => Carbon::create($date[0],$date[1],$date[2],0,0,0)->getTimestamp(),
                'verses'    => $request->verses,
                'body'      => Purifier::clean($request->body),
            ]);

            return Redirect::route('prayers.show',$id)->with('success','Prayer Points updated!');
        }
    }

    public function trash($id)
    {
        $prayer = Prayer::find($id);
        if (!is_object($prayer))
            return Redirect::back()->with('error','Prayer points not found');
        else {
            $prayer->delete();
            return Redirect::route('prayers.index')->with('success','Prayer Points deleted!');
        }
    }
}
