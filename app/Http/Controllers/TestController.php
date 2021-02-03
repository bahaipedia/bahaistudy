<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\Configuration;

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
}
