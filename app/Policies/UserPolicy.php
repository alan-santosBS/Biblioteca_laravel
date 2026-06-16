<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function update(User $user, User $target): bool
    {
        // Só admin pode editar papéis de usuários
        return $user->isAdmin();
    }

    public function viewAny(User $user): bool
    {
        // Só admin pode ver lista de usuários
        return $user->isAdmin();
    }

    public function view(User $user, User $target): bool
    {
        // Admin pode ver tudo, usuário só vê a si mesmo
        return $user->isAdmin() || $user->id === $target->id;
    }
}