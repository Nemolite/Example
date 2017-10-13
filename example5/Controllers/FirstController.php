<?php
namespace App\Http\Controllers;

use  App\Http\Controllers\FirstController;

class FirstController extends Controller {
	
	public function display_user()
    {
		
        return view('welcome');
    }
	
	public function display_admin()
    {
		
        return view('home');
    }
	
	public function display_method($newid)
    {
		echo "This is text".$newid;
		echo "<br />";
		echo __METHOD__;
        
    }
}

?>