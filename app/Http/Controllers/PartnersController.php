<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partners;
class PartnersController extends Controller
{
    public function getAllPartners (){
        $partners = new Partners();
        return view('partners', ['data' =>  $partners->all()]);
    }

}
