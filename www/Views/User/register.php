<form class="register-form" action="#" method="POST">
    <div class="form-group">
        <label for="name">Nom</label>
        <input type="text" id="name" name="name" placeholder="Votre prenom" required>
    </div>

    <div class="form-group">
        <label for="lastName">Nom</label>
        <input type="text" id="name" name="name" placeholder="Votre nom de famille" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Votre email" required>
    </div>

    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
    </div>

    <div class="form-group">
        <label for="password-confirm">Confirmer le mot de passe</label>
        <input type="password" id="password-confirm" name="password_confirm" placeholder="Confirmez votre mot de passe" required>
    </div>

    <button type="submit" class="btn">S'inscrire</button>
    <a href="/login">Inscrivez-vous</a>
</form>