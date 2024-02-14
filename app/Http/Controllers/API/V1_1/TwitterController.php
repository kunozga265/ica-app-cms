<?php

namespace App\Http\Controllers\API\V1_1;

use App\Http\Controllers\Controller;
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
