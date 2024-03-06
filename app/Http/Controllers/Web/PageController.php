<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Mews\Purifier\Facades\Purifier;

class PageController extends Controller
{

    public function announcements()
    {
        $page = Page::where("name", "announcements")->first();
        $contents = json_decode($page->contents);
        return view("pages.special.announcements", compact("contents"));
    }

    public function fundraising()
    {
        $page = Page::where("name", "fundraising")->first();
        $contents = json_decode($page->contents);
        return view("pages.special.fundraising", compact("contents"));
    }

    public function store(Request $request)
    {
        if ($request->name == "announcements") {
            Validator::make($request->all(), [
                "body" => "required",
                "activate" => "required",
            ]);

            $page = Page::where("name", $request->name)->first();
            $page->update([
                "contents" => json_encode([
                    "body" => Purifier::clean($request->body),
                    "activate" => intval($request->activate ? 1:0),
                ])
            ]);

            return Redirect::back()->with("success", "Successfully updated announcements");

        } else if ($request->name == "fundraising") {
            Validator::make($request->all(), [
                "title" => "required",
                "description" => "required",
                "collected" => "required",
                "target" => "required",
                "activate" => "required",
            ]);

            $page = Page::where("name", $request->name)->first();
            $page->update([
                "contents" => json_encode([
                    "title" => $request->title,
                    "description" => $request->description,
                    "collected" => floatval($request->collected),
                    "target" => floatval($request->target),
                    "activate" => intval($request->activate ? 1:0),
                ])
            ]);

            return Redirect::back()->with("success", "Successfully updated fundraising details");
        }


    }

}
