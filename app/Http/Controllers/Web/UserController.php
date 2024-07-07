<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function linkMember(Request $request, $id)
    {
        $user = User::find($id);

        if (!is_object($user)){
            return Redirect::back()->with('error', 'User not found');
        }else{
//            Validator::make($request->all(), [
//                "user_id" => "required",
//                "last_name" => "required",
//                "gender" => "required",
//            ])->validate();
//
//            $user->update([
//                "member_id" =>
//            ]);
        }
    }
}
