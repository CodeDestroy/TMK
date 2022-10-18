<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacts;
class ContactsController extends Controller
{
    public function getAllContacts (){
        $contacts = new Contacts();
        return view('contacts', ['data' =>  $contacts->find(1)]);
    }
}
