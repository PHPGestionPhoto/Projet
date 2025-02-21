<div class="group-management">
    <div class="group-container">
        <div class="create-group">
            <h2>Créer un groupe</h2>
            <input type="text" id="new-group-name" placeholder="Nom du groupe">
            <button class="create-group-btn">Créer</button>
        </div>

        <div class="group-selector">
            <label for="group-select">Sélectionnez un groupe:</label>
            <select id="group-select">
                <option value="">-- Choisir un groupe --</option>
            </select>
        </div>

        <div class="add-user">
            <h3>Ajouter un membre</h3>
            <input type="email" id="user-email" placeholder="Email de l'utilisateur" disabled>
            <button class="add-user-btn" disabled>Ajouter</button>
        </div>

        <div class="group-details">
            <h2>Membres du groupe</h2>
            <div class="user-list">
            </div>
        </div>
    </div>
</div>
