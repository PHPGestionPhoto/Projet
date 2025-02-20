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
        $view = new View("Main/feed.php", "front.php");
    }
}