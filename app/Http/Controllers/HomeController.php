<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use \Datetime;

class HomeController extends Controller
{
    public function index(){
    //    $client=new Client(['verify' => false]);
    //    $request=$client->get('https://newsapi.org/v2/top-headlines?country=us&category=business&apiKey=15a89f301f0145f8bca1b3241d320faa');
    //    $articles = json_decode($request->getBody());
    //    $articles=$articles->articles;
    // view('index',['articles' => $articles]);

    // $d1 = new DateTime(date('Y-m-d',strtotime("Fri, Oct 8, 2021 2:39 AM")));
    // $d2 = new DateTime("2022-01-08");

    // $interval = $d1->diff($d2);
    // $diffInMonths  = $interval->m;
    // dd($diffInMonths);
        return view('index');
    }
}
