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
        <img id="banner" 
            src="<?= $posterDir . htmlspecialchars($item['plakat']); ?>" 
            alt="Banner filmu <?= htmlspecialchars($item['tytul']); ?>">

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

        <img id="moviePoster" 
            src="<?= $posterDir . htmlspecialchars($item['plakat']); ?>" 
            alt="<?= !empty($item['alt_text']) ? htmlspecialchars($item['alt_text']) : 'Plakat: ' . htmlspecialchars($item['tytul']); ?>">

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
                            <div id="commentLikeCount-<?= (int)$comment['id']; ?>" class="commentLikeCount"><?= (int)$comment['polubienia']; ?></div>
                            <button id="commentLikeBtn-<?= (int)$comment['id']; ?>" class="commentLikeBtn">♡</button>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const commentLikeCount = document.getElementById('commentLikeCount-<?= (int)$comment['id']; ?>');
                                    const commentLikeBtn = document.getElementById('commentLikeBtn-<?= (int)$comment['id']; ?>');
                                    let liked = false;
                                    
                                    let value = `; ${document.cookie}`;
                                    let parts = value.split(`; commentLikes=`);
                                    let commentLikesCookie = '';
                                    let likedComments = [];
                                    // Sprawdzenie czy cookie z polubieniami istnieje
                                    if (parts.length === 2) {
                                        commentLikesCookie = decodeURIComponent(parts.pop().split(';').shift());
                                        likedComments = commentLikesCookie ? commentLikesCookie.split(',') : [];
                                        // Sprawdzenie czy ten komentarz jest polubiony
                                        if (likedComments.includes('<?= (int)$comment['id']; ?>')) {
                                            commentLikeBtn.innerHTML = '<button class="commentLikeBtn">♥︎</button>';
                                            liked = true;
                                        }
                                    } else {
                                        // Dodanie cookie z polubieniami jeśli nie istnieje
                                        const d = new Date();
                                        d.setTime(d.getTime() + (400*24*60*60*1000));
                                        let expires = "expires="+ d.toUTCString();
                                        document.cookie = "commentLikes=0;" + expires + ";path=/";
                                        value = `; ${document.cookie}`;
                                        parts = value.split(`; commentLikes=`);
                                        commentLikesCookie = decodeURIComponent(parts.pop().split(';').shift());
                                        likedComments = commentLikesCookie ? commentLikesCookie.split(',') : [];
                                    }

                                    commentLikeBtn.addEventListener('click', function() {
                                        if (!liked) {
                                            // Dodanie polubienia

                                            // Aktualizacja DB
                                            fetch('index.php?controller=details&action=likeComment&type=<?= htmlspecialchars($type); ?>', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/x-www-form-urlencoded',
                                                },
                                                body: 'commentId=<?= (int)$comment['id']; ?>'
                                            });

                                            // Aktualizacja cookie
                                            commentLikesCookie += ',<?= (int)$comment['id']; ?>';
                                            const d = new Date();
                                            d.setTime(d.getTime() + (400*24*60*60*1000));
                                            let expires = "expires="+ d.toUTCString();
                                            document.cookie = "commentLikes=" + commentLikesCookie + ";" + expires + ";path=/";
                                            
                                            // Aktualizacja frontendu
                                            commentLikeCount.textContent = parseInt(commentLikeCount.textContent) + 1;
                                            commentLikeBtn.innerHTML = '<button class="commentLikeBtn">♥︎</button>';
                                            liked = true;
                                        } else {
                                            // Usunięcie polubienia

                                            // Aktualizacja DB
                                            fetch('index.php?controller=details&action=unlikeComment&type=<?= htmlspecialchars($type); ?>', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/x-www-form-urlencoded',
                                                },
                                                body: 'commentId=<?= (int)$comment['id']; ?>'
                                            });

                                            // Aktualizacja cookie
                                            likedComments = likedComments.filter(id => id !== '<?= (int)$comment['id']; ?>');
                                            commentLikesCookie = likedComments.join(',');
                                            const d = new Date();
                                            d.setTime(d.getTime() + (400*24*60*60*1000));
                                            let expires = "expires="+ d.toUTCString();
                                            document.cookie = "commentLikes=" + commentLikesCookie + ";" + expires + ";path=/";
                                            
                                            // Aktualizacja frontendu
                                            commentLikeCount.textContent = parseInt(commentLikeCount.textContent) - 1;
                                            commentLikeBtn.innerHTML = '<button class="commentLikeBtn">♡</button>';
                                            liked = false;
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Brak komentarzy.</p>
            <?php endif; ?>
            <form id="addCommentForm" method="post" action="index.php?controller=details&action=addComment&type=<?= htmlspecialchars($type); ?>&id=<?= (int)$item['id']; ?>">
                <textarea name="commentText" id="commentText" placeholder="Twój komentarz..." rows="5" cols="40" required maxlength="500"></textarea>
                <br>
                <button type="submit" id="submitCommentBtn">Skomentuj</button>
            </form>
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
                                    src="<?= $actor['zdjecie'] ? 'zdjecia_aktorow/' . htmlspecialchars($actor['zdjecie']) : 'styles/default_actor.png'; ?>"
                                    alt="<?= !empty($actor['alt_text']) ? htmlspecialchars($actor['alt_text']) : htmlspecialchars($actor['imie'] . ' ' . $actor['nazwisko']); ?>">
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

<?php if (isset($msg)): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const msg = "<?= htmlspecialchars($msg); ?>";
            if (msg === 'empty_comment') {
                alert('Komentarz nie może być pusty.');
            } else if (msg === 'comment_too_long') {
                alert('Komentarz nie może przekraczać 500 znaków.');
            } else if (msg === 'comment_added') {
                alert('Komentarz został dodany pomyślnie.');
            }
        });
    </script>
<?php endif; ?>

</body>
</html>
