<?php
namespace www\Controllers;

use App\Core\User as U;
use App\Core\View;

class User
{
    public function register(): void
    {
        $view = new View("User/register.php", "front.php");
        $view->addData("title", "Inscription");
        $view->addData("titlePage", "Inscription");
    }

    public function login(): void
    {
        $view = new View("User/login.php", "front.php");
        $view->addData("title", "Connexion");
        $view->addData("titlePage", "Connexion");
    }


    public function logout(): void
    {
        $user = new U;
        $user->logout();
        //header("Location: /");
    }

}

