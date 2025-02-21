<?php

namespace App\Models;

use App\Core\SQL;
use App\Models\Enums\GroupRight;

class UserFollowGroup
{
    private $sql;
    public function __construct()
    {
        $this->sql = new SQL();
    }

    protected int $id;
    protected int $user_id;
    protected int $group_id;
    protected GroupRight $right;
    protected String $created_at;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getGroupId(): int
    {
        return $this->group_id;
    }

    public function setGroupId(int $group_id): void
    {
        $this->group_id = $group_id;
    }

    public function getRight(): GroupRight
    {
        return $this->right;
    }

    public function setRight(GroupRight $right): void
    {
        $this->right = $right;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getFollowedUsers(int $group_id): ?array
    {
        $query = $this->sql->pdo->prepare("SELECT u.first_name, u.last_name, u.email, ufg.rights FROM user_follow_groups ufg INNER JOIN users u on u.id = ufg.user_id where group_id = :group_id");
        $query->execute([
            'group_id' => $group_id
        ]);
        if ($query->rowCount() === 0) {
            return null;
        }
        return $query->fetchAll();

    }
    public function getFollowedGroups(int $user_id): ?array
    {
        $query = $this->sql->pdo->prepare("SELECT g.name, g.description FROM user_follow_groups ufg INNER JOIN groups g on g.id = ufg.group_id where user_id = :user_id");
        $query->execute([
            'user_id' => $user_id
        ]);
        if ($query->rowCount() === 0) {
            return null;
        }
        return $query->fetchAll();

    }
    public function save(): void
    {
        $query = "INSERT INTO user_follow_group (user_id, group_id, rights, created_at) VALUES (:user_id, :group_id, :rights, :created_at)";
        $this->sql->execute($query, [
            'user_id' => $this->user_id,
            'group_id' => $this->group_id,
            'rights' => $this->right,
            'created_at' => $this->created_at,
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

}