<?php

namespace App\Core;

class SQL
{
    public $pdo;

    public function __construct(){
        try{
            $this->pdo = new \PDO("pgsql:host=postgres;dbname=esgi","esgi","esgipwd");
        }catch(\Exception $e){
            die("Erreur SQL ".$e->getMessage());
        }
    }

}