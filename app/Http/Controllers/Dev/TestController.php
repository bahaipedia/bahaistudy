<?php

namespace App\Http\Controllers\Dev;

use Illuminate\Http\Request;
use App\Test;
use App\Configuration;
use App\Book;
use App\Group;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Managment\FileController;

class TestController extends Controller
{


	public function __construct(){
	}
    public function welcome(){
    	$title = Configuration::find(1)->app_name;
        $groups = Group::select('id', 'name', 'description', 'book_id', 'group_container_id', 'route', 'max_size')->where('status', NULL)->get();
        // sending available in group
    	return view('dev.welcome', compact('title', 'groups'));
    }
    public function console(){
    	$message = Test::all();
    	return view('console', compact('message'));
    }
    public function sendEmail(){
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