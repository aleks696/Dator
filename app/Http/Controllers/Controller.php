<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function login(){
        if(Auth::check()){
            return redirect(route('profile'));
        }
        return view('login');
    }

    function registration(){
        if(Auth::check()){
            return redirect(route('profile'));
        }
        return view('registration');
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect(route('profile'));
        }
        return redirect(route('login'))->with("error", "Login data are not valid");
    }

    function registrationPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['full_name'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if(!$user){
            return redirect(route('registration'))->with("error", "Registration data are not valid, try again.");
        }
        return redirect(route('login'))->with("success", "Registration is successful.");
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }

    function profile(){
        return view('profile');
    }

}
