<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function list(): Collection
    {
        return User::all();
    }

    public function show(User $user): User
    {
        return $user;
    }

    public function create(CreateUserRequest $request): JsonResponse
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json($user);
    }

    public function update(User $user, Request $request): User
    {
        $user->update($request->all());

        return $user;
    }

    public function delete(User $user)
    {
        $user->delete();
        //@todo remove this
        return response()->json(['message' => 'ok']);
    }
}
