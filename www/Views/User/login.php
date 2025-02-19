<div class="background">
    <div class="form-container">
        <h2>Connexion</h2>
        <?php if (isset($error)) : ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="post" action="/login">
            <div class="form-group">
                <label for="email">Adresse mail</label>
                <input type="email" id="email" name="email" placeholder="Adresse mail" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>

            <p class="login-link">
                Pas encore inscrit ? <a href="/register">Créez un compte ici</a>.
            </p>

            <p class="login-link">
                Mot de passe oublié ? <a href="/forgot">Réinitialisez votre mot de passe</a>.
            </p>
        </form>
    </div>
</div>
