<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Managment\FileController;
use Illuminate\Http\Request;

use App\Book;
use App\Author;
use App\GroupContainer;
use App\AuthorsInContainer;

class StoreController extends Controller
{
    public function __construct(){
        $this->middleware('authorization');
	}

	public function group($id = NULL){
		if($id == NULL){
			return 'route in construction';
		}
		$container = GroupContainer::find($id);
		return $container;
    	return view('dev.forms.store.group');
    }
	public function groupPost(Request $request){
        
        // $author = New Author;
        // $author->user_id = auth()->user()->id;
        // $author->name = $request->name;
        // $author->lastname = $request->lastname;
        // $author->date_of_birth = $request->date_of_birth;
        // $author->nationality = $request->nationality;
        // $author->save();

        $header = 'Group was created!';
        $message = "The group was created";
        return view('auth.response', compact('header', 'message'));
    }

	public function author(){
    	return view('dev.forms.store.author');
    }
	public function authorPost(Request $request){
        
        $author = New Author;
        $author->user_id = auth()->user()->id;
        $author->name = $request->name;
        $author->lastname = $request->lastname;
        $author->date_of_birth = $request->date_of_birth;
        $author->nationality = $request->nationality;
        $author->save();

        $header = 'Author data stored!';
        $message = "The data was stored";
        return view('auth.response', compact('header', 'message'));
    }


    public function book(){
    	// ALL THE VIEWS ITS GOING TO CHANGE WHEN WE START IMPLEMENT THE FRONT-END
    	$authors = Author::all();
    	return view('dev.forms.store.book', compact('authors'));
    }
    public function bookPost(Request $request){
        $file_methods = new FileController;
        $book_image_id = $file_methods->storeBookImage($request);
        $book = New Book;
        $book->user_id = auth()->user()->id;
        $book->name = $request->name;
        $book->description = $request->description;
        $book->book_image_id = $book_image_id;
        $book->date = $request->date;
        $book->author_id = $request->author_id;
        $book->number_pages = $request->number_pages;
        $book->save();
        $header = 'Uploaded file!';
        $message = "The file was uploaded";
        return view('auth.response', compact('header', 'message'));
    }

    public function container(){
    	$authors = Author::all();
    	return view('dev.forms.store.container', compact('authors'));
    }
	public function containerPost(Request $request){
        
        $container = New GroupContainer;
        $container->user_id = auth()->user()->id;
        $container->name = $request->name;
        $container->description = $request->description;
        $container->weight = $request->weight;
        $container->save();

		$aic = New AuthorsInContainer;
		$aic->author_id = $request->author_0;
		$aic->group_container_id = $container->id;
		$aic->save();

		$aic = New AuthorsInContainer;
		$aic->author_id = $request->author_1;
		$aic->group_container_id = $container->id;
		$aic->save();

        $header = 'Container was created!';
        $message = "The container was created succesfully";
        return view('auth.response', compact('header', 'message'));
    }


}
