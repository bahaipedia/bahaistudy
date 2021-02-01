<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;

class TestController extends Controller
{
    function welcome(){
    	$title = 'Bahai';
    	return $title;
    	return view('welcome', compact('title'));
    }
    function console(){
    	$message = Test::all();
    	return view('console', compact('message'));
    }
}
