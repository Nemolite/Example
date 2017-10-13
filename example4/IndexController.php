<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Mail; 

class IndexController extends Controller
 {
   
	
	public function show() { 
		return view('site.index');
	}
	

	
	public function	send_mail(Request $request) {
				
		if ($request->isMethod('post')) {
	
		$data = $request ->all();
		
		$result = Mail::send('site.email',['data'=>$data], function( $mess ) use ($data){
			
			$mail_admin = env('MAIL_ADMIN');
			$mail_me = "g16052015@mail.ru";
			
			$mess->from($mail_admin,$data['name']);
			$mess->to($mail_me,'Admin')->subject('vandraren');
		
		   });
		     if ($result) {
			echo "Сообщение отправлено";
			
		      }
	     
		}

	} //send_mail
	

	
	
}

