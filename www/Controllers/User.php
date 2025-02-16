<?php
namespace App\Controllers;

use App\Core\User as U;
use App\Core\View;

class User
{
    public function register(): void
    {
        $user = new \App\Models\User();
        $view = new View("User/register.php", "front.php");
        $view->addData("title", "Inscription");
        $view->addData("titlePage", "Inscription");

        if (isset($_POST["email"])) {
            $email = strtolower(trim($_POST["email"]));
            $password = $_POST["password"];
            $passwordConfirm = $_POST["passwordConfirm"];
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];

            $view->addData("firstname", $firstname);
            $view->addData("lastname", $lastname);
            $view->addData("email", $email);
            if ($password === $passwordConfirm) {
                if (strlen($password) >= 15) {
                    $view->addData("error", $user->getUserByEmail($email));
                    if ($user->getUserByEmail($email) === null) {
                        $user->setEmail($email);
                        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                        $user->setFirstname($firstname);
                        $user->setLastname($lastname);
                        $user->save();
                        header("Location: /login");
                        exit();
                    } else {
                        $view->addData("error", "Ce compte ne peut pas être créé");
                    }
                } else {
                    $view->addData("error", "Le mot de passe doit contenir au moins 15 caractères");
                }
            } else {
                $view->addData("error", "Les mot de passe ne correspondent pas");
            }
        }
    }

    public function login(): void
    {
        $view = new View("User/login.php", "front.php");
        $view->addData("title", "Connexion");
        $view->addData("titlePage", "Connexion");

        if (isset($_POST["email"])) {
            $email = strtolower(trim($_POST["email"]));
            $password = $_POST["password"];
            $user = new \App\Models\User();
            $user = $user->getUserByEmail($email);
            if ($user !== null) {
                if (password_verify($password, $user["password"])) {
                    $_SESSION["user"] = $user;
                    $_SESSION["connected"] = true;
                    header("Location: /");
                    exit();
                } else {
                    $view->addData("error", "Email ou mot de passe incorrect");
                }
            } else {
                $view->addData("error", "Email ou mot de passe incorrect");
            }
        }
    }


    public function logout(): void
    {
        $user = new U;
        $user->logout();
        //header("Location: /");
    }

}

