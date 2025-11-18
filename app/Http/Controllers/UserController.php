<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(StoreUserRequest $request)
    {
        return User::create($request->all());
    }

    public function show(User $id)
    {
        return $id;
    }

    public function update(UpdateUserRequest $request, User $id)
    {
        $id->update($request->all());
        return $id;
    }

    public function destroy(User $id)
    {
        return $id->delete();
    }

    public function bookings(int $id)
    {
        $id = User::with('bookings')->findOrFail($id);
        return response()->json($id->bookings);
    }

    public function login(LoginRequest $request)
    {
        $id = User::where('email', $request->email)->first();

        if (!$id || !Hash::check($request->password, $id->password)) {
            return response()->json([
                'message' => 'Неверный email или пароль'
            ], 401);
        }

        return response()->json($id);
    }
}
