<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Ministry;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::orderBy('last_name', 'asc')->paginate((new AppController())->paginate);

        return view('pages.events.index', compact("members"));
    }


    public function create()
    {
        $ministries = Ministry::orderBy("name", "asc")->get();
        return view('pages.members.create', compact("ministries"));
    }

    public function store(\Illuminate\Http\Request $request)
    {

        Validator::make($request->all(), [
            "first_name" => "required",
            "last_name" => "required",
            "gender" => "required",
        ])->validate();


        $member = Member::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'other_name' => $request->other_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
//            'cell_id' => $request->cell_id,
            'ministry_id' => $request->ministry_id,
        ]);

        return Redirect::route('members.show', ['id' => $member->id])->with('success', 'Member created!');
    }

    public function show($id)
    {
        $member = Member::find($id);
        if (!is_object($member))
            return Redirect::back()->with('error', 'Member not found');
        else {
            return view('pages.members.show', compact('member'));
        }
    }

    public function edit($id)
    {
        $member = Member::find($id);
        if (!is_object($member))
            return Redirect::back()->with('error', 'Member not found');
        else {
            return view('pages.members.edit', compact('member'));
        }
    }

    public function update(Request $request, $id)
    {
        $member = Member::find($id);
        if (!is_object($member))
            return Redirect::back()->with('error', 'Member not found');
        else {
            //update

            Validator::make($request->all(), [
                "first_name" => "required",
                "last_name" => "required",
                "gender" => "required",
            ])->validate();

            $member->update([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'other_name' => $request->other_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
//            'cell_id' => $request->cell_id,
                'ministry_id' => $request->ministry_id,
            ]);

            return Redirect::route('events.show', $id)->with('success', 'Member updated!');
        }
    }

    public function trash($id)
    {
        $member = Member::find($id);
        if (!is_object($member))
            return Redirect::back()->with('error', 'Member not found');
        else {
            $member->delete();
            return Redirect::route('members.index')->with('success', 'Member deleted!');
        }
    }
}
