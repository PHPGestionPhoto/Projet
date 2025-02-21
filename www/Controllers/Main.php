<?php

namespace App\Controllers;

use App\Core\View;

class Main
{

    public function home():void
    {

        $view = new View("Main/home.php", "front.php");
        $view->addData("title", "Accueil");
        $view->addData("titlePage", "Home page");
    }

    public function feed():void
    {
        $user = new \App\Core\User();
        if (!$user->isLogged()) {
            header("Location: /login");
            exit();
        }
        $ufg = new \App\Models\UserFollowGroup();
        $followedGroups = $ufg->getFollowedGroups($user->getConnectedUser()->getId());

        $view = new View("Main/feed.php", "front.php");
        $view->addData("title", "Ton fil d'actualité");
        $view->addData("groups", $followedGroups);
    }
}