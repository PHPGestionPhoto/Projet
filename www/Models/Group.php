<?php

namespace App\Models;

use App\Core\SQL;

class Group
{
    private $sql;

    public function __construct()
    {
        $this->sql = new SQL();
    }

    protected int $id;
    protected String $name;
    protected String $description;
    protected Int $owner_id;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    public function getOwnerId(): int
    {
        return $this->owner_id;
    }

    public function setOwnerId(int $owner_id): void
    {
        $this->owner_id = $owner_id;
    }


    public function getGroups(): ?array
    {
        $query = $this->sql->pdo->prepare("SELECT * FROM GROUPS");
        $query->execute();
        if ($query->rowCount() === 0) {
            return null;
        }
        return $query->fetch();
    }
    public function getOwnedGroups(int $owner_id): ?array
    {
        $query = $this->sql->pdo->prepare("SELECT * FROM GROUPS WHERE OWNER_ID = :owner_id");
        $query->execute(['owner_id' => $owner_id]);
        if ($query->rowCount() === 0) {
            return null;
        }
        return $query->fetch();
    }
    public function getFollowedGroups(int $user_id): ?array
    {
     $query = $this->sql->pdo->prepare("SELECT * FROM GROUPS WHERE ID IN (SELECT GROUP_ID FROM USER_FOLLOW_GROUPS WHERE USER_ID = :user_id)");
        $query->execute(['user_id' => $user_id]);
        if ($query->rowCount() === 0) {
            return null;
        }
        return $query->fetch();
    }
    public function getGroupById(int $id): ?array
    {
        $query = $this->sql->pdo->prepare("SELECT * FROM GROUPS WHERE ID = :id");
        $query->execute(['id' => $id]);
        if ($query->rowCount() === 0) {
            return null;
        }
        return $query->fetch();
    }
    public function createGroup(int $owner_id, string $name, string $description): void
    {
        $query = $this->sql->pdo->prepare("INSERT INTO GROUPS (OWNER_ID, NAME, DESCRIPTION) VALUES (:owner_id, :name, :description)");
        $query->execute([
            'owner_id' => $owner_id,
            'name' => $name,
            'description' => $description,
        ]);
    }
}