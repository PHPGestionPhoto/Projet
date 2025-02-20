<?php

namespace App\Core;
class User
{
    public function getConnectedUser(): ?\App\Models\User
    {
        if ($this->isLogged()) {
            $user = new \App\Models\User();
            $user->setId($_SESSION['id']);
            $user->setFirstname($_SESSION['firstname']);
            $user->setLastname($_SESSION['lastname']);
            $user->setEmail($_SESSION['email']);
            return $user;
        };
        return null;
    }

    public function isLogged(): bool
    {
        return $_SESSION['connected'] ?? false;
    }

    public function logout(): void
    {
        session_destroy();
    }

}