<?php
spl_autoload_register("myAutoloader");
function myAutoloader(string $class)
{
    $pathClass = "../" . str_ireplace(["App\\", "\\"], ["", "/"], $class) . ".php";
    if (file_exists($pathClass)) {
        include $pathClass;
    }
}

session_start();
$env = parse_ini_file("../.env");
$_ENV = $env;

$uri = strtok(strtolower($_SERVER["REQUEST_URI"]), "?");
$uri = (strlen($uri) > 1) ? rtrim($uri, "/") : $uri;


if (file_exists("../routes.yml")) {
    $listOfRoutes = yaml_parse_file("../routes.yml");
} else {
    die("Le fichier de routing n'existe pas");
}
$listOfRoutesNonAuth = ["/", "/login", "/register", "reset", "logout"];

if (!isset($_SESSION["connected"]) && !in_array($uri, $listOfRoutesNonAuth)) {
    header("Location: /login");
    exit();
}
if (empty($listOfRoutes[$uri]) || empty($listOfRoutes[$uri]["controller"]) || empty($listOfRoutes[$uri]["action"])) {
    die("Page not found : 404");
}
$controller = $listOfRoutes[$uri]["controller"];
$action = $listOfRoutes[$uri]["action"];


if (!file_exists("../Controllers/" . $controller . ".php")) {
    die("Le fichier controller n'existe pas : ../Controllers/" . $controller . ".php");
}
require "../Controllers/" . $controller . ".php";

$controller = "\\App\\Controllers\\" . $controller;
if (!class_exists($controller)) {
    die("La classe controller n'existe pas : " . $controller);

}
//On fait une instance dynamique
$objetController = new $controller();

if (!method_exists($objetController, $action)) {
    die("La methode controller n'existe pas : " . $action);
}
$objetController->$action();

error_reporting(E_ALL);
ini_set('display_errors', 1);

