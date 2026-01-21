<?php
require_once 'functions.php';
$filmy = getAllMovies();
$seriale = getAllShows();

?>

<!DOCTYPE html>
<html lang="en">
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
        <input type="text" id="searchInput" placeholder="Wyszukaj...">
        <img id="searchIcon" src="styles/searchIcon.svg">

        <div class="suggestionsBox">
            <?php foreach ($filmy as $film): ?>
                <div class="suggestion">
                    <?php echo htmlspecialchars($film['tytul']); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


            <div id="navBar">
                <a href="search.html" class="navItem" id="navMovies">Filmy</a>
                <a href="search.html" class="navItem" id="navShows">Seriale</a>
                <a href="favourites.html" class="navItem" id="navFav">Polubione</a>
                </div>
                <button id="themeToggle" title="Zmień motyw">
                <img id="themeIcon" src="styles/light.svg" alt="Motyw">
                </button>
                </div>
            </div>
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
            <div class="mobileNavBarItem">Filmy</div>
            <div class="mobileNavBarItem">Seriale</div>
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
                            <div class="itemCardPoster" 
                                 style="background-image: url('plakaty_filmow/<?php echo htmlspecialchars($film['plakat']); ?>'); ">
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
                    <?php if (!empty($seriale)): ?>
                        <?php foreach ($seriale as $serial): ?>
                            <div class="itemCard">
                                <div class="itemCardPoster" 
                                     style="background-image: url('plakaty_seriali/<?php echo htmlspecialchars($serial['plakat']); ?>'); ">
                                </div>
                                <div class="itemCardFooter">
                                    <div class="itemCardTitle">
                                        <?php echo htmlspecialchars($serial['tytul']); ?>
                                    </div>
                                    <button class="likeBtn">♡</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Brak seriali w bazie danych.</p>
                    <?php endif; ?>                                         
                </div>
                <button class="carouselBtn rightBtn" onclick="scrollMore('SerialWrapper')">&gt;</button>
            </div>
    </div>
    <script src="scroll.js"></script>
    <script src="suggestions.js"></script>
    <script src="themeToggle.js"></script>

</body>
</html>