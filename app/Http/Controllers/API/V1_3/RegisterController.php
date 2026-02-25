<?php

namespace App\Http\Controllers\API\V1_3;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Http\Resources\RegisterResource;
use App\Models\Member;
use App\Models\Register;
use Google\Service\AlertCenter\RequestInfo;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // $paginate = 100
    public function index()
    {
        $registers = Register::orderBy('date', 'desc')->paginate((new AppController())->paginate);

        $members = Member::orderBy('last_name', 'asc')->get();

        return response()->json([
            'registers' => RegisterResource::collection($registers),
            'members' => MemberResource::collection($members)
        ]);
    }

    public function attendance(Request $request, $code)
    {
        $register = Register::where('code', $code)->first();
        return response()->json(MemberResource::collection($register->members));
    }

    public function store(Request $request)
    {
        $request->validate([
            "ministry_id" => "required",
            "date" => "required",
        ]);

        Register::create([
            "code" => (new AppController())->generateUniqueCode(),
            "name" => $request->name,
            "ministry_id" => $request->ministry_id,
            "date" => (new AppController())->getTimestamp($request->date),
        ]);

        return response()->json(["message" => "Successfully create service"]);
    }

    public function recordAttendance(Request $request)
    {

        $request->validate([
            "attendees" => "required",
        ]);

        foreach ($request->attendees as $attendee) {

            $register = Register::where('id', $attendee['register_id'])->first();
            $member = Member::where('id', $attendee['member_id'])->first();


            if ($attendee["checked"] || $attendee["checked"] == '1' || $attendee["checked"] == 1) {
                if (!$register?->members()->where('member_id', $member->id)->exists()) {
                    $register?->members()->attach($member);
                }
            } else {
                $register->members()->detach($member);
            }
        }

        return response()->json();
    }
}
