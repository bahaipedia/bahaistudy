<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;

use Carbon\Carbon;
use App\Http\Controllers\Managment\EmailController;

use Illuminate\Http\Request;
use App\LogsSteppedDownHost;
use App\GroupParticipant;
use App\LogsGroupParticipant;
use App\Configuration;
use App\AvailableTime;
use App\User;
use App\Message;

use App\Group;



class GroupController extends Controller
{
    public function __construct(){
    	// $this->middleware('authorization');
    }


    // THIS METHOD IS FOR CONTRUCT ALL RELATED FOR THE GROUP DASHBOARD VIEW
    // $title = route string from group table
    // $id = group id
    public function dashboard($title, $id = NULL){

      // Weekday array for available time string
      $weekday =  ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];

      // Group query from id
      $group = Group::where('route', $id)->first();

      // This is the group active/remove validator ***DEPRECATED***
      if($group->status !== NULL){
      	$header = 'Sorry but this group was deleted!';
        $message = "Contact the website admin for more information";
        return view('auth.response', compact('header', 'message'));
      }
    
      // Objects querys from database
      $at = AvailableTime::where('group_id', $group->id)->get();
      $participants = GroupParticipant::where('group_id', $group->id)->where('status', 1)->get();
      $group->participants_count = GroupParticipant::where('group_id', $group->id)->where('status', 1)->count();
      
      // This validitor indicate if the user is authentifacte also get the last_online_at from group participant table
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

      // This validator check if group is active/remove or the book is active/remove
      if($group->status != NULL || $group->book->status != NULL){
        $header = 'Sorry this group not longer exist!';
        $message = "We are unable to render this group because its not longer exist";
        return view('auth.response', compact('header', 'message'));
      }
      // ***DEPRECATED***
      else{
        $participants->is_participant = 'Not auth';
      }

