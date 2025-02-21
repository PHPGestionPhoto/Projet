<?php

namespace App\Core;
class User
{
    public function getConnectedUser(): ?\App\Models\User
    {
        if ($this->isLogged()) {
            $sessionUser = $_SESSION['user'];
            $user = new \App\Models\User();
            $user->setId($sessionUser['id']);
            $user->setFirstname($sessionUser['first_name']);
            $user->setLastname($sessionUser['last_name']);
            $user->setEmail($sessionUser['email']);
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