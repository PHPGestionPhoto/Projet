<div class="group-management">
    <div class="group-container">
        <div class="create-group">
            <h2>Créer un groupe</h2>
            <?php if (isset($error)) : ?>
                <div class="error"><?= $error ?></div>
            <?php endif; ?>
            <form action="/groupsmng" method="post">
                <input type="text" id="new-group-name" name="new-group-name" placeholder="Nom du groupe" value="<?= $groupName??"" ?>">
                <input type="text" id="new-group-description" name="new-group-description" placeholder="description du groupe" value="<?= $groupDescription??"" ?>">
                <button class="create-group-btn" type="submit" name="new-submit" id="new-submit" value="new-submit">Créer</button>
            </form>
        </div>

        <div class="group-selector">
            <label for="group-select">Sélectionnez un groupe:</label>
            <form method="post" action="/groupsmng">
            <select id="group-select" name="group-select" onchange="this.form.submit()">
                <option value="0">-- Choisir un groupe --</option>
                <?php if (isset($groups)): foreach ($groups as $group) : ?>
                    <option value="<?= $group["id"] ?>" <?= (isset($selectedGroupId) && $group["id"] == $selectedGroupId)? "selected":"" ?>><?= $group["name"] ?></option>
                <?php endforeach; endif; ?>
            </select>
            </form>
        </div>

        <div class="add-user">
            <h3>Ajouter un membre</h3>
            <input type="email" id="user-email" placeholder="Email de l'utilisateur" disabled>
            <button class="add-user-btn" disabled>Ajouter</button>
        </div>

        <div class="group-details">
            <h2>Membres du groupe</h2>
            <div class="user-list">
                <?php if (isset($followedUsers)): foreach ($followedUsers as $follow) : ?>
                    <div class="user">
                        <p><?= $follow["first_name"]?></p>
                        <p><?= $follow["last_name"]?></p>
                        <p><?= $follow["email"]?></p>
                    </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>
</div>
