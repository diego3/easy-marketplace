<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    
    
    public function token(Request $request)
    {     
       $name = $request->input('name');
       $email = $request->input('email');

       // user model get by name and email

       // jwt

       
    }
}
