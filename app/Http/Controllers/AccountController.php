<?php

namespace notes\Http\Controllers;

use Illuminate\Http\Request;
use \notes\User as User;
use \Hash as Hash;
use \Auth as Auth;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function account()
    {
        
        return view('settings.account');
    }

    public function updateAccount(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

    	$userId = Auth::user()->id;

        // Check if current password is correct
        $user = User::find($userId);
        if (!Hash::check($request->password, $user->password)) {
            return back()->withInput()->withErrors(['password' => 'The password doesn\'t match our records.']);
        }

		$user->email = $request->email;
	    $user->save();
		
        return back()->withInput()->withSuccess('You have successfully changed your password');
    }

    public function destroyAccount(Request $request)
    {
        if (isset($request->fields[0]['db'])) {
            $fields = $request->fields[0];
           	$user = Auth::user();
            if (isset($fields['value']) && $user->email == $fields['value']) {
                $user->delete();
                return response()->json(array('success' => true, 'message' => 'record deleted'));
            }
            return response()->json(array('success' => false, 'error' => [['field' => 0, 'message' => 'The email address does not match our records']]));
        }
        return response()->json(array('success' => false, 'message' => 'field not found'));
    }

    public function password()
    {
        return view('settings.password');
    }

    public function updatePassword(Request $request)
    {
    	$this->validate($request, [
            'password' => 'required|min:6',
            'new_password' => 'required|min:6|confirmed',
        ]);

    	$userId = Auth::user()->id;

        // Check if current password is correct
        $user = User::find($userId);
        if (!Hash::check($request->password, $user->password)) {
            return back()->withInput()->withErrors(['password' => 'The password doesn\'t match our records.']);
        }

		$user->password = Hash::make($request->new_password);
        $user->save();
		
        return back()->withInput()->withSuccess('You have successfully changed your password');
    }

    public function api() {
        return view('settings.api');
    }
}
