<?php

namespace App\Http\Controllers\Dev;

use App\User;
use App\Book;
use App\Group;
use App\Author;
use App\GroupContainer;
use App\GroupParticipant;
use App\AuthorsInContainer;
use App\AvailableTime;

use Illuminate\Http\Request;

class ListController extends Controller
{
    public function __construct(){
    	$this->middleware('authorization');
	}

	public function authors(){
		  $authors = Author::select('id', 'name', 'lastname')->where('status', NULL)->get();
   		return view('dev.lists.authors', compact('authors'));
    }

    public function books(){
		  $books = Book::select('id', 'name')->where('status', NULL)->get();
   		return view('dev.lists.books', compact('books'));
    }

    public function containers(){
      $weekday =  ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
		  $containers = GroupContainer::select('id', 'name', 'weight')->orderBy('weight', 'desc')->get();
		  $aic = AuthorsInContainer::all();
      $groups = Group::select('id', 'name', 'description', 'book_id', 'group_container_id', 'route')->where('status', NULL)->get();
      $at = AvailableTime::all();
   		return view('dev.lists.containers', compact('containers', 'aic', 'groups', 'at', 'weekday'));
    }

    public function users(){
      $users = User::all();
      return view('dev.lists.users', compact('users'));
    }

}
