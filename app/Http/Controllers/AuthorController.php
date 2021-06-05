<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Resources;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use Validator;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $authors= Author::orderBy("name","asc")->get();
        return response()->json(["authors"=>Resources\AuthorResource::collection($authors)],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            "name"          =>  "required",
            "title"         =>  "required",
            "ica_pastor"    =>  "required",
        ]);

        if ($validator->fails()){
            return response()->json(["message"=>"Name, title and ICA pastor attributes required."],400);
        }

        $author=new Author([
            "avatar"        =>  $request->avatar != null? /*Image Upload*/ $request->avatar : "images/avatar.png",
            "name"          =>  $request->name,
            "suffix"          =>  $request->suffix,
            "slug"          =>  Str::slug($request->name).date("-Y-m-d"),
            "title"         =>  $request->title,
            "biography"     =>  Purifier::clean($request->biography),
            "ica_pastor"    =>  $request->ica_pastor,
        ]);

        $author->save();

        return response()->json(["author"=>new Resources\AuthorResource($author)],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($slug)
    {
        $author = Author::where('slug','=',$slug)->first();
        if (!is_object($author))
            return response()->json(["response"=>false],204);
        else {
            $sermons= Author::where('slug',$slug)->first()->sermons()->orderBy("published_at","desc")->paginate(2);
            return response()->json([
                "author"    =>  new Resources\AuthorResource($author),
                "sermons"   =>  new Resources\SermonCollection($sermons)
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $slug)
    {
        $author = Author::where('slug','=',$slug)->first();
        if (!is_object($author))
            return response()->json(["response"=>false],204);
        else {
            $validator=Validator::make($request->all(),[
                "name"          =>  "required",
                "title"         =>  "required",
                "ica_pastor"    =>  "required",
                "avatar"        =>  "required",
            ]);

            if ($validator->fails()){
                return response()->json(["message"=>"Name, title, avatar and ICA pastor attributes required."],400);
            }

            $author->update([
                "avatar"        =>  $request->avatar,
                "name"          =>  $request->name,
                "suffix"          =>  $request->suffix,
                "slug"          =>  Str::slug($request->name).date("-Y-m-d"),
                "title"         =>  $request->title,
                "biography"     =>  Purifier::clean($request->biography),
                "ica_pastor"    =>  $request->ica_pastor,
            ]);
            return response()->json(["author"=>new Resources\AuthorResource($author)],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($slug)
    {
        $author = Author::where('slug','=',$slug)->first();
        if (!is_object($author))
            return response()->json(["response"=>false],204);
        else {
            $author->delete();
            return response()->json(["response" => true], 200);
        }
    }
}
