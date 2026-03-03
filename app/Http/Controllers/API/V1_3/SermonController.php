<?php

namespace App\Http\Controllers\API\V1_3;

use App\Http\Controllers\Controller;
use App\Models\View;
use App\Models\Sermon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SermonController extends Controller
{
    public function registerView(Request $request, $slug)
    {

        $sermon = Sermon::where('slug', $slug)->first();

        $view = View::where('sermon_id', $sermon->id)->where('user_id', Auth::id())->first();

        if (is_object($view)) {
            $view->update([
                'count' => $view->count + 1
            ]);
        } else {
            $view = View::create([
                'user_id' => Auth::id(),
                'sermon_id' => $sermon->id,
                'count' => 1
            ]);
        }


        return response()->json();
    }
}
