<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Contacts;
use App\Models\ProductionType;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use App\Models\Partners;
class PartnersController extends Controller
{
    public function getAllPartners (){
        $partners = new Partners();
        $types = new ProductionType();
        return view('partners')
               ->with('data', $partners->all())
               ->with('types', $types->all())
               ->with('contacts', Contacts::first())
               ->with('categories', Categories::all())
               ->with('sub_categories', SubCategories::all());
    }

}
