<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cell;
use App\Models\Member;
use App\Models\Zone;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class CellController extends Controller
{
    public function index()
    {
        $cells = Cell::orderBy('name', 'asc')->get();
        return view('pages.cells.index', compact("cells"));
    }


    public function create()
    {
        $zones = Zone::orderBy("name", "asc")->get();
        $members = Member::orderBy("last_name", "asc")->get();
        return view('pages.cells.create', compact("zones", "members"));
    }

    public function store(\Illuminate\Http\Request $request)
    {

        Validator::make($request->all(), [
            "name" => "required",
            "zone_id" => "required",
            "balance" => "required",
            "type" => "required",
        ])->validate();

        $cell = Cell::create([
            'name' => $request->name,
            'details' => $request->details,
            'location' => $request->location,
            'zone_id' => $request->zone_id,
            'balance' => $request->balance,
            'type' => $request->type,
            'leader_id' => $request->leader_id != "None" && $request->leader_id != "0" ? $request->leader_id : null,
        ]);

        return Redirect::route('cells.index', ['id' => $cell->id])->with('success', 'Cell created!');
    }

    public function show($id)
    {
        $cell = Cell::find($id);
        if (!is_object($cell))
            return Redirect::back()->with('error', 'Cell not found');
        else {
            $members = Member::orderBy("last_name","asc")->get();
            return view('pages.cells.show', compact('cell', 'members'));
        }
    }

    public function edit($id)
    {
        $cell = Cell::find($id);
        if (!is_object($cell))
            return Redirect::back()->with('error', 'Cell not found');
        else {
            return view('pages.cells.edit', compact('cell'));
        }
    }

    public function update(Request $request, $id)
    {
        $cell = Cell::find($id);
        if (!is_object($cell))
            return Redirect::back()->with('error', 'Cell not found');
        else {
            //update

            Validator::make($request->all(), [
                "first_name" => "required",
                "last_name" => "required",
                "gender" => "required",
            ])->validate();

            $cell->update([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'other_name' => $request->other_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
//            'cell_id' => $request->cell_id,
//                'ministry_id' => $request->ministry_id,
            ]);

            return Redirect::route('cells.show', $id)->with('success', 'Cell updated!');
        }
    }

    public function trash($id)
    {
        $cell = Cell::find($id);
        if (!is_object($cell))
            return Redirect::back()->with('error', 'Cell not found');
        else {
            $cell->delete();
            return Redirect::route('cells.index')->with('success', 'Cell deleted!');
        }
    }
}