      return view('bahai.group.dashboard', compact('group', 'participants', 'at', 'weekday'));
    }

    // THIS METHOD IS FOR CHAT RENDER ***DEPRECATED***
    public function chat($title, $id = NULL){
      $group = Group::where('route', $id)->first();
      $groups = Group::where('group_container_id', $group->group_container_id)->where('status', NULL)->get();
      $messages = Message::all()->where('edited', NULL)->where('delete', NULL)->where('group_id', $group->id);
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
      return view('bahai.group.chat', compact('messages', 'participants', 'group', 'groups'));
    }


    // THIS METHOD IS FOR STEPDOWN HOST FROM GROUP
    public function stepdown(Request $request){
      // Check if the configuration indicate send email for this action
      $configuration = Configuration::select('send_host_stepped_down')->get()[0];

      // Query from 'id' request body the group wich the host is steped down
      $group = Group::where('id', $request->id)->select('id', 'host_id', 'route', 'book_id', 'name')->first();
      
      // Check if this action was triggered by the host of this group
      if(auth()->user()->id == $group->host_id){
        $group->host_id = NULL;
        $group->update();
        // Log insert logic
        $log = New LogsSteppedDownHost;
        $log->user_id = auth()->user()->id;
        $log->group_id = $group->id;
        $log->action = 1;
        $log->save();
        $user = auth()->user();
        // Send the email validator
        if($configuration->send_host_stepped_down == 1){
          $email = new EmailController;
          $email->StepDownHost($user, $group);
        }  
      }

      return redirect()->route('group.dashboard', [str_replace('/', ' ', str_replace('#', ' ', $group->book->name)), $group->route]);
    }

    // THIS METHOD IS NEW HOST IS IN STEPUP IN GROUP
    public function stepup(Request $request){

    // Query from 'id' request body the group wich the host is steped up
    $group = Group::where('id', $request->id)->select('id', 'host_id', 'route', 'book_id')->first();

      // Check if this user have the email validated for the being the host process
      if(auth()->user()->email_validated != NULL){
        $group->host_id = auth()->user()->id;
        $group->update();
        // Log insert logic
        $log = New LogsSteppedDownHost;
        $log->user_id = auth()->user()->id;
        $log->group_id = $group->id;
        $log->action = 0;
        $log->save();
      }

      return redirect()->route('group.dashboard', [str_replace('/', ' ', str_replace('#', ' ', $group->book->name)), $group->route]);
    }

    // THIS METHOD IS FOR USER LEAVE THE GROUP
    public function leave(Request $request){
      // THE RULE IS USER LEAVE STATUS ON GROUP PARTICIPANT IS IS JOIN 1 WE HAVE ONLY ONE ROW FOR JOIN SO THE LOGIC VALIDATE IF THE ROW EXIST (UPDATE)
      // AND IF NOT IT WILL CREATE ONE (INSERT)

      // Query from 'id' request body the group wich the user is leaving
      $group = Group::where('id', $request->id)->select('id', 'host_id', 'route', 'book_id')->first();
      $g_participant = GroupParticipant::where('group_id', $request->id)->where('user_id', auth()->user()->id)->first();
      $g_participant->status = 0;
      $g_participant->update();
      // Log logic
      $log = New LogsGroupParticipant;
      $log->user_id = auth()->user()->id;
      $log->group_id = $request->id;
      $log->action = 1;
      $log->reason = NULL;
      $log->save();
      return redirect()->route('group.dashboard', [str_replace('/', ' ', str_replace('#', ' ', $group->book->name)), $group->route]);
    
    }

    
    // THIS METHOD IS FOR USER JOINING THE GROUP
    public function join(Request $request){

      // Query from 'id' request body the group wich the user is joinig
	    $group = Group::where('id', $request->id)->select('id', 'host_id', 'book_id', 'route', 'max_size')->first();
      $group->title_route = str_replace(' ', '-', str_replace('/', ' ', str_replace('#', 'n', $group->book->name)));
	    $g_participant = GroupParticipant::where('group_id', $request->id)->where('user_id', auth()->user()->id)->first();
      $group->participants_count = GroupParticipant::where('group_id', $group->id)->where('status', 1)->count();
      
      // Check if the group reached the max size if not the user can join the group
      if($group->max_size - $group->participants_count < 1){        
        $header = 'Sorry you was unable to join the group';
        $message = "Max number of participants reached!";
        return view('dev.response', compact('header', 'message'));
      }

      // Check if have a registered data from this user in this group
	    if($g_participant == NULL){
        // If dont have registered data we create one
        $participant = New GroupParticipant;
        $participant->user_id = auth()->user()->id;
        $participant->group_id = $group->id;
        $participant->status = 1;
        $participant->save();
	    }
	    else{
        // Else we update the data
	    	$g_participant->status = 1;
	    	$g_participant->update();
	    }

      // Log logic
  		$log = New LogsGroupParticipant;
  		$log->user_id = auth()->user()->id;
  		$log->group_id = $request->id;
  		$log->action = 0;
  		$log->reason = NULL;
  		$log->save();

       return redirect()->route('group.dashboard', [str_replace('/', ' ', str_replace('#', ' ', $group->book->name)), $group->route]);
     	
    }

    // API METHOD FOR CHECK THE ONLINE STATUS OF PARTICIPANTS
    public function apiParticipant($id){
      try{
          $id = Crypt::decryptString($id);
      } catch (DecryptException $e) {
          return 'API-E0001';
      }
      $participants = GroupParticipant::where('group_id', $id)->where('status', 1)->get()->pluck('user_id');
      $beat = GroupParticipant::select('id', 'user_id', 'last_online_at')->where('group_id', $id)->where('status', 1)->get();
      $users = User::select('id', 'name', 'lastname')->whereIn('id', $participants)->get();
      $host = Group::select('host_id')->where('id', $id)->first();
      $data = [$host, $users, $beat];
      return $data;
    }

    // API METHOD FOR CHECK THE ONLINE STATUS OF PARTICIPANTS
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

    // API METHOD TO RENDER VIA AJAX POLL REQUEST THE MESSAGES OF THE GROUP
    public function apiMessagePoll($id, $t = NULL){
      // take the time in the query to sessiostorage.
      if(auth()->check() !== NULL && $t != NULL){
        $user_id = auth()->user()->id;
        $message = Message::select('user_id', 'id' ,'message', 'created_at')->where('group_id', $id)->where('user_id', '!=', $user_id)->where('created_at', '>', Carbon::createFromTimestampMs($t)->format('Y-m-d h:i:s'))->get();
      }else{
        $message = Message::select('user_id', 'id' ,'message')->where('group_id', $id)->get();
      }
      $a = array();
      foreach($message as $m){
        $m->user_info = $m->user->name.' '.$m->user->lastname;
        if(auth()->user() && $m->user_id == auth()->user()->id){
          $m->self = 'self';
        }
        else{
          $m->self = 'other';
        }
        if($t != NULL && $m->created_at->timestamp > $t){
          array_push($a, $m);
        }
        if($t == NULL){
          array_push($a, $m);
        }
      }
      return $a;
    }

   
}
