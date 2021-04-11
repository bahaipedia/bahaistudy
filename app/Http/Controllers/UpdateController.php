<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Managment\FileController;

use Carbon\Carbon;

use App\User;
use App\Book;
use App\Group;
use App\Author;
use App\GroupContainer;
use App\AuthorsInContainer;
use App\GroupParticipant;
use App\AvailableTime;
use App\LogsGroupUpdate;
use App\LogsAuthorUpdate;
use App\LogsBookUpdate;
use App\LogsUserUpdate;

class UpdateController extends Controller
{
    public function __construct(){
        $this->middleware('authorization');
	}

    public function user($id){
        try{
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return 'UPD-E0003';
        }
     
        $user = User::find($id);
        return view('bahai.forms.update.user', compact('user'));
    }

    public function userUpdate(Request $request){
        try{
            $id = Crypt::decryptString($request->user_id);
        } catch (DecryptException $e) {
            return 'UPD-E0003';
        }

        $logs = New LogsUserUpdate;
        $logs->action = 0;
        $logs->user_id = auth()->user()->id;
        $logs->u_id = $id;
        $logs->save();

        $user = User::find($id);
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;

        if($request->notifications != NULL){
            $user->notifications = 1;
        }else{
            $user->notifications = 0;
        }
        
        $user->update();

        $header = 'User was updated!';
        $message = "The user was updated";

        return view('auth.response', compact('header', 'message'));
    }

    // Enable and disable method in UserValidationController is where the user delete method are

	public function group($id){
		try{
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return 'UPD-E0001';
        }
     
        $group = Group::find($id);
		$container = GroupContainer::select('id', 'name')->find($group->group_container_id);
		$authors = AuthorsInContainer::select('author_id')->where('group_container_id', $group->group_container_id)->get();
        $books = Book::whereIn('author_id', $authors->pluck('author_id'))->get();
		$containers = GroupContainer::select('id', 'name')->get();
        return view('bahai.forms.update.group', compact('container', 'containers', 'authors', 'books', 'group'));
    }

    public function groupUpdate(Request $request){
        try{
            $id = Crypt::decryptString($request->group_id);
        } catch (DecryptException $e) {
            return 'DD-E0001';
        }

        $logs = New LogsGroupUpdate;
        $logs->action = 0;
    	$logs->user_id = auth()->user()->id;
    	$logs->group_id = $id;
    	$logs->save();

    	$group = Group::find($id);
        // $group->name = $request->name;
        $group->description = $request->description;
        $group->url = $request->url;
        // $group->book_id = $request->book_id;
        $group->host_comments = $request->host_comments;
        $group->host_id = auth()->user()->id;
        $group->max_size = $request->max_size;
        $group->update();

        return redirect()->route('welcome');
    	
    }

    public function containerUpdate(Request $request){
        try{
            $id = Crypt::decryptString($request->container_id);
        } catch (DecryptException $e) {
            return 'DD-E0001';
        }

        // $logs = New LogsGroupUpdate;
        // $logs->action = 0;
        // $logs->user_id = auth()->user()->id;
        // $logs->group_id = $id;
        // $logs->save();
        $container = GroupContainer::find($id);
        $container->name = $request->name;
        $container->description = $request->description;
        $container->weight = $request->weight;
        
        $container->update();

        return redirect()->route('welcome');
       
    }
    public function apiGroup($id){
        try{
            $query_id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return 'UPD-E0002';
        }
        $group = Group::find($query_id);
        $group->crypt = $id;
        $group->author = $group->book->author->name. ' ' . $group->book->author->lastname;
        $group->book = NULL;
        return $group;
    }
    public function apiContainer($id){
        try{
            $query_id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return 'UPD-E0002';
        }
     
        $container = GroupContainer::find($query_id);
        $container->crypt = $id;
        return $container;
    }
    public function groupDelete(Request $request){
        try{
            $id = Crypt::decryptString($request->group_id);
        } catch (DecryptException $e) {
            return 'DD-E0001';
        }

        $logs = New LogsGroupUpdate;
        $logs->action = 1;
        $logs->user_id = auth()->user()->id;
        $logs->group_id = $id;
        $logs->save();
        $group = Group::find($id);
        $group->status = Carbon::now();
        $group->update();

        $header = 'Group was deleted!';
        $message = "The group was deleted";
        return view('auth.response', compact('header', 'message'));
    }

