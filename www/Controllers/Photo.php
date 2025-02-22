<?php

namespace App\Controllers;

use App\Core\ImageConvert;
use App\Core\S3Client;
use App\Core\UUID;
use App\Core\View;
use App\Models\Group;

class Photo
{

    public function upload(): void
    {
        $view = new View("Photo/upload.php", "front.php");
        $user = new \App\Core\User();
        $group = new Group();
        $ufg = new \App\Models\UserFollowGroup();
        $photo = new \App\Models\Photo();
        $uuid = new UUID();
        $image = new ImageConvert();
        $s3 = new S3Client();

        $view->addData("title", "Uploadez vos photos");
        $view->addData("groups", $group->getGroups());
        $user = $user->getConnectedUser();

        if (isset($_POST["submit"])) {
            if (isset($_POST["photo-name"]) && isset($_POST["photo-description"]) && isset($_POST["group-select"]) && isset($_FILES["photo-file"])) {
                $photoName = $_POST["photo-name"];
                $photoDescription = $_POST["photo-description"];
                $groupId = $_POST["group-select"];
                $photoFile = $_FILES["photo-file"];
                if ($photoFile["size"] <= 5000000) {
                    if ($ufg->isUserFollowGroup($user->getId(), $groupId) || $group->isUserOwner($user->getId(), $groupId)) {
                        $uuid = $uuid->create($photoName . "-" . $user->getEmail() . "-" . time());
                        try {
                            /* $imageConvert = $image->convertImageToWebp($photoFile);
                             $imageConvert = $image->renameImage($imageConvert, $uuid);
                             file_put_contents(__DIR__ . '/images/' . $uuid . '.webp', $imageConvert);*/
                            try {
                                $s3->upload('users-pics/' . $uuid . '.webp', $photoFile);
                                try {
                                    $photo->setUuid($uuid);
                                    $photo->setTitle($photoName);
                                    $photo->setDescription($photoDescription);
                                    $photo->setLikes(0);
                                    $photo->setVisibility(1);
                                    $photo->setOwnerId($user->getId());
                                    $photo->setGroupId($groupId);
                                    var_dump($photo);
                                    $photo->save();
                                    $view->addData("success", "Votre photo a bien été ajoutée");
                                } catch (\Exception $e) {
                                    $view->addData("error", "Une erreur est survenue lors de la sauvegarde de la photo");
                                }
                            } catch (\Exception $e) {
                                $view->addData("error", "Une erreur est survenue lors du stockage de l'image :" . $e->getMessage());
                            }
                        } catch (\Exception $e) {
                            $view->addData("error", "Une erreur est survenue lors de la conversion de l'image :" . $e->getMessage());
                        }

                    } else {
                        $view->addData("error", "Vous ne pouvez pas ajouter de photo à ce groupe");
                    }
                } else {
                    $view->addData("error", "La taille de l'image ne doit pas dépasser 5MB");
                }
            } else {
                $view->addData("error", "Veuillez remplir tous les champs");
            }
        }
    }


}