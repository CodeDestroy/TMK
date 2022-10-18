<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Main;
use App\Models\News;
use App\Models\Partners;
class MainController extends Controller
{
    public function getAllInfo (){
        $news = new News();
        $main = new Main();
        $partners = new Partners;


        return view('index')
               ->with('description', $main->all())
               ->with('data', $news->take(2)->get())
               ->with('partners', $partners->where('show_on_main', '=', '1')->get());
    }
    
    /* public function getNewsById ($id){
        $news = new News();
        return view('news-inside', ['data' =>  $news->find($id)]);
    } */
}
