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
    public $paginate = 20;
    private int $count = 0;

    public function dashboard()
    {
        //get sermons
        $sermons = Sermon::orderBy("published_at", "desc")->limit(5)->get();
        return response()->json(Resources\SermonResource::collection($sermons), 200);
    }

    public function dashboard_1_0_0()
    {
        //get sermons
        $sermons = Sermon::orderBy("published_at", "desc")->limit(5)->get();

        //get prayer points
        $now = Carbon::now()->getTimestamp();
        $prayer = Prayer::where('date', '<=', $now)->orderBy('date', 'desc')->first();

        return response()->json([
            'sermons' => Resources\SermonResource::collection($sermons),
            'prayer' => $prayer
        ]);
    }

    public function imageUpload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('images/uploads'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/uploads/' . $fileName);
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
        $user = User::find(Auth::id());

        Validator::make($request->all(), [
            'currentPassword' => ['required', 'string', 'min:8'],
            'newPassword' => ['required', 'string', 'min:8']
        ])->validate();

        if (Hash::check($request->currentPassword, $user->password)) {
            $user->forceFill([
                'password' => Hash::make($request->newPassword),
            ])->save();
            return Redirect::back()->with('success', 'Password updated!');
        } else
            return Redirect::back()->with('error', "The provided password does not match your current password.");

    }

    public function filterBody($body, $initial_entry = false)
    {


        $body = json_decode(str_replace('\r\n\t<li>', '<li>', json_encode($body)));
        $body = json_decode(str_replace('\r\n\t\t<li>', '<li>', json_encode($body)));
        $body = json_decode(str_replace('\r\n\t\t\t<li>', '<li>', json_encode($body)));
        $body = json_decode(str_replace('\r\n\t\t<ul>', '<ul>', json_encode($body)));
        $body = json_decode(str_replace('\r\n\t\t<\/ul>', '<\/ul>', json_encode($body)));
        $body = json_decode(str_replace('<li>\r\n\t<p>', '<li>', json_encode($body)));
        $body = json_decode(str_replace('<\/p>\r\n\r\n\t<ul>', '\r\n\t<ul>', json_encode($body)));
        $body = json_decode(str_replace('<\/p>\r\n\r\n\t<ol>', '\r\n\t<ol>', json_encode($body)));
        $body = json_decode(str_replace('<\/ul>\r\n\t<\/li>', '<\/ul><\/li>', json_encode($body)));
        $body = json_decode(str_replace('<\/ul>\r\n\t\t<\/li>', '<\/ul><\/li>', json_encode($body)));
        $body = json_decode(str_replace('<\/ol>\r\n\t<\/li>', '<\/ol><\/li>', json_encode($body)));
        $body = json_decode(str_replace('<\/li>\r\n\t<\/ul>', '<\/li><\/ul>', json_encode($body)));
        $body = json_decode(str_replace('<\/li>\r\n\t<\/ol>', '<\/li><\/ol>', json_encode($body)));
        $body = json_decode(str_replace('<br \/>\r\n\t', '<br \/>', json_encode($body)));
        $body = json_decode(str_replace('<br \/>\t', '<br \/>', json_encode($body)));

        $body = json_decode(str_replace('<p>', '<p><span>', json_encode($body)));
        $body = json_decode(str_replace('<\/p>', '<\/span><\/p>', json_encode($body)));
        $body = json_decode(str_replace('<li>', '<li><span>', json_encode($body)));
        $body = json_decode(str_replace('<\/li>', '<\/span><\/li>', json_encode($body)));

//        //splits sentences and adds spans
//        $body = json_decode(preg_replace_callback('/ (\w+)\. (\w+)/', array($this, 'splitSenteces'), json_encode($body)));

        //gives spans ids
        $body = json_decode(preg_replace_callback('/<(span+)(?![^>]*\/>)[^>]*>/', array($this, 'giveSpanIds'), json_encode($body)));

//        //For highlighting
//        if($initial_entry){
//
//        }else{
//            dump($body);
//            //delete all span ids
//            $body = json_decode(preg_replace_callback('/<span id=\'(0|[1-9][0-9]*)\'>/', array($this, 'temp'), json_encode($body)));
//
//            dd($body);
//
//            //add new spans
//
//            //recalculate ids
//        }

        return $body;

    }

    public function giveSpanIds($matches)
    {
        $this->count++;
        return "<span id='" . $this->count . "'>";
    }
    public function splitSenteces($matches)
    {
        return " $matches[1]<\/span>. <span>$matches[2]";
    }
}
