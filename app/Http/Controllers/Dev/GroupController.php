<?php

namespace App\Http\Controllers\Dev;

use Illuminate\Support\Facades\Crypt;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\LogsSteppedDownHost;
use App\GroupParticipant;
use App\LogsGroupParticipant;
use App\AvailableTime;
use App\User;
use App\Message;


use App\Group;
// IN LINKED ROUTES GROUP
// WELCOME AND CONTAINERS LIST
// ALSO IN GROUP DASHBOARD


class GroupController extends Controller
{
    public function __construct(){
    	// $this->middleware('authorization');
	}
  // THIS FUNCTION WAS EDITED
    public function dashboard($title, $id = NULL){
      $weekday =  ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
      $group = Group::where('route', $id)->first();
      if($group->status !== NULL){
      	$header = 'Sorry but this group was deleted!';
        $message = "Contact the website admin for more information";
        return view('dev.response', compact('header', 'message'));
      }
    
      $at = AvailableTime::where('group_id', $group->id)->get();
      $participants = GroupParticipant::where('group_id', $group->id)->where('status', 1)->get();
      $messages = Message::all()->where('edited', NULL)->where('delete', NULL)->where('group_id', $group->id);
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
      return view('dev.group.dashboard', compact('group', 'participants', 'at', 'weekday', 'messages'));
    }


    public function stepdown(Request $request){

	    $group = Group::where('id', $request->id)->select('id', 'host_id', 'route')->first();
	    if(auth()->user()->id == $group->host_id){
	    	$group->host_id = NULL;
	    	$group->update();

	    	$log = New LogsSteppedDownHost;
	     	$log->user_id = auth()->user()->id;
	    	$log->group_id = $group->id;
	    	$log->action = 1;

	    	$log->save();
	    }
     	return redirect()->route('dev.group.dashboard', [$group->route]);

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

     	return redirect()->route('dev.group.dashboard', [$group->route]);
    }

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

     	return redirect()->route('dev.group.dashboard', [$group->route]);
    }
    public function join(Request $request){

	    $group = Group::where('id', $request->id)->select('id', 'host_id', 'route')->first();

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

     	return redirect()->route('dev.group.dashboard', [$group->route]);
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

    //THIS FUNCTION WAS EDITTED
    public function message(Request $request){
      try{
          $group_id = Crypt::decryptString($request->group_id);
      } catch (DecryptException $e) {
          return 'API-E0002';
      }
      $message = New Message;
      $message->user_id = auth()->user()->id;
      $message->message = $request->new_message;
      $message->group_id = $group_id;
      $message->save();
      $message->user_info = $message->user->name.' '.$message->user->lastname.' said: ';
      return $message;
    }
}
