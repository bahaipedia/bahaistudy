<?php

namespace App\Http\Controllers;

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
        $this->middleware('authorization');
	}
    public function welcome(){
    	$title = Configuration::find(1)->app_name;
        $groups = Group::select('id', 'name', 'description', 'book_id', 'group_container_id', 'route', 'max_size')->where('status', NULL)->get();
        // sending available in group
    	return view('welcome', compact('title', 'groups'));
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

    // public function s3template(Request $request){
    //     $file_methods = new FileController;
    //     $book_image_id = $file_methods->storeFile($request);
    //     $book = New Book;
    //     $book->user_id = auth()->user()->id;
    //     $book->name = $request->name;
    //     $book->description = $request->description;
    //     $book->book_image_id = $book_image_id;
    //     $book->date = $request->date;
    //     $book->author_id = $request->author_id;
    //     $book->number_pages = $request->number_pages;
    //     $book->save();
    //     $header = 'Uploaded file!';
    //     $message = "The file was uploaded";
    //     return view('auth.response', compact('header', 'message'));
    // }

    // public function s3form(){
    //     return view('dev.book-form');
    // }
}