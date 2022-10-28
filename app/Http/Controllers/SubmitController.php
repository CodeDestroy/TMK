<?php

namespace App\Http\Controllers;

use App\Models\Submit;
use Illuminate\Http\Request;

class SubmitController extends Controller
{
    public function sentSebmit(Request $request){
        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|min:11'

        ]);
        $submit = new Submit();
        $submit->name = $request->input('name');
        $submit->email = $request->input('email');
        $submit->phone = $request->input('phone');

        $submit->save();

        return redirect('/');
    }
}
