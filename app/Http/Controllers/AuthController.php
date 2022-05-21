<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private function checkAuth(){
        $token = request()->cookie('library-token');
        if(!$token){
            return false;
        }

        $user = User::where('remember_token', hash('md5', $token))->first();

        if(!$user){
            return false;
        }

        return true;
    }

    public function register(){
        if(self::checkAuth()) return redirect()->route('books.search');
        return view('pages.registration');
    }

    public function create(RegisterRequest $request){
        try{
            User::create($request->all());
            return redirect()->route('login')->withInput(['email' => $request->get('email')])->with('success', 'Successful, please log in');
        }
        catch (\Exception $e){
            return redirect()->route('register')->withErrors($e->getMessage())->withInput($request->all());
        }
    }

    public function login(){
        if(self::checkAuth()) return redirect()->route('books.search');
        return view('pages.login');
    }

    public function check(LoginRequest $request){
        $user = User::where('email', $request->get('email'))
            ->where('password', hash('md5', $request->get('password')))
            ->first();

        if(!$user){
            return redirect()->route('login')->withErrors('Email or password are wrong');
        }

        $token = Str::random(30);
        $user->remember_token = hash('md5', $token);
        $user->save();

        $next = session()->get('library.next');
        if($next){
            session()->forget('library.next');
            return redirect($next)->withCookie(cookie('library-token', $token));
        }

        return redirect()->route('books.search')->withCookie(cookie('library-token', $token));
    }
}
