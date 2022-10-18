<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
class NewsController extends Controller
{
    public function getAllNews (){
        $news = new News();
        return view('news', ['data' =>  $news->all()]);
    }
    
    public function getNewsById ($id){
        $news = new News();
        return view('news-inside', ['data' =>  $news->find($id)]);
    }
}
