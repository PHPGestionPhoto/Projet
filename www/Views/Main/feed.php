<div class="feed">
    <div class="feed-container">
        <aside class="menu">
            <h2>Menu</h2>
            <nav>
                <a href="/">Accueil</a>
                <a href="/groupsmng">Groupes</a>
                <a href="/upload">Ajouter une photo</a>
            </nav>
        </aside>
        <section class="photo-sections">
            <div class="group-photos">
                <h2 class="section-title">Groupes</h2>
                <div class="photo-grid">
                    <?php if (isset($groups)): foreach ($groups as $group) : ?>
                        <div class="photo">
                            <img src="<?=$_ENV["CURRENT_URL"]?>:4566/website-data<?=(isset($group['cover_image']) ? "/users-pics/" . $group['cover_image'] : "/local-data/default.webp") ?>" alt="<?= $group["name"] ?>">
                            <div class="photo-info">
                                <h3><?= $group["name"] ?></h3>
                                <p><?= $group["description"] ?></p>
                            </div>
                        </div>
                    <?php endforeach; endif; ?>
                    <div class="photo"><img src="/Public/assets/images/findTravelDestination.jpeg" alt="Photo 1"></div>
                    <div class="photo"><img src="/Public/assets/images/reactToPhotos.jpeg" alt="Photo 2"></div>
                    <div class="photo"><img src="/Public/assets/images/register-background.jpeg" alt="Photo 3"></div>
                </div>
            </div>

            <div class="public-photos">
                <h2 class="section-title">Photos Publiques</h2>
                <div class="photo-grid">
                    <div class="photo"><img src="/Public/assets/images/shareTravelPhotos.jpeg" alt="Photo 4"></div>
                    <div class="photo"><img src="/Public/assets/images/sharewithCommunity.jpg" alt="Photo 5"></div>
                </div>
            </div>
        </section>
    </div>
</div>
