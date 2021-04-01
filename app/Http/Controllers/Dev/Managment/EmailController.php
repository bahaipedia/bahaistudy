<?php

namespace App\Http\Controllers;
use App\User
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function __construct(){
        $this->middleware('authorization');
	}
	public function StepDownHost($user, $group){
        $send = User::select('email', 'notifications', 'role')->where('notifications', !NULL)->where('role', 1)->get();
		try {
          Mail::send('email.notification.stepdownhost', ['user' => $user, 'group' => $group], function ($message) use ($send)
            {
                $message->from ('metafoodincorporated@gmail.com');
                foreach($send as $s){
                  $message->to($s->email);
                }
                $message->subject('Notification');
            });
        } catch (\Exception $e) {
            return $e;
        }
	}
}
