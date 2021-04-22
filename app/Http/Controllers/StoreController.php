<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Managment\EmailController;
use App\Http\Controllers\Managment\FileController;
use Illuminate\Http\Request;

use App\Book;
use App\Group;
use App\Author;
use App\Configuration;
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
    	return view('bahai.forms.store.group', compact('container', 'authors', 'books'));
    }
	public function groupPost(Request $request){
        $configuration = Configuration::select('send_created_a_study_group', 'validation_per_group_creation')->get()[0];
        $user = auth()->user();
        if($configuration->validation_per_group_creation == 1 && $user->email_validated == NULL){
                $header = "Sorry! We can't created a group this time";
                $message = "Please confirm your email please!";
                return view('auth.response', compact('header', 'message'));
        }
        // get how many groups where created by user
        $count = Group::where('host_id', auth()->user()->id)->count();
        $groups_per_host = Configuration::select('groups_per_host')->get()[0]->groups_per_host;
        if($count >= $groups_per_host){
            $header = 'Sorry!';
            $message = "You can't create a new group you reach the max amount of group per user";
            return view('auth.response', compact('header', 'message'));
        }

        
        // check by
        $file_methods = new FileController;
        $group = New Group;
        // Test the function when it have repeat
        $book = Book::find($request->book_id);

        $group->route = $file_methods->getUniqueRandom();        
        $group->name = $book->name;
        $group->description = $request->description;
        $group->url = $request->url;
        $group->book_id = $book->id;
        $group->host_comments = $request->host_comments;
        $group->host_id = auth()->user()->id;
        $group->max_size = $request->max_size;
        $group->group_container_id = $request->group_container_id;
        $group->save();

        // $at = New AvailableTime;
        // $at->start_at = date("Y:m:d h:i:s", strtotime( $request->start_at ));
        // $at->finish_at = date("Y:m:d h:i:s", strtotime( $request->finish_at ));
        // $at->day_of_week = $request->day_of_week;
        // $at->user_id = auth()->user()->id;
        // $at->group_id = $group->id;
        // $at->save();

        $participant = New GroupParticipant;
        $participant->user_id = auth()->user()->id;
        $participant->group_id = $group->id;
        $participant->status = 1;
        $participant->save();



        if($configuration->send_created_a_study_group == 1){
          $email = new EmailController;
          $email->GroupCreated($user, $group);
        }
        
        return redirect()->route('welcome');
    }
	public function author(){
    	return view('bahai.forms.store.author');
    }
	public function authorPost(Request $request){

        $author = New Author;
        $author->user_id = auth()->user()->id;
        $author->name = $request->name;
        $author->lastname = $request->lastname;
        // $author->date_of_birth = $request->date_of_birth;
        // $author->nationality = $request->nationality;
        $author->save();

        return redirect()->route('welcome');
      
    }


    public function book(){
    	// ALL THE VIEWS ITS GOING TO CHANGE WHEN WE START IMPLEMENT THE FRONT-END
    	$authors = Author::all()->where('status', NUll);
    	return view('bahai.forms.store.book', compact('authors'));
    }
    public function bookPost(Request $request){
        $file_methods = new FileController;
        if($request->hasFile('image')){
            $book_image_id = $file_methods->storeBookImage($request);
        }
        $book = New Book;
        $book->user_id = auth()->user()->id;
        $book->name = $request->name;
        // $book->description = $request->description;
        if($request->hasFile('image')){
            $book->book_image_id = $book_image_id;
        }
        // $book->date = $request->date;
        $book->author_id = $request->author_id;
        // $book->number_pages = $request->number_pages;
        $book->save();
        return redirect()->route('welcome');
    }

    public function container(){
    	$authors = Author::all()->where('status', NUll);
    	return view('bahai.forms.store.container', compact('authors'));
    }

	public function containerPost(Request $request){
        
        $container = New GroupContainer;
        $container->user_id = auth()->user()->id;
        $container->name = $request->name;
        $container->description = $request->description;
        $container->weight = $request->weight;
        $container->save();

        // author in container table
        $authors = array_unique($request->author);
        foreach($authors as $a){
            if($a != 'null'){
                $aic = New AuthorsInContainer;
                $aic->author_id = $a;
                $aic->group_container_id = $container->id;
                $aic->save();
            }
        }
		
        return redirect()->route('welcome');
        
    }


}
