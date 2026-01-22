<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/index.css" rel="stylesheet">
    <link href="styles/common.css" rel="stylesheet">
    <title>B-Movie</title>
</head>
<body>
    <header>
        <a href="index.php" id="headerLogoAndTitle" style="text-decoration: none;">
            <img id="headerLogo" src="styles/logo.svg">
            <div id="headerTitle">B-Movie</div>
        </a>
        <div id="centerSection">
            <div class="inputWithSuggestions">
  <form id="searchForm">
    <input type="text" id="searchInput" placeholder="Wyszukaj...">
                <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer; position: absolute; right: 15px; top: 50%; transform: translateY(-50%);">
                <img src="styles/searchIcon.svg" alt="Szukaj" style="height: 20px; width: auto; display: block;">
            </button>
</form>


                <script>
                    const searchInput = document.getElementById('searchInput');
                    const searchForm = document.getElementById('searchForm');
                    searchForm.addEventListener('submit', function(e) {
                        const query = searchInput.value.trim();
                        if (!query) {
                            e.preventDefault(); 
                            return;
                        }
                    });
                </script>
                <div class="suggestionsBox">
                    <?php foreach ($filmy as $film): ?>
                        <div class="suggestion">
                            <?php echo htmlspecialchars($film['tytul']); ?>
                        </div>
                    <?php endforeach; ?>
                    <?php foreach ($seriale as $serial): ?>
                        <div class="suggestion">
                            <?php echo htmlspecialchars($serial['tytul']); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- POPRAWIONY LINK -->
            <a href="index.php?controller=advancedSearch&action=index" class="advSearch">Wyszukiwanie zaawansowane ></a>
        </div>

        <div id="navBar">
            <a href="index.php?controller=search&action=index&type=film" class="navItem" id="navMovies">Filmy</a>
            <a href="index.php?controller=search&action=index&type=serial" class="navItem" id="navShows">Seriale</a>
            <a href="index.php?controller=favourites&action=index" class="navItem" id="navFav">Polubione</a>
            <button id="themeToggle" title="Zmień motyw">
                <img id="themeIcon" src="styles/light.svg" alt="Motyw">
            </button>
        </div>
    </header>

    <div id="mainBanner">
        <div id="mainBannerRowsWrapper">
            <div class="mainBannerRows">Wszystkie Twoje ulubione</div>
            <div class="mainBannerRows"><span id="mainBannerHighlitedText">filmy i seriale</span></div>
            <div class="mainBannerRows">w jednym miejscu.</div>
        </div>
    </div>

    <div id="contentSections">
        <div id="mobileNavBar">
            <a href="index.php?controller=search&action=index&type=film" class="mobileNavBarItem">Filmy</a>
            <a href="index.php?controller=search&action=index&type=serial" class="mobileNavBarItem">Seriale</a>
        </div>
        <div id="mobileSearchBar">
            <input type="text" id="mobileSearchInput" placeholder="Wyszukaj...">
            <img id="mobileSearchIcon" src="styles/searchIcon.svg">
        </div>

        <div id="moviesSection" class="contentSection activeSection">
            <div class="sectionTitle">Filmy</div>
            <div class="carouselWrapper">
                <button class="carouselBtn leftBtn" onclick="scrollLess('MovieWrapper')">&lt;</button>
                <div id="MovieWrapper" class="carouselItems">
                    <?php if (!empty($filmy)): ?>
                        <?php foreach ($filmy as $film): ?>
                            <div class="itemCard">
                                <a href="index.php?controller=details&action=index&type=film&id=<?= (int)$film['id']; ?>" class="itemCardPosterLink">
                                    <div class="itemCardPoster" 
                                        role="img"
                                        aria-label="<?= !empty($film['alt_text']) ? htmlspecialchars($film['alt_text']) : 'Plakat filmu ' . htmlspecialchars($film['tytul']); ?>"
                                        style="background-image: url('plakaty_filmow/<?php echo htmlspecialchars($film['plakat']); ?>');">
                                    </div>
                                <div class="itemCardFooter">
                                    <div class="itemCardTitle">
                                        <?php echo htmlspecialchars($film['tytul']); ?>
                                    </div>
                                    <button class="likeBtn">♡</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Brak filmów w bazie danych.</p>
                    <?php endif; ?>
                </div>
                <button class="carouselBtn rightBtn" onclick="scrollMore('MovieWrapper')">&gt;</button>
            </div>
        </div>

        <div id="showsSection" class="contentSection">
            <div class="sectionTitle">Seriale</div>
            <div class="carouselWrapper">
                <button class="carouselBtn leftBtn" onclick="scrollLess('SerialWrapper')">&lt;</button>
                <div id="SerialWrapper" class="carouselItems">
                    <?php foreach ($seriale as $serial): ?>
                        <div class="itemCard">
                            <a href="index.php?controller=details&action=index&type=serial&id=<?= (int)$serial['id']; ?>" class="itemCardPosterLink">
                               <div class="itemCardPoster" 
                                    role="img"
                                    aria-label="<?= !empty($serial['alt_text']) ? htmlspecialchars($serial['alt_text']) : 'Plakat serialu ' . htmlspecialchars($serial['tytul']); ?>"
                                    style="background-image: url('plakaty_seriali/<?php echo htmlspecialchars($serial['plakat']); ?>');">
                                </div>
                            <div class="itemCardFooter">
                                <div class="itemCardTitle"><?php echo htmlspecialchars($serial['tytul']); ?></div>
                                <button class="likeBtn">♡</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="carouselBtn rightBtn" onclick="scrollMore('SerialWrapper')">&gt;</button>
            </div>
        </div>
    </div>

    <script src="js/scroll.js"></script>
    <script src="js/suggestions.js"></script>
    <script src="js/themeToggle.js"></script>
</body>
</html>