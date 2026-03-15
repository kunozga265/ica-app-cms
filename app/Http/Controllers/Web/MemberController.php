<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cell;
use App\Models\Member;
use App\Models\Ministry;
use App\Models\User;
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
        //        $members = Member::orderBy('first_name', 'asc')->paginate((new AppController())->paginate);
        $members = Member::orderBy('first_name', 'asc')->get();

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

        $slug = Str::slug($request->first_name . "-" . $request->last_name) . date("-Y-m-d");
        $avatar = "images/avatar.png";

        if (isset($request->avatar)) {
            $filename = $slug . uniqid() . "." . $request->avatar->extension();
            try {
                $request->avatar->move(public_path('images/members'), $filename);
                $avatar = "images/members/$filename";
            } catch (FileException $exception) {
                //catch file exception
            }
        }

        $member = Member::create([
            "code" => (new AppController())->generateUniqueCode(),
            "avatar"        =>  $avatar,
            'first_name' => ucwords($request->first_name),
            'middle_name' => ucwords($request->middle_name),
            'other_name' => ucwords($request->other_name),
            'last_name' => ucwords($request->last_name),
            'gender' => $request->gender,
            'phone_number_airtel' => $request->phone_number_airtel,
            'phone_number_tnm' => $request->phone_number_tnm,
            'phone_number_international' => $request->phone_number_international,
            'email' => $request->email,
            "date_of_birth"  =>  isset($request->date_of_birth) ? (new AppController())->getTimestamp($request->date_of_birth) : null

        ]);

        return Redirect::route('members.index', ['id' => $member->id])->with('success', 'Member created!');
    }

    public function show($code)
    {
        $member = Member::where("code", $code)->first();
        if (!is_object($member))
            return Redirect::back()->with('error', 'Member not found');
        else {

            $chartData = [
                "data" => [],
                "labels" => []
            ];

            foreach ($member->attendances()->get() as $attendance) {
                $chartData["data"][] = 1;
                $chartData["labels"][] = date("m/d/Y", Carbon::createFromTimestamp($attendance->meeting?->date ?? $attendance->register->date)->getTimestamp());
            }

            //            dd($chartData);
            $ministries = Ministry::orderBy("name", "asc")->get();
            $cells = Cell::orderBy("name", "asc")->get();
            $users = User::where("member_id", null)->orderBy("last_name", "asc")->get();

            return view('pages.members.show', compact('member', 'chartData', 'cells', 'ministries', 'users'));
        }
    }

    public function edit($code)
    {
        $member = Member::where("code", $code)->first();
        if (!is_object($member))
            return Redirect::back()->with('error', 'Member not found');
        else {
            return view('pages.members.edit', compact('member'));
        }
    }

    public function update(Request $request, $code)
    {
        $member = Member::where("code", $code)->first();
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

            foreach ($member->users as $user) {
                $user?->update([
                    'trigger' =>  !boolval($user?->trigger)
                ]);
            }

            return Redirect::route('members.show', $code)->with('success', 'Member updated!');
        }
    }

    public function trash($code)
    {
        $member = Member::where("code", $code)->first();
        if (!is_object($member))
            return Redirect::back()->with('error', 'Member not found');
        else {
            $member->delete();

            $member->user?->update([
                'trigger' =>  !boolval($member->user?->trigger)
            ]);
            return Redirect::route('members.index')->with('success', 'Member deleted!');
        }
    }

    public function addToCell(Request $request, $code)
    {
        Validator::make($request->all(), [
            "member_id" => "required",
        ])->validate();

        $cell = Cell::where("code", $code)->first();
        $member = Member::find($request->member_id);

        if (!is_object($cell))
            return Redirect::back()->with('error', 'Cell information not found');
        else if (!is_object($member))
            return Redirect::back()->with('error', 'Member not found');
        else if ($cell->members()->where('id', $request->member_id)->exists()) {
            return Redirect::back()->with('error', 'Member already part of the cell');
        } else {
            $member->update([
                "cell_id" => $cell->id
            ]);
            foreach ($member->users as $user) {
                $user?->update([
                    'trigger' =>  !boolval($user?->trigger)
                ]);
            }
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
            foreach ($member->users as $user) {
                $user?->update([
                    'trigger' =>  !boolval($user?->trigger)
                ]);
            }
            return Redirect::route("cells.show", ["code" => $cell->code])->with('success', 'Member successfully removed!');
        }
    }

    public function transferFromCell(Request $request, $code)
    {
        //        dd("hello");
        Validator::make($request->all(), [
            "cell_id" => "required",
        ])->validate();

        $cell = Cell::find($request->cell_id);
        $member = Member::where("code", $code)->first();
        if (!is_object($cell))
            return Redirect::back()->with('error', 'Cell not found');
        else if (!is_object($member))
            return Redirect::back()->with('error', 'Member not found');
        else if ($member->cell_id == $cell->id) {
            return Redirect::back()->with('error', 'Member is already in this cell');
        } else {
            $member->update([
                "cell_id" => $cell->id
            ]);
            foreach ($member->users as $user) {
                $user?->update([
                    'trigger' =>  !boolval($user?->trigger)
                ]);
            }
            return Redirect::back()->with('success', 'Member successfully transferred!');
        }
    }
    public function assignCell(Request $request, $code)
    {


        Validator::make($request->all(), [
            "cell_id" => "required",
        ])->validate();



        $cell = Cell::find($request->cell_id);
        $member = Member::where("code", $code)->first();

        if (!is_object($cell))
            return Redirect::back()->with('error', 'Cell not found');
        else if (!is_object($member))
            return Redirect::back()->with('error', 'Member not found');
        else {
            $member->update([
                "cell_id" => $cell->id
            ]);
            foreach ($member->users as $user) {
                $user?->update([
                    'trigger' =>  !boolval($user?->trigger)
                ]);
            }
            return Redirect::back()->with('success', 'Member successfully assigned!');
        }
    }
    public function sync(Request $request, $code)
    {

        $member = Member::where("code", $code)->first();

        if (!is_object($member))
            return Redirect::back()->with('error', 'Member not found');
        else {
            foreach ($member->users as $user) {
                $user?->update([
                    'trigger' =>  !boolval($user?->trigger)
                ]);
            }
            return Redirect::back()->with('success', 'Member successfully synced!');
        }
    }
    public function attachMinistries(Request $request, $code)
    {
        Validator::make($request->all(), [
            "ministries" => "required",
        ])->validate();

        $member = Member::where("code", $code)->first();

        if (!is_object($member))
            return Redirect::back()->with('error', 'Member not found');
        else {

            $member->ministries()->detach();
            $member->ministries()->attach($request->ministries);

            return Redirect::back()->with('success', 'Ministries successfully updated!');
        }
    }
    public function linkUser(Request $request, $code)
    {
        Validator::make($request->all(), [
            "user_id" => "required",
        ])->validate();

        $user = User::find($request->user_id);
        $member = Member::where("code", $code)->first();

        if (!is_object($user)) {
            return Redirect::back()->with('error', 'User not found');
        } else if (isset($user->member_id)) {
            return Redirect::back()->with('error', 'User already linked to a profile');
        } else if (!is_object($member))
            return Redirect::back()->with('error', 'Member not found');
        else {

            $user?->update([
                'trigger' =>  !boolval($user?->trigger)
            ]);

            return Redirect::back()->with('success', 'Member successfully linked to user profile!');
        }
    }
}
