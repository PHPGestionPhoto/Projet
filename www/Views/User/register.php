
<div class="background">
    <div class="form-container">
        <h2>Créer un compte</h2>
        <?php if (isset($error)) : ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="post" action="/register">
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="firstname" placeholder="Prénom" required value="<?= $firstname??"" ?>">
            </div>

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="lastname" placeholder="Nom" required value="<?= $lastname??"" ?>">
            </div>

            <div class="form-group">
                <label for="email">Adresse mail</label>
                <input type="email" id="email" name="email" placeholder="Adresse mail" required value="<?= $email??"" ?>">
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            </div>

            <div class="form-group">
                <label for="passwordConfirm">Confirmation du mot de passe</label>
                <input type="password" id="passwordConfirm" name="passwordConfirm" placeholder="Confirmation du mot de passe" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </div>

            <p class="login-link">
                Vous êtes déjà membre ? <a href="/login">Connectez-vous ici</a>.
            </p>
        </form>
    </div>
</div>
