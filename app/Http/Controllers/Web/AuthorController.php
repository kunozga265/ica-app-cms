<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mews\Purifier\Facades\Purifier;
use Psy\Readline\Hoa\FileException;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    public function index()
    {
        $authors= Author::all();
        return view('pages.authors.index',compact('authors'));
    }


    /**
     * Display a listing of the resource.
     *
     * @param string $filter
     * @param string $query
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFiltered($filter,$query)
    {
        switch ($filter){
            case "All":
                $authors= Author::orderBy("name","asc")->get();
                break;
            case "ICA":
                $authors= Author::where("ica_pastor",1)->orderBy("name","asc")->get();
                break;
            case "Other":
                $authors= Author::where("ica_pastor",0)->orderBy("name","asc")->get();
                break;
            case "Trashed":
                $authors= Author::onlyTrashed()->orderBy("name","asc")->get();
                break;
            case "Search":
                $authors=Author::search($query)->withTrashed()->get();
                break;
            default:
                return response()->json([],204);
        }
        return response()->json(Resources\AuthorResource::collection($authors),200);
    }

    public function create()
    {
        return view('pages.authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        Validator::make($request->all(),[
            "name"          =>  "required",
            "title"         =>  "required",
            "ica_pastor"    =>  "required",
        ]);

        $slug=Str::slug($request->name).date("-Y-m-d");
        $avatar="images/avatar.png";

        if (isset($request->avatar)){
            $filename=$slug.".".$request->avatar->extension();
            try {
                $request->avatar->move(public_path('images/authors'),$filename);
                $avatar="images/authors/$filename";
            }catch (FileException $exception){
                //catch file exception
            }
        }

        $author=new Author([
            "avatar"        =>  $avatar,
            "name"          =>  $request->name,
            "suffix"        =>  $request->suffix,
            "slug"          =>  $slug,
            "title"         =>  $request->title,
            "biography"     =>  $request->biography,
            "ica_pastor"    =>  $request->ica_pastor?1:0,
        ]);

        $author->save();

        return Redirect::route('authors.index')->with('success','Minister created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     */
    public function show($slug)
    {
        $author = Author::where('slug','=',$slug)->first();
        if (!is_object($author))
            return Redirect::back()->with('error','Minister not found');
        else {
            $sermons= Author::where('slug',$slug)->first()->sermons()->orderBy("published_at","desc")->paginate((new AppController())->paginate);
            return view('pages.authors.show',compact('author','sermons'));
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSermonsByAuthor($slug)
    {
        $author = Author::where('slug','=',$slug)->first();
        if (!is_object($author))
            return response()->json(["response"=>false],204);
        else {
//            $sermons= Author::where('slug',$slug)->first()->sermons()->orderBy("published_at","desc")->paginate(2);
//            return response()->json(new Resources\SermonCollection($sermons), 200);
            $sermons= Author::where('slug',$slug)->first()->sermons()->orderBy("published_at","desc")->get();
            return response()->json(Resources\SermonResource::collection($sermons), 200);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSermonsByAuthor_1_0_0($slug)
    {
        $author = Author::where('slug','=',$slug)->first();
        if (!is_object($author))
            return response()->json(["response"=>false],204);
        else {
            $sermons= Author::where('slug',$slug)->first()->sermons()->orderBy("published_at","desc")->paginate((new AppController())->paginate);
            return response()->json(new Resources\SermonCollection($sermons), 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     */
    public function edit($slug)
    {
        $author = Author::where('slug','=',$slug)->first();
        if (!is_object($author))
            return Redirect::back()->with('error','Minister not found');
        else {
            return view('pages.authors.edit',compact('author'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $slug
     */
    public function update(Request $request, $slug)
    {

        $author = Author::where('slug','=',$slug)->first();

        if (!is_object($author))
            return Redirect::back()->with('error','Minister not found');
        else {
            Validator::make($request->all(),[
                "name"          =>  "required",
                "title"         =>  "required",
                "ica_pastor"    =>  "required",
            ]);

           // $slug=Str::slug($request->name).date("-Y-m-d");

            $author->update([
                "name"          =>  $request->name,
                "suffix"          =>  $request->suffix,
      //          "slug"          =>  Str::slug($request->name).date("-Y-m-d"),
                "title"         =>  $request->title,
                "biography"     =>  $request->biography,
                "ica_pastor"    =>  $request->ica_pastor?1:0,
            ]);

            if(isset($request->avatar)){
                if(file_exists($author->avatar) && $author->avatar!=="images/avatar.png"){
                    Storage::disk("public_uploads")->delete($author->avatar);
                }

                $filename=$slug.".".$request->avatar->extension();
                try {
                    $request->avatar->move(public_path('images/authors'),$filename);
                    $author->update([
                        "avatar" => "images/authors/$filename"
                    ]);
                }catch (FileException $exception){
                    //catch file exception
                }
            }

            return Redirect::route('authors.show',['slug'=>$slug])->with('success','Minister Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     */
    public function trash($slug)
    {
        $author = Author::where('slug','=',$slug)->first();
        if (!is_object($author))
            return Redirect::back()->with('error','Minister not found');
        else {
            if($author->sermons->count()>0){
                foreach ($author->sermons as $sermon){
                    $sermon->forceDelete();
                }
            }
            $author->delete();
            return Redirect::route('authors.index')->with('success','Minister deleted!');
        }
    }
    /**
     * Restores the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($slug)
    {
        $author = Author::onlyTrashed()->where('slug','=',$slug)->first();
        if (!is_object($author))
            return response()->json(["response"=>false],204);
        else {
            $author->restore();
            return response()->json(["response" => true], 200);
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
        $author = Author::onlyTrashed()->where('slug','=',$slug)->first();
        if (!is_object($author))
            return response()->json(["response"=>false],204);
        else {
            if(file_exists($author->avatar) && $author->avatar!=="images/avatar.png"){
                Storage::disk("public_uploads")->delete($author->avatar);
            }
            $author->forceDelete();
            return response()->json(["response" => true], 200);
        }
    }

    /**
     * Upload image
     *
     * @param  string $encodedFile
     * @return string
     */
    private function uploadImage($name,$encodedFile){

        //upload new picture
        $explodedFile=explode(',',$encodedFile);
        //$decodedFile=base64_decode($explodedFile[1]);

        //develop name
        $ext=$this->getExtension($explodedFile);
        $filename="images/".$name."-".uniqid().".".$ext;

        if($ext=='jpg' || $ext=='png'){
            try{
                Storage::disk('public_uploads')->put(
                    $filename,file_get_contents($encodedFile)
                );
            }catch (\RuntimeException $e){
                return response()->json([
                    'message' => "Failed to upload",
                ],501);
            }
        }else {
            return response()->json([
                'message' => "Invalid extension",
            ],415);
        }

        return $filename;
    }

    private function getExtension($explodedImage)
    {
        $imageExtensionDecode=explode('/',$explodedImage[0]);
        $imageExtension=explode(';',$imageExtensionDecode[1]);
        $lowercaseExt=strtolower($imageExtension[0]);
        if($lowercaseExt=='jpeg')
            return 'jpg';
        else
            return $lowercaseExt;
    }

}
