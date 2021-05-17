<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function viewRegister(Request $request){
        return view('auth.register');
    }

    public function viewLogin(Request $request){
        return view('auth.login');
    }

    public function register(Request $request){

        $data = $request->all();
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|confirmed'
        ])->validate();

        $data['password'] = Hash::make($data['password']);

        User::create($data);
        return redirect()->route('lista.index');
    }

    public function login(Request $request){
        $data = $request->only('email', 'password');
        if(Auth::attempt($data)){
            return redirect()->route('lista.index');
        }
        return redirect()->back();
    }

    public function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('auth.register');
    }
}
