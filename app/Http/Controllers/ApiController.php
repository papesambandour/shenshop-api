<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAuthRequest;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiController extends Controller
{
    public $loginAfterSignUp = true;

    public function register(RegisterAuthRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => 0,
                "token"=>'null',
                'message' => 'Invalid Email or Password',
            ], 200);
        }

        return response()->json([
            'success' => 1,
            'token' => $jwt_token,
            'message' => 'Success authentification'
        ]);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                "token" => "",
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => 0,
                "token" => "",
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function getAuthUser(Request $request)
    {

        $user = JWTAuth::authenticate();
        $userDto = new \stdClass() ;
        $userDto->email = $user->email;
        $userDto->name = $user->name ;
        $userDto->token = JWTAuth::fromUser($user);
        $userDto->password = "" ;

        return response()->json(['user' => $userDto]);
    }
}
