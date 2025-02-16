<?php

namespace App\Http\Controllers\API\V1_2;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            "email" => ["required"],
            "password" => ["required"],
            "device_name" => ["required"],
        ]);


        $user = User::where('email', $request->email)->first();

        if(is_object($user)) {

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

        }else{
            $request->validate([
                "name" => ["required"],
            ]);

            $splitNames = explode(" ", $request->name);
            $first_name = $splitNames[0];
            $last_name = end($splitNames);

            $user = User::create([
                'first_name' => $splitNames[0],
                'last_name' => $first_name != $last_name ? $last_name : null,
                'email' => $request->email,
                'password' => Hash::make($request->uid),
            ]);

            $role = Role::where("name","normal")->first();
            $user->roles()->attach($role);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'user'  =>  new UserResource($user),
            'token' =>  $token
        ]);

    }
}
