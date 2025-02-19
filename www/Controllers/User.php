<?php
namespace App\Controllers;

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

    public function reset(): void
    {
        $view = new View("User/reset.php", "front.php");
        $view->addData("title", "Réinitialisez votre mot de passe");
        $view->addData("titlePage", "Réinitialisez votre mot de passe");
    }

    public function forgot(): void {
        $view = new View("User/forgot.php", "front.php");
        $view->addData("title", "Mot de passe oublié");
        $view->addData("titlePage", "Mot de passe oublié");
    }

    public function feed(): void {
        $view = new View("User/feed.php", "front.php");
        $view->addData("title", "Votre contenu");
        $view->addData("titlePage", "Votre contenu");
    }

}

