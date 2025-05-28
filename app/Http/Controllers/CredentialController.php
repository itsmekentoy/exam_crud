<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class CredentialController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.custom-login');
    }
    public function login(Request $request)
    {
      //validate the inputs
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        //attempt to login checkif the credentials are correct using the hash password
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            //if the credentials are correct, redirect to the dashboard
            return redirect()->route('dashboard');
        }
        

        //if the credentials are incorrect
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);

        

        
    }
    public function showRegistrationForm()
    {
        return view('auth.custom-register');
    }
    public function register(Request $request)
    {
        //validate the inputs
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        //create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //login the user
        Auth::login($user);

        //redirect to dashboard route with success message
        return redirect()->route('dashboard')->with('success', 'Registration successful! Welcome, ' . $user->name);
    }
}
