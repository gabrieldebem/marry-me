<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Sanctum\NewAccessToken;

class AuthService
{
    public User $user;

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    public function createAuthToken(): NewAccessToken
    {
        return $this->user->createToken(Str::random());
    }

}
