<?php

namespace App\Http\Controllers\Web\API\V1_1;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\DownloadCollection;
use App\Models\Download;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads=Download::orderBy('date','desc')->paginate((new AppController())->paginate);
        return response()->json(new DownloadCollection($downloads));
    }

}
