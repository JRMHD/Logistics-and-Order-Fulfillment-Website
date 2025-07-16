<?php

namespace App\Policies;

use App\Models\ApiKey;
use App\Models\User;

class ApiKeyPolicy
{
    public function view(User $user, ApiKey $apiKey): bool
    {
        return $user->id === $apiKey->user_id;
    }

    public function create(User $user): bool
    {
        return $user->isApiAuthorized();
    }

    public function update(User $user, ApiKey $apiKey): bool
    {
        return $user->id === $apiKey->user_id;
    }

    public function delete(User $user, ApiKey $apiKey): bool
    {
        return $user->id === $apiKey->user_id;
    }
}
