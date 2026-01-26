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
    <div id="searchTitle">Wyniki wyszukiwania: <?= htmlspecialchars($query); ?></div>
    <div id="searchCount">
        Znalezione pozycje: <?= count($filmy) + count($seriale); ?>
    </div>

    <?php if (!empty($filmy)): ?>
        <h2>Filmy</h2>
        <?php foreach ($filmy as $film): ?>
            <div class="searchResultsItem">
                <a href="index.php?controller=details&action=index&type=film&id=<?= (int)$film['id']; ?>" class="itemCardTitleLink">
                    <img class="poster" src="plakaty_filmow/<?= htmlspecialchars($film['plakat']); ?>">
                </a>
                <div class="movieContent">
                    <div class="movieHeader">
                        <div class="title">
                            <a href="index.php?controller=details&action=index&type=film&id=<?= (int)$film['id']; ?>" class="titleLink">
                                <?= htmlspecialchars($film['tytul']); ?>
                            </a>
                        </div>
                        <div class="year"><?= (int)$film['rok_produkcji']; ?></div>
                        <div class="duration"><?= (int)$film['czas_trwania']; ?> min</div>
                    </div>
                    <div class="description"><?= nl2br(htmlspecialchars($film['opis'])); ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($seriale)): ?>
        <h2>Seriale</h2>
        <?php foreach ($seriale as $serial): ?>
            <div class="searchResultsItem">
                <a href="index.php?controller=details&action=index&type=serial&id=<?= (int)$serial['id']; ?>">
                    <img class="poster" src="plakaty_seriali/<?= htmlspecialchars($serial['plakat']); ?>">
                </a>
                <div class="movieContent">
                    <div class="movieHeader">
                        <div class="title">
                            <a href="index.php?controller=details&action=index&type=serial&id=<?= (int)$serial['id']; ?>" class="titleLink">
                                <?= htmlspecialchars($serial['tytul']); ?>
                            </a>
                        </div>
                        <div class="year"><?= (int)$serial['rok_produkcji']; ?></div>
                    </div>
                    <div class="description"><?= nl2br(htmlspecialchars($serial['opis'])); ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script src="themeToggle.js"></script>
</body>
</html>