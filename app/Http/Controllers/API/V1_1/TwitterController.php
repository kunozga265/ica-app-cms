<?php

namespace App\Http\Controllers\Web\API\V1_1;

use App\Http\Controllers\Web\Controller;
use Illuminate\Http\Request;
use Atymic\Twitter\Facade\Twitter;
use Atymic\Twitter\Twitter as TwitterContract;

class TwitterController extends Controller
{
    public function index()
    {
        return Twitter::userTweets("1882487780",[]);
    }
}
