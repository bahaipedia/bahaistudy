<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\Configuration;
use App\Book;

use App\AuthorsInContainer;
use App\Group;

use App\GroupParticipant;
use App\GroupContainer;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Managment\FileController;

class GeneralController extends Controller
{


	public function __construct(){
        $this->middleware('authorization');
	}
    public function welcome(){
    	$title = Configuration::find(1)->app_name;
        $groups = Group::select('id', 'name', 'description', 'book_id', 'group_container_id', 'route', 'max_size')->where('status', NULL)->get();
        foreach($groups as $g){
            $participants = GroupParticipant::where('group_id', $g->id)->where('status', 1)->count();
            $g->available = $g->max_size - $participants;
        }
        $configurations = Configuration::select('app_name', 'app_description', 'app_description_hight', 'app_description_low', 'app_notes')->get()->first();
        $authors = AuthorsInContainer::select('author_id', 'group_container_id')->get();
        $books = Book::whereIn('author_id', $authors->pluck('author_id'))->get();
        $containers = GroupContainer::select('id', 'name', 'weight')->orderBy('weight', 'desc')->limit(3)->get();
        return view('welcome', compact('title', 'groups', 'containers', 'authors', 'books', 'configurations'));
    }

    public function apiAuthorBook($id){
        $books = Book::select('id', 'name')->where('author_id', $id)->get();
        return $books;
    }

}