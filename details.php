<?php
require_once 'functions.php';

$type = $_GET['type'] ?? '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (($type !== 'film' && $type !== 'serial') || $id <= 0) {
    die('Nieprawidłowe dane');
}

if ($type === 'film') {
    $item = getMovieById($id);
    $categories = getMovieCategories($id);
    $directors  = getMovieDirectors($id);
    $rating     = getMovieRating($id);
    $platforms  = getMoviePlatforms($id);
    $actors     = getMovieActors($id);
    $comments   = getMovieComments($id);
    $posterDir  = 'plakaty_filmow/';
} else {
    $item = getShowById($id);
    $categories = getShowCategories($id);
    $directors  = getShowDirectors($id);
    $rating     = getShowRating($id);
    $platforms  = getShowPlatforms($id);
    $actors     = getShowActors($id);
    $comments   = getShowComments($id);
    $posterDir  = 'plakaty_seriali/';
}

if (!$item) die('Nie znaleziono pozycji');

$allMovies = getAllMovies();
$allShows = getAllShows();
?>

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
                <a href="search.php?type=film" class="navItem" id="navMovies">Filmy</a>
                <a href="search.php?type=serial" class="navItem" id="navShows">Seriale</a>
                <a href="favourites.php" class="navItem" id="navFav">Polubione</a>
                <button id="themeToggle" title="Zmień motyw">
                <img id="themeIcon" src="styles/light.svg" alt="Motyw">
                </button>
                </div>
    </header>

    <div id="detailsWrapper">
        <img id="banner" src="<?php echo $posterDir . htmlspecialchars($item['plakat']); ?>">
        
        <div id="rating">
            Ocena: <?php echo $rating !== null ? $rating . '/10' : 'Brak ocen'; ?>
        </div>


        <div id="movieRating">
            <div id="movieRatingTitle">Oceń film</div>
            <div id="stars">
                <div class="star" data-value="1"></div>
                <div class="star" data-value="2"></div>
                <div class="star" data-value="3"></div>
                <div class="star" data-value="4"></div>
                <div class="star" data-value="5"></div>
                <div class="star" data-value="6"></div>
                <div class="star" data-value="7"></div>
                <div class="star" data-value="8"></div>
                <div class="star" data-value="9"></div>
                <div class="star" data-value="10"></div>
            </div>
        </div>

        <div id="title">
            <div class="title-row">
                <h1 class="title-text"><?php echo htmlspecialchars($item['tytul']); ?></h1>
                <button id="likeBtn">♡</button>
            </div>
<div class="info-row">
    <div id="year"><?php echo (int)$item['rok_produkcji']; ?></div>

    <?php if ($type === 'film'): ?>
        <div id="duration"><?php echo (int)$item['czas_trwania']; ?> min</div>
    <?php elseif ($type === 'serial'): ?>
        <div id="seasons">sezonów: <?php echo (int)$item['ilosc_sezonow']; ?></div>
    <?php endif; ?>
</div>

        </div>

        <img id="moviePoster" src="<?php echo $posterDir . htmlspecialchars($item['plakat']); ?>">

        <div id="description">
            <?php echo nl2br(htmlspecialchars($item['opis'])); ?>

        <div id="genres">
            <?php echo implode(', ', $categories); ?>
        </div>

        <div id="director">
            <?php
            echo implode(', ', array_map(
                fn($d) => $d['imie'] . ' ' . $d['nazwisko'],
                $directors
            ));
            ?>
        </div>
        </div>


        <div id="commentsWrapper">
            <div id="commentsTitle">Komentarze</div>
            <div class="comment">
                <img class="commentUserAvatar">
                <div class="commentContent">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</div>
                <div class="commentLikes">
                    <div class="commentLikeCount">9</div>
                    <button class="commentLikeBtn">♡</button>
                </div>
            </div>
            <div class="comment">
                <img class="commentUserAvatar">
                <div class="commentContent">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</div>
                <div class="commentLikes">
                    <div class="commentLikeCount">5</div>
                    <button class="commentLikeBtn">♡</button>
                </div>
            </div>
            <div class="comment">
                <img class="commentUserAvatar">
                <div class="commentContent">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</div>
                <div class="commentLikes">
                    <div class="commentLikeCount">2</div>
                    <button class="commentLikeBtn">♡</button>
                </div>
            </div>                        
        </div>

    <div id="whereToWatch">
        <div id="whereToWatchTitle">Gdzie obejrzeć?</div>

        <div id="vodLinks">
            <?php if (!empty($platforms)): ?>
                <?php foreach ($platforms as $platform): ?>
                    <a class="vodLink"
                       href="<?php echo htmlspecialchars($platform['link']); ?>"
                       target="_blank"
                       rel="noopener noreferrer">

                        <img class="vodIcon"
                             src="ikony_platform/<?php echo htmlspecialchars($platform['ikona']); ?>"
                             alt="<?php echo htmlspecialchars($platform['nazwa']); ?>">

                        <div class="vodLinks">
                            <?php echo htmlspecialchars($platform['nazwa']); ?>
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
                             src="<?php echo $actor['zdjecie'] 
                                 ? 'zdjecia_aktorow/' . htmlspecialchars($actor['zdjecie']) 
                                 : 'styles/default_actor.png'; ?>">
                        
                        <div class="castPersonName">
                            <?php echo htmlspecialchars($actor['imie'] . ' ' . $actor['nazwisko']); ?>
                        </div>

                        <?php if (!empty($actor['rola'])): ?>
                            <div class="castPersonRole">
                                <?php echo htmlspecialchars($actor['rola']); ?>
                            </div>
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
<script>
    const searchForm = document.getElementById('searchForm');
    searchForm.addEventListener('submit', function(e) {
        const query = document.getElementById('searchInput').value.trim();
        if (!query) {
            e.preventDefault(); 
            return;
        }
    });
</script>
<script src="suggestions.js"></script>
<script src="themeToggle.js"></script>
<script src="scroll.js"></script>
</body>

</html>