<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public $user;

    public function __construct()
    {
        $this->user = Auth::guard('sanctum')->user();
    }

    public function update(Request $request)
    {
        $userData = $request->validate([
            'name' => ['sometimes', 'required', 'string'],
            'email' => ['sometimes', 'required', 'email', "unique:users,email,{$this->user->id}"],
            'phone_number' => ['sometimes', 'required', 'numeric', "unique:users,phone_number,{$this->user->id}"],
        ]);

        $this->user->update($userData);

        return Response::json([
            'status' => 'success',
            'user' => new UserResource($this->user)
        ], 200);
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'max:2048']
        ]);

        if (!$request->hasFile('avatar'))
            return Response::json([
                'status' => 'fail',
                'message' => 'Please upload a valid image.'
            ], 400);

        if ($this->user->avatar && Storage::exists($this->user->avatar))
            Storage::delete($this->user->avatar);

        $path = $request->file('avatar')->store('users');

        $this->user->update(['avatar' => $path]);

        return Response::json([
            'status' => 'success',
            'message' => 'Your avatar has been updated.'
        ], 200);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'min:8'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, $this->user->password))
            return Response::json([
                'status' => 'fail',
                'message' => 'Current password is not correct.'
            ], 400);

        $this->user->update([
            'password' => Hash::make($request->password)
        ]);

        return Response::json([
            'status' => 'success',
            'message' => 'Your password has been updated.'
        ], 200);
    }
}
