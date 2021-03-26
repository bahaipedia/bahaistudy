<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\LogsSteppedDownHost;
use App\GroupParticipant;
use App\LogsGroupParticipant;
use App\AvailableTime;
use App\User;

use App\Group;



class GroupController extends Controller
{
    public function __construct(){
    	// $this->middleware('authorization');
	}
    public function dashboard($title, $id = NULL){
      $weekday =  ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
      $group = Group::where('route', $id)->first();
      if($group->status !== NULL){
      	$header = 'Sorry but this group was deleted!';
        $message = "Contact the website admin for more information";
        return view('auth.response', compact('header', 'message'));
      }
    
      $at = AvailableTime::where('group_id', $group->id)->get();
      $participants = GroupParticipant::where('group_id', $group->id)->where('status', 1)->get();
      $group->participants_count = GroupParticipant::where('group_id', $group->id)->where('status', 1)->count();
      if(auth()->check()){
        $group->is_participant = GroupParticipant::where('user_id', auth()->user()->id)
        ->where('group_id', $group->id)
        ->where('status', 1)->count();

        $last_online_at = GroupParticipant::select('id', 'last_online_at')->where('user_id', auth()->user()->id)
        ->where('group_id', $group->id)->first();

        if($last_online_at !== NUll){
          $last_online_at->last_online_at = Carbon::now();
          $last_online_at->update();
        }
      }
      else{
        $participants->is_participant = 'Not auth';
      }
      return view('bahai.group.dashboard', compact('group', 'participants', 'at', 'weekday'));
    }

    
    public function chat($title, $id = NULL){
      return view('bahai.group.chat');
    }

    public function stepdown(Request $request){

	    $group = Group::where('id', $request->id)->select('id', 'host_id', 'route')->first();
      $group->title_route = str_replace(' ', '-', str_replace('/', ' ', str_replace('#', 'n', $group->book->name)));
	    if(auth()->user()->id == $group->host_id){
	    	$group->host_id = NULL;
	    	$group->update();

	    	$log = New LogsSteppedDownHost;
	     	$log->user_id = auth()->user()->id;
	    	$log->group_id = $group->id;
	    	$log->action = 1;

	    	$log->save();
	    }
     	return redirect()->route('group.dashboard', [$group->title_route, $group->route]);

    }
    public function stepup(Request $request){

	    $group = Group::where('id', $request->id)->select('id', 'host_id', 'route')->first();
	    if(auth()->user()->email_validated != NULL){
	    	$group->host_id = auth()->user()->id;
	    	$group->update();

	    	$log = New LogsSteppedDownHost;
	     	$log->user_id = auth()->user()->id;
	    	$log->group_id = $group->id;
	    	$log->action = 0;

	    	$log->save();
	    }

     	return redirect()->route('group.dashboard', [$group->route]);
    }

    // THE RULE IS USER LEAVE STATUS ON GROUP PARTICIPANT IS IS JOIN 1 WE HAVE ONLY ONE ROW FOR JOIN SO THE LOGIC VALIDATE IF THE ROW EXIST (UPDATE)
    // AND IF NOT IT WILL CREATE ONE (INSERT)
    public function leave(Request $request){

	    $group = Group::where('id', $request->id)->select('id', 'host_id', 'route')->first();
	    $g_participant = GroupParticipant::where('group_id', $request->id)->where('user_id', auth()->user()->id)->first();
	    $g_participant->status = 0;
	    $g_participant->update();

  		$log = New LogsGroupParticipant;
  		$log->user_id = auth()->user()->id;
  		$log->group_id = $request->id;
  		$log->action = 1;
  		$log->reason = NULL;
  		$log->save();

     	return redirect()->route('group.dashboard', [$group->route]);
    }

    

    public function join(Request $request){

	    $group = Group::where('id', $request->id)->select('id', 'host_id', 'book_id', 'route')->first();
      $group->title_route = str_replace(' ', '-', str_replace('/', ' ', str_replace('#', 'n', $group->book->name)));
	    $g_participant = GroupParticipant::where('group_id', $request->id)->where('user_id', auth()->user()->id)->first();
	    if($g_participant == NULL){
	    	$participant = New GroupParticipant;
	        $participant->user_id = auth()->user()->id;
	        $participant->group_id = $group->id;
	        $participant->status = 1;
	        $participant->save();
	    }
	    else{
	    	$g_participant->status = 1;
	    	$g_participant->update();
	    }

  		$log = New LogsGroupParticipant;
  		$log->user_id = auth()->user()->id;
  		$log->group_id = $request->id;
  		$log->action = 0;
  		$log->reason = NULL;
  		$log->save();

      return redirect()->route('group.chat', [$group->title_route, $group->route]);
     	
    }

    public function apiParticipant($id){
    	try{
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return 'API-E0001';
        }
      	$participants = GroupParticipant::where('group_id', $id)->where('status', 1)->get()->pluck('user_id');
      	$beat = GroupParticipant::select('id', 'last_online_at')->where('group_id', $id)->where('status', 1)->get();
      	$users = User::select('id', 'name', 'lastname')->whereIn('id', $participants)->get();
      	$host = Group::select('host_id')->where('id', $id)->first();
        $data = [$host, $users, $beat];
        return $data;
    }

    public function apiBeat(Request $request){
    	try{
            $id = Crypt::decryptString($request->id);
            $group_id = Crypt::decryptString($request->group_id);
        } catch (DecryptException $e) {
            return 'API-E0002';
        }
   		$last_online_at = GroupParticipant::select('id', 'last_online_at')->where('user_id', $id)->where('group_id', $group_id)->first();
		if($last_online_at !== NUll){
			$last_online_at->last_online_at = Carbon::now();
			$last_online_at->update();
		}
    	$last_online_at->update();
    	return 'done';
    }

   
}
