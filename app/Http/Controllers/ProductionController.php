<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Contacts;
use App\Models\ProductionType;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use App\Models\Production;
class ProductionController extends Controller
{
    public function getAllProducts (){
        $product = new Production();
        $types = new ProductionType();
        //dd(ProductionType::all(), Production::all());
        return view('products')
               ->with('types', $types->all())
               ->with('data', $product->all())
               ->with('contacts', Contacts::first())
               ->with('categories', Categories::all())
               ->with('sub_categories', SubCategories::all());
    }

    public function getAllProductsByType ($product_type){
        $product = new Production();
        $types = new ProductionType();
        //dd(Production::where('production_type_id', $product_type)->get());
        return view('products')
            ->with('types', $types->all())
            ->with('data', Production::where('production_type_id', $product_type)->get())
            ->with('contacts', Contacts::first())
            ->with('categories', Categories::all())
            ->with('sub_categories', SubCategories::all());
    }

    public function getProductsById ($product_type ,$id){
        $product = new Production();
        $types = new ProductionType();

        return view('product-inside')
               ->with('types', $types->all())
               ->with('data', $product->find($id))
               ->with('contacts', Contacts::first())
               ->with('categories', Categories::all())
               ->with('sub_categories', SubCategories::all());
    }

}
