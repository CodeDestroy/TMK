<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Contacts;
use App\Models\ProductionType;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use App\Models\Service;
class ServicesController extends Controller
{
    public function getAllServices (){
        $service = new Service();
        $types = new ProductionType();
        return view('services')
               ->with('data', $service->all())
               ->with('types', $types->all())
               ->with('contacts', Contacts::first())
               ->with('categories', Categories::all())
               ->with('sub_categories', SubCategories::all());
    }

    public function getServicesById ($id){
        $service = new Service();
        $types = new ProductionType();
        return view('services-inside')
               ->with('data', $service->find($id))
               ->with('types', $types->all())
               ->with('contacts', Contacts::first())
               ->with('categories', Categories::all())
               ->with('sub_categories', SubCategories::all());
    }
}
