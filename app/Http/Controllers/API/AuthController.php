<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => 'Validation Error',
                'data' => $validator->errors()->all()
            ]);
        }

        // Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Generate Token
        $response = [];
        $response['token'] = $user->createToken('Personal Access Token')->accessToken;
        $response['user'] = $user->name;
        $response['email'] = $user->email;

        return response()->json([
            'status' => 1,
            'message' => 'User registered successfully',
            'data' => $response
        ]);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            $response = [];
            $response['token'] = $user->createToken('Personal Access Token')->accessToken;
            $response['user'] = $user->name;
            $response['email'] = $user->email;

            return response()->json([
                'status' => 1,
                'message' => 'User logged in successfully',
                'data' => $response
            ]);

        }

        return response()->json([
            'status' => 0,
            'message' => 'Login failed',
            'data' => null
        ]);
    }

}
