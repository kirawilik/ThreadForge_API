<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Bleuprint;

class BlueprintPolicy
{
    public function view(User $user, Bleuprint $bleuprint): bool
    {
        return $user->id === $bleuprint->user_id;
    }

    public function update(User $user, Bleuprint $bleuprint): bool
    {
        return $user->id === $bleuprint->user_id;
    }

    public function delete(User $user, Bleuprint $bleuprint): bool
    {
        return $user->id === $bleuprint->user_id;
    }
}