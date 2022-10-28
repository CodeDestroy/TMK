<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Contacts;
use App\Models\Production;
use App\Models\ProductionType;
use App\Models\SubCategories;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{
    public function getSubCategoryById ($category ,$sub_category){
        $types = new ProductionType();
        //dd(SubCategories::where('alias', $sub_category)->get());
        //return  SubCategories::where('alias', $sub_category)->get()[0]->text;
        return view('sub_category-inside')
            ->with('description', SubCategories::where('alias', $sub_category)->get()[0])
            ->with('types', $types->all())
            ->with('contacts', Contacts::first())
            ->with('categories', Categories::all())
            ->with('sub_categories', SubCategories::all());
    }
}
