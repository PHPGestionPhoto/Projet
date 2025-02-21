<?php

namespace App\Controllers;

use App\Core\View;

class Group
{
    public function groupsmng(): void
    {
        $view = new View("Group/groupsmng.php", "front.php");
        $user = new \App\Core\User();
        $group = new \App\Models\Group();

        $view->addData("titlePage", "Gestion des groupes");

        $groups = $group->getOwnedGroups($user->getConnectedUser()->getId());
        $view->addData("groups", $groups);

        if (isset($_POST["group-select"])) {
            $groupId = $_POST["group-select"];
            if ($group->isUserOwner($user->getConnectedUser()->getId(), $groupId)) {
                $followedUsers = $group->getFollowedUsers($groupId);
                $
                $view->addData("followedUsers", $followedUsers);
            }
        }

        if (isset($_POST["new-submit"])) {
            createGroup($view, $group, $user);
        }
    }
}


function createGroup($view, $group, $user)
{
    if (isset($_POST["new-group-name"]) && isset($_POST["new-group-description"])) {
        $groupName = $_POST["new-group-name"];
        $groupDescription = $_POST["new-group-description"];
        $view->addData("groupName", $groupName);
        $view->addData("groupDescription", $groupDescription);
        if ($groupName > 64) {
            $view->addData("error", "Le nom du groupe ne doit pas dépasser 64 caractères");
        }
        if ($groupDescription > 255) {
            $view->addData("error", "La description du groupe ne doit pas dépasser 255 caractères");
        }
        $group->setName(trim($groupName));
        $group->setDescription(trim($groupDescription));
        $group->setOwnerId($user->getConnectedUser()->getId());
        $group->save();
        $view->addData("success", "Votre groupe a bien été créé");
        $_POST = array();
        header("Location: /groupsmng");
    } else {
        $view->addData("error", "Veuillez remplir tous les champs");
    }
}