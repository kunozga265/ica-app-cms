<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Prayer;
use App\Models\Sermon;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AppController extends Controller
{
    public $paginate=20;

    public function dashboard()
    {
        //get sermons
        $sermons = Sermon::orderBy("published_at","desc")->limit(5)->get();
        return response()->json(Resources\SermonResource::collection($sermons),200);
    }
    public function dashboard_1_0_0()
    {
        //get sermons
        $sermons = Sermon::orderBy("published_at","desc")->limit(5)->get();

        //get prayer points
        $now=Carbon::now()->getTimestamp();
        $prayer=Prayer::where('date','<=',$now)->orderBy('date','desc')->first();

        return response()->json([
            'sermons'   => Resources\SermonResource::collection($sermons),
            'prayer'    => $prayer
        ]);
    }

    public function imageUpload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('images/uploads'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/uploads/'.$fileName);
            $msg = 'Image successfully uploaded';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function changePasswordView()
    {
        return view('pages.users.change-password');
    }

    public function changePassword(Request $request)
    {
        $user=User::find(Auth::id());

        Validator::make($request->all(), [
            'currentPassword' => ['required', 'string','min:8'],
            'newPassword'=> ['required', 'string','min:8']
        ])->validate();

        if(Hash::check($request->currentPassword, $user->password)){
            $user->forceFill([
                'password' => Hash::make($request->newPassword),
            ])->save();
            return Redirect::back()->with('success','Password updated!');
        }else
            return Redirect::back()->with('error',"The provided password does not match your current password.");

    }
}
