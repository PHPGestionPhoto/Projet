<?php

namespace App\Models;

use App\Core\SQL;

class User
{
    private $sql;

    public function __construct()
    {
        $this->sql = new SQL();
    }

    protected String $firstname;
    protected String $lastname;
    protected String $email;
    protected String $password;

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }


    public function save(): void
    {
        $query = $this->sql->pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (:firstname, :lastname, :email, :password)");
        $query->execute([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'password' => $this->password,
        ]);
    }

    public function getUserByEmail(string $email): ?array
    {
        $query = $this->sql->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $query->execute([
            'email' => $email
        ]);
        if ($query->rowCount() === 0) {
            return null;
        }
        return $query->fetch();
    }
}