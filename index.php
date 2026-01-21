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
    <link href="styles/styles.css" rel="stylesheet">
    <title>B-Movie</title>
</head>
<body>
    <header>
        <div id="headerLogoAndTitle">
            <img id="headerLogo" src="styles/logo.svg">
            <div id="headerTitle">B-Movie</div>
        </div>
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
                <div class="navItem" id="navMovies">Filmy</div>
                <div class="navItem" id="navShows">Seriale</div>
            </div>
        </div>
        <div id="adminBtn">
            <div id="adminBtnText">Admin</div>
            <img id="adminBtnIcon" src="styles/adminIcon.svg">
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
        <div id="likedLink">Polubione <span id="likedLinkArrow">&gt;</span>
        </div>
    </div>
    <script src="scroll.js"></script>
    <script src="suggestions.js"></script>

</body>
</html>