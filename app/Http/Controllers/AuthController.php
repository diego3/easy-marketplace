<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Jwt;
use App\User;

class AuthController extends Controller
{

    public function authenticate(Request $request){
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        $email     = $request->input('email'); 
        $password  = $request->input('password');

        $user = User::findByEmailAndPassword($email, $password);
        if(empty($user)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $token = Jwt::getToken($user->id);

        return response()->json(['token' => $token], 200);
    }
}
