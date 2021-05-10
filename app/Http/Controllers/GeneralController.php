<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\Configuration;
use App\Book;
use App\Author;

use App\AuthorsInContainer;
use App\Group;

use App\GroupParticipant;
use App\GroupContainer;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Managment\FileController;

class GeneralController extends Controller
{


	public function __construct(){
       
	}


    // THIS METHOD IS FOR RENDER THE VIEW AND ATTACH SOME JSON OBJETCTS FOR IT
    public function welcome(){
    	$title = Configuration::find(1)->app_name;
        // $groups = Group::select('id', 'name', 'description', 'book_id', 'group_container_id', 'route', 'max_size')->where('status', NULL)->get();

        // This object is the selection of group in active state on containers, filtering by authors
        $groups = Group::select('id', 'name', 'description', 'book_id', 'group_container_id', 'route', 'max_size')->whereHas('book', function ($query) {
            return $query->where('status', NULL)->whereHas('author', function ($query) {
                return $query->where('status', NULL);
            });
        })->where('status', NULL)->get();

        // This loop select the available slots y groups

        foreach($groups as $g){
            $participants = GroupParticipant::where('group_id', $g->id)->where('status', 1)->count();
            $g->available = $g->max_size - $participants;
        }

        // Objects querys from database
        $configurations = Configuration::all()->first();
        $authors = AuthorsInContainer::select('author_id', 'group_container_id')->get();
        $books = Book::whereIn('author_id', $authors->pluck('author_id'))->get();
        $containers = GroupContainer::select('id', 'name', 'weight', 'status')->where('status', NULL)->orderBy('weight', 'asc')->get();
        $authors_books = Author::select('id', 'name', 'lastname')->where('status', NULL)->get();

        // Check if user can create group or not
        // The user have to has validated email and not reached the max group per host ( this options can be changed in the configuration view ) 
        $create_group = false;
        if(auth()->check()){
            $count = Group::where('host_id', auth()->user()->id)->count();
            $groups_per_host = Configuration::select('groups_per_host')->get()[0]->groups_per_host;
            if($count < $groups_per_host && auth()->user()->email_validated !== NULL){
                $create_group = true;
            }
        }

        return view('welcome', compact('title', 'groups', 'containers', 'authors', 'authors_books', 'books', 'configurations', 'create_group'));
    }


    // THIS METHOD IS FOR QUERY AUTHORS BY CONTAINERS ID ( FOR GROUP CREATE FORM )
    public function apiContainerAuthor($id){
        // Author in container query from database
        $authors = AuthorsInContainer::select('author_id', 'group_container_id')->where('group_container_id', $id)->get();
        // Name and lastname author string concatenate
        foreach($authors as $a){
            $author = Author::select('id', 'name', 'lastname')->where('id', $a->author_id)->get()[0];
            $a->text = $author->name. ' ' .$author->lastname;
        }
        // Return the text string, the author_id, and the group_container_id by container id
        return $authors;
    }

    // THIS METHOD IS FOR QUERY BOOKS BY AUTHORS ID ( FOR GROUP CREATE FORM )
    public function apiAuthorBook($id){
        $books = Book::select('id', 'name')->where('author_id', $id)->get();
        return $books;
    }

}