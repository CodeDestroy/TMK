<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Production;
class ProductionController extends Controller
{
    public function getAllProducts (){
        $product = new Production();
        return view('products', ['data' =>  $product->all()]);
    }
    
    public function getProductsById ($id){
        $product = new Production();
        return view('product-inside', ['data' =>  $product->find($id)]);
    }

}
