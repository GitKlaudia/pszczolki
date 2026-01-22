<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/common.css" rel="stylesheet">
    <link href="styles/details.css" rel="stylesheet">
    <title>B-Movie</title>
</head>
<body>
    <header>
        <a href="index.php" id="headerLogoAndTitle" style="text-decoration: none;">
            <img id="headerLogo" src="styles/logo.svg">
            <div id="headerTitle">B-Movie</div>
        </a>

        <div id="navBar">
            <a href="index.php?controller=search&action=index&type=film" class="navItem" id="navMovies">Filmy</a>
            <a href="index.php?controller=search&action=index&type=serial" class="navItem" id="navShows">Seriale</a>
            <a href="index.php?controller=favourites&action=index" class="navItem" id="navFav">Polubione</a>
            <button id="themeToggle" title="Zmień motyw">
                <img id="themeIcon" src="styles/light.svg" alt="Motyw">
            </button>
        </div>
    </header>

    <div id="detailsWrapper">
        <img id="banner" src="<?= $posterDir . htmlspecialchars($item['plakat']); ?>">

        <div id="rating">
            Ocena: <?= $rating !== null ? $rating . '/10' : 'Brak ocen'; ?>
        </div>

        <div id="movieRating">
            <div id="movieRatingTitle">Oceń <?= $type === 'film' ? 'film' : 'serial'; ?></div>
            <div id="stars">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <div class="star" data-value="<?= $i ?>"></div>
                <?php endfor; ?>
            </div>
        </div>

        <div id="title">
            <div class="title-row">
                <h1 class="title-text"><?= htmlspecialchars($item['tytul']); ?></h1>
                <button id="likeBtn">♡</button>
            </div>
            <div class="info-row">
                <div id="year"><?= (int)$item['rok_produkcji']; ?></div>

                <?php if ($type === 'film'): ?>
                    <div id="duration"><?= (int)$item['czas_trwania']; ?> min</div>
                <?php else: ?>
                    <div id="seasons">sezonów: <?= (int)$item['ilosc_sezonow']; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <img id="moviePoster" src="<?= $posterDir . htmlspecialchars($item['plakat']); ?>">

        <div id="description">
            <?= nl2br(htmlspecialchars($item['opis'])); ?>

            <div id="genres"><?= implode(', ', $categories); ?></div>
            <div id="director">
                <?= implode(', ', array_map(fn($d) => $d['imie'] . ' ' . $d['nazwisko'], $directors)); ?>
            </div>
        </div>

        <div id="commentsWrapper">
            <div id="commentsTitle">Komentarze</div>
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment">
                        <img class="commentUserAvatar">
                        <div class="commentContent"><?= htmlspecialchars($comment['komentarz']); ?></div>
                        <div class="commentLikes">
                            <div class="commentLikeCount"><?= (int)$comment['polubienia']; ?></div>
                            <button class="commentLikeBtn">♡</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Brak komentarzy.</p>
            <?php endif; ?>
        </div>

        <div id="whereToWatch">
            <div id="whereToWatchTitle">Gdzie obejrzeć?</div>
            <div id="vodLinks">
                <?php if (!empty($platforms)): ?>
                    <?php foreach ($platforms as $platform): ?>
                        <a class="vodLink"
                           href="<?= htmlspecialchars($platform['link']); ?>"
                           target="_blank"
                           rel="noopener noreferrer">

                            <img class="vodIcon"
                                 src="ikony_platform/<?= htmlspecialchars($platform['ikona']); ?>"
                                 alt="<?= htmlspecialchars($platform['nazwa']); ?>">

                            <div class="vodLinks">
                                <?= htmlspecialchars($platform['nazwa']); ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Brak dostępnych platform.</p>
                <?php endif; ?>
            </div>
        </div>

        <div id="cast">
            <div id="castTitle">Obsada</div>
            <div class="castGalleryWrapper">
                <button class="carouselBtn leftBtn" onclick="scrollLess('castWrapper')">&lt;</button>
                <div class="castGallery" id="castWrapper">
                    <?php if (!empty($actors)): ?>
                        <?php foreach ($actors as $actor): ?>
                            <div class="castPersonWrapper">
                                <img class="castPersonImage"
                                     src="<?= $actor['zdjecie'] ? 'zdjecia_aktorow/' . htmlspecialchars($actor['zdjecie']) : 'styles/default_actor.png'; ?>">
                                <div class="castPersonName"><?= htmlspecialchars($actor['imie'] . ' ' . $actor['nazwisko']); ?></div>
                                <?php if (!empty($actor['rola'])): ?>
                                    <div class="castPersonRole"><?= htmlspecialchars($actor['rola']); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Brak informacji o obsadzie.</p>
                    <?php endif; ?>
                </div>
                <button class="carouselBtn rightBtn" onclick="scrollMore('castWrapper')">&gt;</button>
            </div>
        </div>
    </div>

<script src="js/suggestions.js"></script>
<script src="js/themeToggle.js"></script>
<script src="js/scroll.js"></script>
</body>
</html>
