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
    protected String $cover_image;

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
    public function getCoverImage(): string
    {
        return $this->cover_image;
    }
    public function setCoverImage(string $cover_image): void
    {
        $this->cover_image = $cover_image;
    }
    public function save(): void
    {
        $query = $this->sql->pdo->prepare("INSERT INTO GROUPS (NAME, DESCRIPTION, OWNER_ID) VALUES (:name, :description, :owner_id)");
        $query->execute([
            'name' => $this->name,
            'description' => $this->description,
            'owner_id' => $this->owner_id,
        ]);
    }


    public function getGroups(): ?array
    {
        $query = $this->sql->pdo->prepare("SELECT * FROM GROUPS");
        $query->execute();
        if ($query->rowCount() === 0) {
            return null;
        }
        return $query->fetchAll();
    }
    public function getOwnedGroups(int $owner_id): ?array
    {
        $query = $this->sql->pdo->prepare("SELECT * FROM GROUPS WHERE OWNER_ID = :owner_id");
        $query->execute(['owner_id' => $owner_id]);
        if ($query->rowCount() === 0) {
            return null;
        }
        return $query->fetchAll();
    }
    public function getFollowedUsers(int $group_id): ?array
    {
        $query = $this->sql->pdo->prepare("SELECT * FROM USERS WHERE ID IN (SELECT USER_ID FROM USER_FOLLOW_GROUPS WHERE GROUP_ID = :group_id)");
        $query->execute(['group_id' => $group_id]);
        if ($query->rowCount() === 0) {
            return null;
        }
        return $query->fetchAll();
    }
    public function getFollowedGroups(int $user_id): ?array
    {
     $query = $this->sql->pdo->prepare("SELECT * FROM GROUPS WHERE ID IN (SELECT GROUP_ID FROM USER_FOLLOW_GROUPS WHERE USER_ID = :user_id)");
        $query->execute(['user_id' => $user_id]);
        if ($query->rowCount() === 0) {
            return null;
        }
        return $query->fetchAll();
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

    public function isUserFollowGroup(int $user_id, int $group_id): bool
    {
        $query = $this->sql->pdo->prepare("SELECT GROUP_ID FROM USER_FOLLOW_GROUPS WHERE USER_ID = :user_id AND GROUP_ID = :group_id");
        $query->execute(['user_id' => $user_id, 'group_id' => $group_id]);
        if ($query->rowCount() !== 0) {
            return true;
        }
        return false;
    }
    public function isUserOwner(int $user_id, int $group_id): bool
    {
        $query = $this->sql->pdo->prepare("SELECT ID FROM GROUPS WHERE OWNER_ID = :user_id AND ID = :group_id");
        $query->execute(['user_id' => $user_id, 'group_id' => $group_id]);
        if ($query->rowCount() !== 0) {
            return true;
        }
        return false;
    }
}