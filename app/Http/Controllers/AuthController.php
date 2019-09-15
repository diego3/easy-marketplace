<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Jwt;
use App\User;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function authenticate(Request $request){
        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|email'
        ]);

        $name  = $request->input('name');
        $email = $request->input('email'); 

        $user = new \stdClass;
        $user->id = md5($name.$email);

        $token = Jwt::getToken($user->id);

        return response()->json(['token' => $token], 200);
    }
}
