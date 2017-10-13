<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SecondController extends Controller
{
    public function second_show()
    {
		echo "This is secondcontroller";
        //return view('welcome');
    }
}
