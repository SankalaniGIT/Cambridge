<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\storeUserRequest;
use App\Http\Controllers\Controller;
use App\User;


class NewRegisterController extends Controller
{
    public function userRegister()
    {
        return view('auth.newRegister');
    }

    public function postRegister(storeUserRequest $request){

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'userLevel' => $request->input('level'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect('userRegister')->with('error_code', 28);
    }

}
