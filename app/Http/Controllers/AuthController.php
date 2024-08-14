<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request){
        validator($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required']
        ])->validate();

        if(Auth::attempt($request->only(['email', 'password']))){
            return redirect('/products');
        }

        return redirect()->back()->withErrors(['email' => 'Información incorrecta']);
    }

    public function register(Request $request){
        validator($request->all(), [
            'firstName' => ['required'],
            'lastName' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required']
        ])->validate();

        $user = User::select()->where('email', '=', $request->email)->first();

        if($user)
            return redirect()->back()->withErrors(['email' => 'Este correo ya se encuentra registrado']);

        User::insert([
            'name' => $request->firstName .' '.$request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'remember_token' => Str::random(10)
        ]);

        return redirect('/products');
    }

    function close_sesion(){
        Auth::logout();
        return redirect('/login');
    }
}
