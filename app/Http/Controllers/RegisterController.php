<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Privileges;

class RegisterController extends Controller
{
    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.register');
    }


    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $userid =  $user->id;
        $cForm = new Privileges();
        $cForm->userid = $userid;
        $cForm->privilege = "";
        $cForm->save();
        auth()->login($user);

        return redirect('/')->with('success', "Account successfully registered.");
    }
}