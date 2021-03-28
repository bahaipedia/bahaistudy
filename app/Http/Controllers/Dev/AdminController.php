<?php

namespace App\Http\Controllers\Dev;
use Illuminate\Support\Facades\Crypt;
use App\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LogsSteppedDownHost;
use App\GroupParticipant;
use App\LogsGroupParticipant;
use App\AvailableTime;
use App\User;
use App\Message;
use App\Group;

class AdminController extends Controller
{	
	public function __construct(){
        $this->middleware('authorization');
		// add role admin middleware
	}

    public function groupDrop(Request $request){
		try{
			$id = Crypt::decryptString($request->id);
		} catch (DecryptException $e) {
			return 'ADM-E0001';
		}
			$group = Group::where('id', $request->group_id)->select('id', 'host_id', 'route')->first();
			$g_participant = GroupParticipant::where('group_id', $request->group_id)->where('user_id', $id)->first();
			$g_participant->status = 0;
			$g_participant->update();
		if($id == $group->host_id){
			
			$group->host_id = NULL;
			$group->update();

			$log = New LogsSteppedDownHost;
			$log->user_id = auth()->user()->id;
			$log->group_id = $group->id;
			$log->action = 1;

			$log->save();
		}
			$log = New LogsGroupParticipant;
			$log->user_id = $id;
			$log->group_id = $request->group_id;
			$log->action = 1;
			$log->reason = auth()->user()->id;
			$log->save();
			return redirect()->route('dev.group.dashboard', [$group->route]);
	}

    public function messages(){
    	$messages = Message::select('user_id', 'message', 'group_id', 'created_at')->orderBy('created_at', 'desc')->limit(10)->get();
    	return view('dev.admin.messages', compact('messages'));
    }

    public function configurations(){
    	$configurations = Configuration::all()[0];
    	return view('dev.admin.configurations', compact('configurations'));
    }
    public function configurationsPost(Request $request){
    	$configurations = Configuration::all()[0];
    	$configurations->app_name = $request->app_name;
    	$configurations->app_description = $request->app_description;
    	$configurations->app_description_hight = $request->app_description_hight;
    	$configurations->app_description_low = $request->app_description_low;
    	$configurations->app_notes = $request->app_notes;
    	$configurations->groups_per_host = $request->groups_per_host;
    	$configurations->update();
    	return redirect()->route('welcome');
    }
    public function apiMessages($message){
    	if(str_contains($message, '%')){
    		return [];
    	}
    	$messages = Message::select('user_id', 'message', 'group_id', 'created_at')->orderBy('created_at', 'desc')->where('message', 'like', '%'.$message.'%')->get();
    	foreach($messages as $m){
    		$m->user_info = $m->user->name.' '.$m->user->lastname;
    		$m->group_name = $m->group->name;
    	}
    	return $messages;
    }
}
