<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\User;
use Illuminate\Support\Facades\Crypt;

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


    public function validatePasswordRequest(Request $request){
		//You can add validation login here
		$user = User::where('email', '=', $request->email)
		    ->first();
	
		//Check if the user exists
		if ($user == Null) {
		    return redirect()->back()->withErrors(['email' => trans('el email de usuario no se encuentra')]);
		}
		//Create Password Reset Token
		DB::table('password_resets')->insert([
		    'email' => $request->email,
		    'token' => str_random(60),
		    'created_at' => Carbon::now()
		]);
		//Get the token just created above
		$tokenData = DB::table('password_resets')
		    ->where('email', $request->email)->first();
		$token = $tokenData->token . '?email=' . urlencode($user->email);
		return redirect()->route('password.reset', [$token]);
	}


    private function sendResetEmail($email, $token)
	{
	//Retrieve the user from the database
	$user = DB::table('users')->where('email', $email)->select('name', 'email')->first();
	//Generate, the password reset link. The token generated is embedded in the link
	// $link = 'https://'.auth()->user()->configuration->path.'.herokuapp.com/password/reset/' . $token . '?email=' . urlencode($user->email);
	$link = 'https://localhost/password/reset/' . $token . '?email=' . urlencode($user->email);
	    try {
        	Mail::send('email.test', ['token' => $link, 'email' => $email], function ($message)
	        {
	            $message->from ('feriodismo@gmail.com');
	            $message->to('fabiob1680@hotmail.com');
	            $message->subject('Reseteando Email');
	        });
	        return 'done';
	    } catch (\Exception $e) {
	        return $e;
	    }
	}

	public function resetPassword(Request $request)
	{
		$title = 'inventory';
	    //Validate input
	    $validator = Validator::make($request->all(), [
	        'email' => 'required|email|exists:users,email',
	        'password' => 'required|confirmed',
	        'token' => 'required' ]);

	    //check if payload is valid before moving on
	    if ($validator->fails()) {
	        return redirect()->back()->withErrors(['email' => 'Please complete the form']);
	    }
	    $password = $request->password;
		// Validate the token
	    $tokenData = DB::table('password_resets')
	    ->where('token', $request->token)->first();
		// Redirect the user back to the password reset request form if the token is invalid
	    if (!$tokenData) return view('auth.passwords.email', compact('title'));

	    $user = User::where('email', $tokenData->email)->first();
		// Redirect the user back if the email is invalid
	    if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);
		//Hash and update the new password
	    $user->password = \Hash::make($password);
	    $user->update(); //or $user->save();
	    //login the user immediately they change password successfully
	    // Auth::login($user);
	    //Delete the token
	    DB::table('password_resets')->where('email', $user->email)
	    ->delete();
	    return redirect()->route('warehouse.dashboard', ['pass']); 
	  

	}
	public function changePasswordInput($token){
		return view('auth.passwords.reset', compact('token', 'title'));
	}

}
