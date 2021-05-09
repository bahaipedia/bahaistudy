<?php

namespace App\Http\Controllers\Managment;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;

class EmailController extends Controller
{
    public function __construct(){
        $this->middleware('authorization');
	}

    // STEP DOWN EMAIL NOTIFICATION METHOD
	public function StepDownHost($user, $group){
        $send = User::select('email', 'notifications', 'role')->where('notifications', !NULL)->where('role', 1)->get();
		try {
          Mail::send('email.notification.stepdownhost', ['user' => $user, 'group' => $group], function ($message) use ($send)
            {
                $message->from ('metafoodincorporated@gmail.com');
                foreach($send as $s){
                  $message->to($s->email);
                }
                $message->subject('Host was Stepped Down');
            });
        } catch (\Exception $e) {
            return $e;
        }
	}
    
    // GROUP CREATED NOTIFICATION METHOD
	public function GroupCreated($user, $group){
        $send = User::select('email', 'notifications', 'role')->where('notifications', !NULL)->where('role', 1)->get();
		try {
          Mail::send('email.notification.groupcreated', ['user' => $user, 'group' => $group], function ($message) use ($send)
            {
                $message->from ('metafoodincorporated@gmail.com');
                foreach($send as $s){
                  $message->to($s->email);
                }
                $message->subject('Group was Created');
            });
        } catch (\Exception $e) {
            return $e;
        }
	}

    // GROUP CREATED NOTIFICATION METHOD
	public function newUser($user){
        $send = User::select('email', 'notifications', 'role')->where('notifications', !NULL)->where('role', 1)->get();
		try {
          Mail::send('email.notification.userregistered', ['user' => $user], function ($message) use ($send)
            {
                $message->from ('metafoodincorporated@gmail.com');
                foreach($send as $s){
                  $message->to($s->email);
                }
                $message->subject('User was registered');
            });
        } catch (\Exception $e) {
            return $e;
        }
	}
}
