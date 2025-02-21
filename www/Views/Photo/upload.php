<div class="upload-page">
    <div class="upload-container">
        <h2>📸 Ajouter une photo</h2>
        <?php if (isset($error)) : ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form id="upload-form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="photo-name">Nom de la photo</label>
                <input type="text" id="photo-name" name="photo-name" placeholder="Entrez le nom" required>
            </div>

            <div class="form-group">
                <label for="photo-description">Description</label>
                <textarea id="photo-description" name="photo-description" placeholder="Ajoutez une description..." required></textarea>
            </div>

            <div class="form-group">
                <label for="photo-file">Sélectionner une image</label>
                <input type="file" id="photo-file" name="photo-file" accept="image/png, image/jpeg, image/jpg, image/webp, image/svg" required>
                max 5MB
            </div>

            <div class="form-group">
                <label for="group-select">Choisir un groupe</label>
                <select id="group-select" name="group-select" required>
                    <option value="">Chargement...</option>
                </select>
            </div>

            <button type="submit" class="btn-upload" value="submit" name="submit">📤 Ajouter</button>
        </form>
    </div>
</div>