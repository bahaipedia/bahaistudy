<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;

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
    public function dashboard($id = NULL){
      $weekday =  ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
      $group = Group::where('route', $id)->first();
      $at = AvailableTime::where('group_id', $group->id)->get();
      $participants = GroupParticipant::where('group_id', $group->id)->where('status', 1)->get();
      $group->is_participant = GroupParticipant::where('user_id', auth()->user()->id)->where('group_id', $group->id)->where('status', 1)->count();
      return view('dev.group.dashboard', compact('group', 'participants', 'at', 'weekday'));
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
     	return redirect()->route('group.dashboard', [$group->route]);

    }
    public function stepup(Request $request){

	    $group = Group::where('id', $request->id)->select('id', 'host_id', 'route')->first();
	    if(auth()->user()->email_validated == 1){
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

    public function retire(Request $request){

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

     	return redirect()->route('group.dashboard', [$group->route]);
    }

    public function apiParticipant($id){
    	try{
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return 'API-E0001';
        }
      	$participants = GroupParticipant::where('group_id', $id)->where('status', 1)->get()->pluck('user_id');
      	$users = User::select('name', 'lastname')->whereIn('id', $participants)->get();
        return $users;
    }

}
