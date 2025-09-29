<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
// use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $userData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:1',
        ]);

        if ($userData->fails()) {
            return response()->json([
                'success' => false,
                'statusCode' => 422,
                'message' => 'Validation error.',
                'data' => $userData->errors(),
            ], 422);
        }

        $request['email_verified_at'] = now();
        $user = User::create($request->all());

        $tokenResult = $user->createToken('API Token');
        $accessToken = $tokenResult->accessToken;

        return response()->json([
            'success' => true,
            'statusCode' => 201,
            'message' => 'User has been registered successfully.',
            'data' => [
                'user' => $user,
                'token' => [
                    'access_token' => $accessToken,
                    'token_type' => 'Bearer',
                    'expires_at' => $tokenResult->token->expires_at,
                ]
            ]
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

           $tokenResult = $user->createToken('API Token');
           $accessToken = $tokenResult->accessToken;

            $user['token'] = $accessToken;

            return response()->json([
                'success' => true,
                'statusCode' => 200,
                'message' => 'User has been logged successfully.',
                'data' => $user,
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'statusCode' => 401,
                'message' => 'Unauthorized.',
                'errors' => 'Unauthorized',
            ], 401);
        }
    }

    public function test(Request $request){
        return response()->json([
            'success' => true,
            'statusCode' => 200,
            'message' => 'Test',
            'data' => $request->all(),
        ], 200);
    }
}
