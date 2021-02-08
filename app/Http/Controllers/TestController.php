<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\Configuration;
use Illuminate\Support\Facades\Mail;


class TestController extends Controller
{
	public function __construct(){
        $this->middleware('authorization');
	}
    function welcome(){
    	$title = Configuration::find(1)->app_name;
    	return view('welcome', compact('title'));
    }
    function console(){
    	$message = Test::all();
    	return view('console', compact('message'));
    }
    function sendEmail(){
        $message = Test::all();
        $p1 = 'First parameter';
        $p2 = 'Second parameter';
        Mail::send('email.test', ['p1' => $p1, 'p2' => $p2], function ($message)
            {
                $message->from ('metafoodincorporated@gmail.com');
                $message->to('fabiob1680@hotmail.com');
                $message->subject('Email Test');

            });
        return view('console', compact('message'));
    }
}
