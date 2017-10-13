<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ContController extends Controller
{
    public function showform(Request $request){
		print_r($request->all());
		return view('default.contactform');
		}
}
