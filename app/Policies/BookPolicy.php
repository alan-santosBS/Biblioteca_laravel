<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;

class BookPolicy
{
    public function create(User $user): bool
    {
        // Só admin e bibliotecário podem criar
        return $user->isAdmin() || $user->isBibliotecario();
    }

    public function update(User $user, Book $book): bool
    {
        // Só admin e bibliotecário podem editar
        return $user->isAdmin() || $user->isBibliotecario();
    }

    public function delete(User $user, Book $book): bool
    {
        // Só admin e bibliotecario pode deletar
        return $user->isAdmin() || $user->isBibliotecario();
    }

    public function viewAny(User $user): bool
    {
        // Todos podem visualizar
        return true;
    }

    public function view(User $user, Book $book): bool
    {
        // Todos podem visualizar
        return true;
    }
}