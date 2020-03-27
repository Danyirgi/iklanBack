<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        try {
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json([
                    'logged'  =>  false,
                    'message' =>  'Invalid Email and Password'
                ]);
            }
        } catch(JWTException $e){
            return response()->json([
                'logged'   =>  false,
                'message'  =>  'Generate Token Failed'
            ]);
        }

        return response()->json([
            "logged"   => true,
            "token"    => $token,
            "message"  => "Login Berhasil"
        ]);
    }

	public function register(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'name'            => 'required|string|max:255',
			'email'           => 'required|string|email|max:255|unique:users',
            'password'        => 'required|string|min:6',
		]);

		if($validator->fails()){
			return response()->json([
				'status'	=> 0,
				'message'	=> $validator->errors()->toJson()
			]);
		}

		$user = new User();
        $user->name 	        = $request->name;
		$user->email 	        = $request->email;
        $user->password         = Hash::make($request->password);
		$user->save();

		$token = JWTAuth::fromUser($user);

		return response()->json([
			'status'	=> '1',
			'message'	=> 'User berhasil ter-registrasi'
		], 201);
	}
}
