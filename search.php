<?php
require_once 'functions.php';

$query = trim($_GET['q'] ?? '');

$type = $_GET['type'] ?? '';
$categories = isset($_GET['categories']) ? explode(',', $_GET['categories']) : [];
$director   = $_GET['director'] ?? '';
$actors     = isset($_GET['actors']) ? explode(',', $_GET['actors']) : [];
$platforms  = isset($_GET['platforms']) ? explode(',', $_GET['platforms']) : [];

$filmy = [];
$seriale = [];


if ($query !== '') {
    $filmy   = searchMoviesByTitle($query);
    $seriale = searchShowsByTitle($query);

} elseif ($type !== '') {
    $hasFilters = !empty($categories) || !empty($director) || !empty($actors) || !empty($platforms);
    
    if ($type === 'film') {
        if ($hasFilters) {
            $filmy = searchAdvancedMovies($categories, $director, $actors, $platforms);
        } else {
            $filmy = getAllMovies();
        }
    } elseif ($type === 'serial') {
        if ($hasFilters) {
            $seriale = searchAdvancedShows($categories, $director, $actors, $platforms);
        } else {
            $seriale = getAllShows();
        }
    } elseif ($type === 'all') {
        if ($hasFilters) {
            $filmy = searchAdvancedMovies($categories, $director, $actors, $platforms);
            $seriale = searchAdvancedShows($categories, $director, $actors, $platforms);
        } else {
            $filmy = getAllMovies();
            $seriale = getAllShows();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="styles/common.css" rel="stylesheet">
<link href="styles/favandsearch.css" rel="stylesheet">
<title>B-Movie - Wyniki wyszukiwania</title>
</head>
<body>
<header>
    <a href="index.php" id="headerLogoAndTitle">
        <img id="headerLogo" src="styles/logo.svg">
        <div id="headerTitle">B-Movie</div>
    </a>
</header>

<div id="searchWrapper">
    <div id="searchTitle">Wyniki wyszukiwania: <?php echo htmlspecialchars($query); ?></div>
    <div id="searchCount">
        Znalezione pozycje: <?php echo count($filmy) + count($seriale); ?>
    </div>

    <?php if (!empty($filmy)): ?>
        <h2>Filmy</h2>
        <?php foreach ($filmy as $film): ?>
            <div class="searchResultsItem">
                <a href="details.php?type=film&id=<?php echo (int)$film['id']; ?>" class="itemCardTitleLink">
                    <img class="poster" src="plakaty_filmow/<?php echo htmlspecialchars($film['plakat']); ?>">
                </a>
                <div class="movieContent">
                    <div class="movieHeader">
                        <div class="title">
                    <a href="details.php?type=film&id=<?php echo (int)$film['id']; ?>" class="titleLink">
                     <?php echo htmlspecialchars($film['tytul']); ?>
                    </a>
                    </div>

                        <div class="year"><?php echo (int)$film['rok_produkcji']; ?></div>
                        <div class="duration"><?php echo (int)$film['czas_trwania']; ?> min</div>
                    </div>
                    <div class="description"><?php echo nl2br(htmlspecialchars($film['opis'])); ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($seriale)): ?>
        <h2>Seriale</h2>
        <?php foreach ($seriale as $serial): ?>
            <div class="searchResultsItem">
                <a href="details.php?type=serial&id=<?php echo (int)$serial['id']; ?>">
                    <img class="poster" src="plakaty_seriali/<?php echo htmlspecialchars($serial['plakat']); ?>">
                </a>
                <div class="movieContent">
                    <div class="movieHeader">
                        <div class="title">
                        <a href="details.php?type=serial&id=<?php echo (int)$serial['id']; ?>" class="titleLink">
                            <?php echo htmlspecialchars($serial['tytul']); ?>
                        </a>
                    </div>
                        <div class="year"><?php echo (int)$serial['rok_produkcji']; ?></div>
                    </div>
                    <div class="description"><?php echo nl2br(htmlspecialchars($serial['opis'])); ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (empty($filmy) && empty($seriale)): ?>
    <?php endif; ?>
</div>

<script src="themeToggle.js"></script>
</body>
</html>
