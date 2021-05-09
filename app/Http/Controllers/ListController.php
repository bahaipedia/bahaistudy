<?php

namespace App\Http\Controllers;

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

    // METHOD FOR RENDER AUTHORS ***DEPRECATED***  
    public function authors(){
      $authors = Author::select('id', 'name', 'lastname')->where('status', NULL)->get();
      return view('bahai.lists.authors', compact('authors'));
    }

    // METHOD FOR RENDER BOOKS ***DEPRECATED***  
    public function books(){
		  $books = Book::select('id', 'name')->where('status', NULL)->get();
   		return view('bahai.lists.books', compact('books'));
    }

    // METHOD FOR RENDER CONTAINERS ***DEPRECATED***  
    public function containers(){
      $weekday =  ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
		  $containers = GroupContainer::select('id', 'name', 'weight')->orderBy('weight', 'desc')->get();
		  $aic = AuthorsInContainer::all();
      $groups = Group::select('id', 'name', 'description', 'book_id', 'group_container_id', 'route')->where('status', NULL)->get();
      $at = AvailableTime::all();
   		return view('bahai.lists.containers', compact('containers', 'aic', 'groups', 'at', 'weekday'));
    }

    // METHOD FOR RENDER USERS  
    public function users(){
      $users = User::all();
      return view('bahai.lists.users', compact('users'));
    }

}
