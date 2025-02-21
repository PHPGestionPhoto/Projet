<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Enums\GroupRight;
use App\Models\UserFollowGroup;

class Group
{
    public function groupsmng(): void
    {
        $view = new View("Group/groupsmng.php", "front.php");
        $user = new \App\Core\User();
        $userId = $user->getConnectedUser()->getId();
        $group = new \App\Models\Group();
        $ufg = new UserFollowGroup();

        $view->addData("titlePage", "Gestion des groupes");

        $groups = $group->getOwnedGroups($userId);
        $view->addData("groups", $groups);

        if (isset($_POST["group-select"])) {
            print_r($_POST["group-select"]);
            $groupId = $_POST["group-select"];
            if ($group->isUserOwner($userId, $groupId)) {
                $followedUsers = $ufg->getFollowedUsers($groupId);
                $adminUsers = new UserFollowGroup();
                $adminUsers->setUserId($userId);
                $adminUsers->setGroupId($groupId);
                $adminUsers->setRight(GroupRight::owner);
                $view->addData("followedUsers", $followedUsers);
                $view->addData("selectedGroupId", $groupId);
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