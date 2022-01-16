<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->input('username'))
            ->firstOrFail();
        if (! Hash::check($request->input('password'), $user->password)){
            throw new ApiException('Dados informados são inválidos. Tente Novamente', 400);
        }

        $token = $this->authService
            ->setUser($user)
            ->createAuthToken();

        return response()->json(array_merge($user->toArray(), ['access_token' => $token->plainTextToken]));
    }

    public function register(CreateUserRequest $request): Authenticatable
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return $user;
    }
}
