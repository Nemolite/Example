<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    //
	public function getIndex() { //getIndex - not random
		echo __METHOD__;
	}
	
	public function getCreate() { //getCreate -  get and Create
		echo __METHOD__;
		echo "<br />";
		echo route('pages.create');
	}
	
	public function postIndex() { //
		print_r($_POST);
	}
}
