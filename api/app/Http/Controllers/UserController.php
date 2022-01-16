<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
