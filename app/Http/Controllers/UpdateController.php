<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Book;
use App\Group;
use App\Author;
use App\GroupContainer;
use App\AuthorsInContainer;
use App\GroupParticipant;
use App\AvailableTime;
use App\LogsGroupUpdate;
use App\LogsAuthorUpdate;

class UpdateController extends Controller
{
    public function __construct(){
        $this->middleware('authorization');
	}

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
        return view('dev.forms.update.group', compact('container', 'containers', 'authors', 'books', 'group'));
    }

    public function groupUpdate(Request $request){
    	$logs = New LogsGroupUpdate;
    	$logs->user_id = auth()->user()->id;
    	$logs->group_id = $request->group_id;
    	$logs->save();

    	$group = Group::find($request->group_id);
        $group->name = $request->name;
        $group->description = $request->description;
        $group->url = $request->url;
        $group->book_id = $request->book_id;
        $group->host_comments = $request->host_comments;
        $group->host_id = auth()->user()->id;
        $group->max_size = $request->max_size;
        $group->update();

    	$header = 'Group was updated!';
        $message = "The group was updated";
        return view('auth.response', compact('header', 'message'));
    }



	public function author($id){
		try{
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return 'UPD-E0002';
        }
     
        $author = Author::find($id);
        return view('dev.forms.update.author', compact('author'));
    }

    public function authorUpdate(Request $request){
    	$logs = New LogsAuthorUpdate;
    	$logs->user_id = auth()->user()->id;
    	$logs->author_id = $request->author_id;
    	$logs->save();

    	$author = Author::find($request->author_id);
    	$author->name = $request->name;
    	$author->lastname = $request->lastname;
    	$author->date_of_birth = $request->date_of_birth;
    	$author->nationality = $request->nationality;
    	$author->update();

    	$header = 'Author was updated!';
        $message = "The author was updated";
        return view('auth.response', compact('header', 'message'));
    }
}
