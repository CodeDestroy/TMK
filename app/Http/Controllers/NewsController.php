<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Contacts;
use App\Models\ProductionType;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function getAllNews (){
        $news = new News();
        $types = new ProductionType();
        return view('news')
               ->with('data',  $news->all())
               ->with('types', $types->all())
               ->with('contacts', Contacts::first())
               ->with('categories', Categories::all())
               ->with('sub_categories', SubCategories::all());
    }

    public function getNewsById ($id){
        $news = new News();
        return view('news-inside')
               ->with('data', $news->find($id))
               ->with('contacts', Contacts::first())
               ->with('categories', Categories::all())
               ->with('sub_categories', SubCategories::all());
    }
}
