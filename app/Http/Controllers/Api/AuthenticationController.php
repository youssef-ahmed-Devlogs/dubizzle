<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $userData =  $request->validate([
            'name' => ['required', 'string', 'min:6'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone_number' => ['required', 'unique:users,phone_number'],
            'password' => ['required', 'min:8', 'confirmed'],
            'device_name' => ['nullable', 'string', 'max:255'],
        ]);

        unset($userData['device_name']);
        $userData['password'] = Hash::make($userData['password']);

        $user = User::create($userData);

        $token = $this->createToken($request, $user);

        return Response::json([
            'status' => 'success',
            'token' => $token->plainTextToken,
            'user' =>  new UserResource($user)
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required', 'min:8'],
            'device_name' => ['nullable', 'string', 'max:255'],
        ]);

        $user = User::where('email', $request->username)->orWhere('phone_number', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = $this->createToken($request, $user);

            return Response::json([
                'status' => 'success',
                'token' => $token->plainTextToken,
                'user' =>  new UserResource($user)
            ], 201);
        }

        return Response::json([
            'status' => 'fail',
            'message' => 'Invalid Credentials'
        ], 401);
    }

    public function authenticatedUser()
    {
        return Response::json([
            'status' => 'success',
            'user' => new UserResource(Auth::guard('sanctum')->user())
        ], 200);
    }

    public function accessTokens(Request $request)
    {
    }

    public function revokeCurrentToken()
    {
        $user = Auth::guard('sanctum')->user();
        $user->currentAccessToken()->delete();
        return Response::json(null, 204);
    }

    public function revokeTokens()
    {
        $user = Auth::guard('sanctum')->user();
        $user->tokens()->delete();
        return Response::json(null, 204);
    }

    public function revokeToken($token)
    {
        $user = Auth::guard('sanctum')->user();
        $personalAccessToken = PersonalAccessToken::findToken($token);

        if ($personalAccessToken->tokenable_id == $user->id && $personalAccessToken->tokenable_type == get_class($user))
            $personalAccessToken->delete();

        return Response::json(null, 204);
    }

    public function revokeTokensExcludeCurrent()
    {
        $user = Auth::guard('sanctum')->user();
        $user->tokens()->where('id', '!=',  $user->currentAccessToken()->id)->delete();
        return Response::json(null, 204);
    }

    private function createToken(Request $request, $user)
    {
        $device_name = $request->post('device_name', $request->userAgent());
        $token = $user->createToken($device_name);
        return $token;
    }
}
