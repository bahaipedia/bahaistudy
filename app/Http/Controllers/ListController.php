<?php

namespace App\Http\Controllers;

use App\Book;
use App\Author;
use App\GroupContainer;
use App\AuthorsInContainer;

use Illuminate\Http\Request;

class ListController extends Controller
{
    public function __construct(){
    	$this->middleware('authorization');
	}

	public function authors(){
		$authors = Author::select('id', 'name', 'lastname')->get();
   		return view('dev.lists.authors', compact('authors'));
    }

    public function books(){
		$books = Book::select('id', 'name')->get();
   		return view('dev.lists.books', compact('books'));
    }

    public function containers(){
		$containers = GroupContainer::select('id', 'name', 'weight')->get();
		$aic = AuthorsInContainer::all();
   		return view('dev.lists.containers', compact('containers', 'aic'));
    }
}
