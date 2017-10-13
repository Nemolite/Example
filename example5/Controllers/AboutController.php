<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AboutController extends Controller
{
  
	public function show(){
		if (view()->exists('default.about')) {
			
			
			$view = view('default.about',['title'=>'Hello,World'])->render();
			echo $view;
			
	}
		}
		
		
		
		
}













		
			
	

