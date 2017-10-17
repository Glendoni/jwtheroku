<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['login', 'store','create']]);
    }

    public function login(Request $request)
    {
        // Credentials to login to the user
        $credentials = $request->only('email', 'password');
  
      
        
        try {
            // si los datos de login no son correctos
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // si no se puede crear el token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // todo bien devuelve el token
        return response()->json(compact('token'));
    }
    
    public function test()
    {
        
        return response()->json(['yes' => 'could_not_create_token'], 200);
        
    }
    
      public function create(Request $request,Validator $validator,User $user)
    {
       $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required|alpha',
        ]);

         if ($validator->fails()) {
             //return response()->json($validator->errors()->all(), 402);
        }
           
          
          
        $user = new User;
          
           $user->name = $request->firstName;
       
        $user->email = $request->email;
       
        $user->password = $request->password;
          
          $user->save();
/*
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->permissions = 'a:1:{i:0;s:6:"a:0:{}";}';
        $user->activated = true;
        $user->enabled = true;
        $user->email = $request->email;
        $user->created_by_id = 1;
        $user->display_name = $request->username;
        $user->username = $request->username;
        $user->password = $request->password;
          
          */
        //
          
          //return response()->json(['success' => 'succesfully Registered'], 200); 
       return response()->json($request);
        
    }
    
        public function store(Request $request)
    {
        // Validate the request...

        $flight = new Flight;

        $flight->name = $request->name;

        $flight->save();
    }

    
}
