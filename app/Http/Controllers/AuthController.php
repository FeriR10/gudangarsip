<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \App\Models\User;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }
    public function postregister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        // insert user
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = "user";
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('/')->with('sukses', 'Registes sukses');
    }
    public function login()
    {
        return view('login');
    }

    public function postlogin(Request $request)
    {
        $login = $request->only('email', 'password');
        if (Auth::attempt($login)){
            $user = Auth::User();
            
            if($user->role == 'admin'){
                return redirect('/dashboardAdmin');
            }
            if($user->role == 'user'){
                return redirect('/dashboardUser');
            }
        }
        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
