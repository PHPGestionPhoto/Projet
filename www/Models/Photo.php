<?php

namespace App\Models;

use App\Core\SQL;

class Photo
{
    private $sql;

    public function __construct()
    {
        $this->sql = new SQL();
    }

    protected String $uuid;
    protected String $title;
    protected String $description;
    protected int $likes;
    protected int $visibility;
    protected int $owner_id;
    protected int $group_id;
    protected String $created_at;

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getLikes(): int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): void
    {
        $this->likes = $likes;
    }

    public function getVisibility(): int
    {
        return $this->visibility;
    }

    public function setVisibility(int $visibility): void
    {
        $this->visibility = $visibility;
    }

    public function getOwnerId(): int
    {
        return $this->owner_id;
    }

    public function setOwnerId(int $owner_id): void
    {
        $this->owner_id = $owner_id;
    }

    public function getGroupId(): int
    {
        return $this->group_id;
    }

    public function setGroupId(int $group_id): void
    {
        $this->group_id = $group_id;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }
    public function getPhotoById(string $uuid): ?array
    {
        $query = $this->sql->pdo->prepare("SELECT * FROM PHOTOS WHERE UUID = :uuid");
        $query->execute(['uuid' => $uuid]);
        if ($query->rowCount() === 0) {
            return null;
        }
        return $query->fetch();
    }
    public function getPhotosByGroupId(int $group_id): ?array
    {
        $query = $this->sql->pdo->prepare("SELECT * FROM PHOTOS WHERE GROUP_ID = :group_id");
        $query->execute(['group_id' => $group_id]);
        if ($query->rowCount() === 0) {
            return null;
        }
        return $query->fetch();
    }
    public function getPhotosByOwnerId(int $owner_id): ?array
    {
        $query = $this->sql->pdo->prepare("SELECT * FROM PHOTOS WHERE OWNER_ID = :owner_id");
        $query->execute(['owner_id' => $owner_id]);
        if ($query->rowCount() === 0) {
            return null;
        }
        return $query->fetch();
    }
}