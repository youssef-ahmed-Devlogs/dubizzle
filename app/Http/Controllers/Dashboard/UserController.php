<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::filter(request()->query())->latest()->paginate(5)->withQueryString();
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.create', ['user' => new User]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone_number' => ['required', 'numeric', 'unique:users,phone_number'],
            'role' => ['in:user,admin,super-admin'],
            'password' => ['required', 'min:8', 'confirmed'],
            'avatar' => ['nullable', 'image', 'max:2048']
        ]);

        if ($request->hasFile('avatar')) {
            $formData['avatar'] = $request->file('avatar')->store('users');
        }

        User::create($formData);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dashboard.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $formData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', "unique:users,email,$user->id"],
            'phone_number' => ['required', 'numeric', "unique:users,phone_number,$user->id"],
            'role' => ['in:user,admin,super-admin'],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'avatar' => ['nullable', 'image', 'max:2048']
        ]);

        if ($request->hasFile('avatar')) {
            $this->deleteAvatar($user);
            $formData['avatar'] = $request->file('avatar')->store('users');
        }

        if ($formData['password'] === null)
            unset($formData['password']);

        $user->update($formData);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->deleteAvatar($user);
        $user->delete();
        return back();
    }

    private function deleteAvatar($user)
    {
        if ($user->avatar && Storage::exists($user->avatar))
            Storage::delete($user->avatar);
    }
}
