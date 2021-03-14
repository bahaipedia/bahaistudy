<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\Configuration;
use App\Book;
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
        $containers = GroupContainer::select('id', 'name', 'weight')->orderBy('weight', 'desc')->limit(3)->get();
    	
        return view('welcome', compact('title', 'groups', 'containers'));
    }

}