	public function author($id){
		try{
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return 'UPD-E0002';
        }
     
        $author = Author::find($id);
        return view('bahai.forms.update.author', compact('author'));
    }

    public function apiAuthor($id){
        try{
            $query_id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return 'UPD-E0002';
        }
     
        $author = Author::find($query_id);
        $author->crypt = $id;
        $author->date = date("Y-m-d", strtotime( $author->date_of_birth ));
        return $author;
    }

    public function authorUpdate(Request $request){
        try{
            $id = Crypt::decryptString($request->author_id);
        } catch (DecryptException $e) {
            return 'UPD-E0002';
        }

    	$logs = New LogsAuthorUpdate;
        $logs->action = 0;
    	$logs->user_id = auth()->user()->id;
    	$logs->author_id = $id;
    	$logs->save();

    	$author = Author::find($id);
    	$author->name = $request->name;
    	$author->lastname = $request->lastname;
    	$author->date_of_birth = $request->date_of_birth;
    	$author->nationality = $request->nationality;
    	$author->update();

        return redirect()->route('welcome');
    	
    }

      public function authorDelete(Request $request){
        try{
            $id = Crypt::decryptString($request->author_id);
        } catch (DecryptException $e) {
            return 'DD-E0002';
        }

        $logs = New LogsAuthorUpdate;
        $logs->action = 1;
        $logs->user_id = auth()->user()->id;
        $logs->author_id = $id;
        $logs->save();

        $author = Author::find($id);
        $author->status = Carbon::now();
        $author->update();

        $header = 'author was deleted!';
        $message = "The author was deleted";
        return view('auth.response', compact('header', 'message'));
    }

    public function book($id){
        try{
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return 'UPD-E0002';
        }
     
        $book = Book::find($id);
        $authors = Author::all()->where('status', NULL);

        return view('bahai.forms.update.book', compact('book', 'authors'));
    }

     public function apiBook($id){
        try{
            $query_id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return 'UPD-E0002';
        }
     
        $book = Book::find($query_id);
        $book->crypt = $id;
        $book->date = date("Y-m-d", strtotime( $book->date ));
    
        return $book;
    }

    public function bookUpdate(Request $request){
        try{
            $id = Crypt::decryptString($request->book_id);
        } catch (DecryptException $e) {
            return 'DD-E0002';
        }
        $logs = New LogsBookUpdate;
        $logs->action = 0;
        $logs->user_id = auth()->user()->id;
        $logs->book_id = $id;
        $logs->save();

        $book = Book::find($id);
        $book->name = $request->name;
        $book->description = $request->description;
        $book->date = $request->date;
        $book->author_id = $request->author_id;
        $book->number_pages = $request->number_pages;

        $file_methods = new FileController;
        if($request->hasFile('image')){
            $book_image_id = $file_methods->storeBookImage($request);
        }
        if($request->hasFile('image')){
            $book->book_image_id = $book_image_id;
        }

        $book->update();

        return redirect()->route('welcome');
    }

    public function bookDelete(Request $request){
        try{
            $id = Crypt::decryptString($request->book_id);
        } catch (DecryptException $e) {
            return 'DD-E0002';
        }

        $logs = New LogsBookUpdate;
        $logs->action = 1;
        $logs->user_id = auth()->user()->id;
        $logs->book_id = $id;
        $logs->save();

        $book = Book::find($id);
        $book->status = Carbon::now();
        $book->update();

        $header = 'book was deleted!';
        $message = "The book was deleted";
        return view('auth.response', compact('header', 'message'));
    }
}
