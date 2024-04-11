<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cell;
use App\Models\Member;
use App\Models\Ministry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Psy\Readline\Hoa\FileException;

class MemberController extends Controller
{
    public function index()
    {
//        $members = Member::orderBy('last_name', 'asc')->paginate((new AppController())->paginate);
        $members = Member::orderBy('last_name', 'asc')->get();

        return view('pages.members.index', compact("members"));
    }


    public function create()
    {
        $ministries = Ministry::orderBy("name", "asc")->get();
        return view('pages.members.create', compact("ministries"));
    }

    public function store(Request $request)
    {

        Validator::make($request->all(), [
            "first_name" => "required",
            "last_name" => "required",
            "gender" => "required",
        ])->validate();

        $slug=Str::slug($request->first_name."-".$request->last_name).date("-Y-m-d");
        $avatar="images/avatar.png";

        if (isset($request->avatar)){
            $filename=$slug.uniqid().".".$request->avatar->extension();
            try {
                $request->avatar->move(public_path('images/members'),$filename);
                $avatar="images/members/$filename";
            }catch (FileException $exception){
                //catch file exception
            }
        }

        $member = Member::create([
            "code" =>(new AppController())->generateUniqueCode(),
            "avatar"        =>  $avatar,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'other_name' => $request->other_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            "date_of_birth"  =>  isset($request->date_of_birth) ? (new AppController())->getTimestamp($request->date_of_birth) : null

        ]);



        return Redirect::route('members.index', ['id' => $member->id])->with('success', 'Member created!');
    }

    public function show($code)
    {
        $member = Member::where("code",$code)->first();
        if (!is_object($member))
            return Redirect::back()->with('error', 'Member not found');
        else {
            return view('pages.members.show', compact('member'));
        }
    }

    public function edit($code)
    {
        $member = Member::where("code",$code)->first();
        if (!is_object($member))
            return Redirect::back()->with('error', 'Member not found');
        else {
            return view('pages.members.edit', compact('member'));
        }
    }

    public function update(Request $request, $code)
    {
        $member = Member::where("code",$code)->first();
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
//                'ministry_id' => $request->ministry_id,
            ]);

            return Redirect::route('members.show', $code)->with('success', 'Member updated!');
        }
    }

    public function trash($code)
    {
        $member = Member::where("code",$code)->first();
        if (!is_object($member))
            return Redirect::back()->with('error', 'Member not found');
        else {
            $member->delete();
            return Redirect::route('members.index')->with('success', 'Member deleted!');
        }
    }

    public function addToCell(Request $request, $code)
    {
        Validator::make($request->all(), [
            "member_id" => "required",
        ])->validate();

        $cell = Cell::where("code",$code)->first();
        $member = Member::find($request->member_id);

        if (!is_object($cell))
            return Redirect::back()->with('error', 'Cell information not found');
        else if (!is_object($member))
            return Redirect::back()->with('error', 'Member not found');
        else if($cell->members()->where('id', $request->member_id)->exists()){
            return Redirect::back()->with('error', 'Member already part of the cell');
        }
        else{
            $member->update([
                "cell_id" => $cell->id
            ]);
            return Redirect::route("cells.show", ["code" => $cell->code])->with('success', 'Member successfully added!');
        }
    }

    public function removeFromCell(Request $request, $cell_id)
    {
        Validator::make($request->all(), [
            "member_id" => "required",
        ])->validate();

        $cell = Cell::findOrFail($cell_id);
        $member = $cell->members()->where('id', $request->member_id)->first();

        if (!is_object($member))
            return Redirect::back()->with('error', 'Member not part of the cell');
        else {
            $member->update([
                "cell_id" => null
            ]);
            return Redirect::route("cells.show", ["id" => $cell_id])->with('success', 'Member successfully removed!');
        }
    }
}
