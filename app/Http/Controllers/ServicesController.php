<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
class ServicesController extends Controller
{
    public function getAllServices (){
        $service = new Service();
        return view('services', ['data' =>  $service->all()]);
    }
    
    public function getServicesById ($id){
        $service = new Service();
        return view('services-inside', ['data' =>  $service->find($id)]);
    }
}
