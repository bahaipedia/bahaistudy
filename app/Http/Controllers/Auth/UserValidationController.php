<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


use App\User;
use App\PasswordReset;


class UserValidationController extends Controller
{
    public function __construct(){
        $this->middleware('authorization');
	}

	// Method for validate the user;
	// Method that send the email for validate the user email
    function confirmEmail(){
    	$user = auth()->user();
    	Mail::send('email.confirm', ['user' => $user], function ($message)
        {
            $message->from ('metafoodincorporated@gmail.com');
            $message->to(auth()->user()->email);
            $message->subject('Welcome to Bahai - Please confirm email');

        });
    	return view('auth.confirm');
    }

    // Method for change status on email_validated;
    function confirmEmailStatus($id){
    	try{
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return 'E-C0001';
        }
        if(auth()->user()->id == $id){
        	$user = User::find(auth()->user()->id);
        	$user->email_validated = 1;
        	$user->update();
        	return redirect()->route('welcome');
        }
        else{
            return 'E-SMTP0001';
        }
    }

    // Method for change status on email_validated;
    function deconfirmEmailStatus($id){
    	try{
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return 'E-C0001';
        }
        if(auth()->user()->id == $id){
        	$user = User::find(auth()->user()->id);
        	$user->email_validated = 0;
        	$user->update();
        	return redirect()->route('welcome');
        }
        else{
            return 'E-SMTP0001';
        }
    }


    // Methods for password change
    // Method for validate user email and generate the token
    public function validatePasswordRequest(Request $request){
		$user = User::where('email', '=', $request->email)->first();
		if ($user == NULL) {
		    return redirect()->back()->withErrors(['email' => trans('el email de usuario no se encuentra')]);
		}

		$generateToken = str_random(60);
		DB::table('password_resets')->insert([
		    'email' => $request->email,
		    'token' => $generateToken,
		    'created_at' => Carbon::now()
		]);
		$token = $generateToken . '?email=' . urlencode($user->email);
		return redirect()->route('auth.reset.password.send', [$user->email, $token]);
	}

    public function sendResetEmail($email, $token)
	{
	
		$user = User::where('email', $email)->select('name', 'email')->first();
	    try {
	    	Mail::send('email.password.reset', ['token' => $token, 'email' => Crypt::encryptString($email), 'user' => $user], function ($message) use ($user)
	        {
	            $message->from ('metafoodincorporated@gmail.com');
	            $message->to($user->email);
	            $message->subject('Email reset');
	        });
	        $header = 'The email was sended!';
	        $message = "Please check your email to reset your password!";
			return view('auth.response', compact('header', 'message'));
	    } catch (\Exception $e) {
	        return $e;
	    }
	}
	public function resetPassword(Request $request)
	{

	    $validator = Validator::make($request->all(), [
	        'email' => 'required|email|exists:users,email',
	        'token' => 'required' ]);

	    if ($validator->fails()) {
	        return redirect()->back()->withErrors(['email' => 'Please complete the form']);
	    }
	   
	    if ($request->email !== substr($request->valemail,0,-1)){
	    	$header = 'Something went wrong with the password reset';
	        $message = "We couldn't confirm your email";
			return view('auth.response', compact('header', 'message'));
	    }
	   
	    $tokenData = PasswordReset::where('token', substr($request->token,0,-1))->first();
	    
	    if (!$tokenData) return view('auth.password.form');
	    
	    PasswordReset::where('email', $request->email)->delete();
	    $user = User::where('email', $request->email)->get()[0];

	    if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);

	    $password = $request->password;

	    $user->password = \Hash::make($password);
	    $user->update();

	    Auth::login($user);
	    
	    return redirect()->route('welcome'); 
	}

	public function changePasswordInput($email, $token){
		
		$email = Crypt::decryptString($email);
		$tokenVal = PasswordReset::where('email', $email)->orderBy('id','desc')->first()->token;
		if($token == $tokenVal){
			return view('auth.password.reset', compact('email', 'token'));
		}
		else{
			$header = 'Something went wrong with the password reset';
	        $message = "Please try again!";
			return view('auth.response', compact('header', 'message'));
		}
	}

	public function changePasswordEmailInput(){
		return view('auth.password.form');
	}

}
