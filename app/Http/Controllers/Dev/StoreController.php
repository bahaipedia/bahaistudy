<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Dev\Managment\FileController;
use Illuminate\Http\Request;

use App\Book;
use App\Group;
use App\Author;
use App\GroupContainer;
use App\AuthorsInContainer;
use App\GroupParticipant;
use App\AvailableTime;

class StoreController extends Controller
{
    public function __construct(){
        $this->middleware('authorization');
	}

	public function group($id = NULL){
		if($id == NULL){
			return 'route in construction';
		}
		$container = GroupContainer::select('id', 'name')->find($id);
        $authors = AuthorsInContainer::select('author_id')->where('group_container_id', $id)->get();
        $books = Book::whereIn('author_id', $authors->pluck('author_id'))->get();
        // CHECK AUTHOR STATUS
    	return view('dev.forms.store.group', compact('container', 'authors', 'books'));
    }
	public function groupPost(Request $request){
        
        $file_methods = new FileController;
        $group = New Group;
        // Test the function when it have repeat
        $group->route = $file_methods->getUniqueRandom();        
        $group->name = $request->name;
        $group->description = $request->description;
        $group->url = $request->url;
        $group->book_id = $request->book_id;
        $group->host_comments = $request->host_comments;
        $group->host_id = auth()->user()->id;
        $group->max_size = $request->max_size;
        $group->group_container_id = $request->group_container_id;
        $group->save();

        $at = New AvailableTime;
        $at->start_at = date("Y:m:d h:i:s", strtotime( $request->start_at ));
        $at->finish_at = date("Y:m:d h:i:s", strtotime( $request->finish_at ));
        $at->day_of_week = $request->day_of_week;
        $at->user_id = auth()->user()->id;
        $at->group_id = $group->id;
        $at->save();

        $participant = New GroupParticipant;
        $participant->user_id = auth()->user()->id;
        $participant->group_id = $group->id;
        $participant->status = 1;
        $participant->save();



        $header = 'Group was created!';
        $message = "The group was created";
        return view('dev.response', compact('header', 'message'));
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
        return view('dev.response', compact('header', 'message'));
    }


    public function book(){
    	// ALL THE VIEWS ITS GOING TO CHANGE WHEN WE START IMPLEMENT THE FRONT-END
    	$authors = Author::all()->where('status', NUll);
    	return view('dev.forms.store.book', compact('authors'));
    }
    public function bookPost(Request $request){
        $file_methods = new FileController;
        if($request->hasFile('image')){
            $book_image_id = $file_methods->storeBookImage($request);
        }
        $book = New Book;
        $book->user_id = auth()->user()->id;
        $book->name = $request->name;
        $book->description = $request->description;
        if($request->hasFile('image')){
            $book->book_image_id = $book_image_id;
        }
        $book->date = $request->date;
        $book->author_id = $request->author_id;
        $book->number_pages = $request->number_pages;
        $book->save();
        $header = 'Uploaded file!';
        $message = "The file was uploaded";
        return view('dev.response', compact('header', 'message'));
    }

    public function container(){
    	$authors = Author::all()->where('status', NUll);
    	return view('dev.forms.store.container', compact('authors'));
    }

	public function containerPost(Request $request){
        
        $container = New GroupContainer;
        $container->user_id = auth()->user()->id;
        $container->name = $request->name;
        $container->description = $request->description;
        $container->weight = $request->weight;
        $container->save();

        // author in container table
        foreach($request->author as $a){
            $aic = New AuthorsInContainer;
            $aic->author_id = $a;
            $aic->group_container_id = $container->id;
            $aic->save();
        }
		
        $header = 'Container was created!';
        $message = "The container was created succesfully";
        return view('dev.response', compact('header', 'message'));
    }


}
