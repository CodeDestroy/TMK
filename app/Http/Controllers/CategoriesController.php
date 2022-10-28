<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Contacts;
use App\Models\Production;
use App\Models\ProductionType;
use App\Models\SubCategories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /*public function getAllProducts ($category){
        $product = new Production();
        $types = new ProductionType();
        //dd(ProductionType::all(), Production::all());
        return view('product-inside')
            ->with('description', SubCategories::where('alias', $category)->get)
            ->with('contacts', Contacts::first())
            ->with('categories', Categories::all())
            ->with('sub_categories', SubCategories::all());
    }*/
}
