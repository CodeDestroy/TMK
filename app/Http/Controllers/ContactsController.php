<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\ProductionType;
use App\Orchid\Screens\Categories\SubCategoriesPage;
use Illuminate\Http\Request;
use App\Models\Contacts;
class ContactsController extends Controller
{
    public function getAllContacts (){
        $contacts = new Contacts();
        $types = new ProductionType();
        return view('contacts')
            ->with('types', $types->all())
            ->with('contacts', $contacts->first())
            ->with('categories', Categories::all())
            ->with('sub_categories', SubCategories::all());
    }
}
