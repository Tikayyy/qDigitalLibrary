<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;

class AuthController extends Controller
{
    public function create(RegisterRequest $request)
    {
        try {
            User::create($request->all());
            return redirect()->route('login')->withInput(['email' => $request->get('email')])->with('success', 'Successful, please log in');
        } catch (Exception $e) {
            return redirect()->route('register')->withErrors($e->getMessage())->withInput($request->all());
        }
    }
}
