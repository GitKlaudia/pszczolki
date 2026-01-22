<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/common.css" rel="stylesheet">
    <link href="styles/advsearch.css" rel="stylesheet">
    <title>B-Movie - Wyszukiwanie zaawansowane</title>
</head>
<body class="advancedSearchBody">
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

    <main id="advancedSearchWrapper">
        <h1 id="advancedSearchTitle">Wyszukiwanie zaawansowane</h1>

        <section class="searchSection">
            <h2 class="searchSectionHeader">kategoria</h2>
            <div class="tagGroup">
                <?php foreach ($categories as $category): ?>
                    <button class="searchTag"><?php echo htmlspecialchars($category['nazwa']); ?></button>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="searchSection">
            <h2 class="searchSectionHeader">reżyser</h2>
            <div class="inputWithSuggestions">
                <input type="text" id="directorInput" class="advancedSearchInput" placeholder="Wyszukaj...">
                <div id="directorSuggestions" class="suggestionsBox">
                    <?php foreach ($directors as $director): ?>
                        <div class="suggestion"><?php echo htmlspecialchars($director['imie'] . ' ' . $director['nazwisko']); ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="searchSection">
            <h2 class="searchSectionHeader">obsada</h2>
            <div class="castSearchRow">
                <div class="inputWithSuggestions">
                    <input type="text" id="actorInput" class="advancedSearchInput" placeholder="Wyszukaj...">
                    <div id="actorSuggestions" class="suggestionsBox">
                        <?php foreach ($actors as $aktor): ?>
                            <div class="suggestion"><?php echo htmlspecialchars(trim($aktor['imie'] . ' ' . $aktor['nazwisko'])); ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <button class="addActorBtn">+</button>
                <div class="selectedTags"></div>
            </div>
        </section>

        <section class="searchSection">
            <h2 class="searchSectionHeader">platforma</h2>
            <div class="tagGroup">
                <?php foreach ($platforms as $platform): ?>
                    <button class="searchTag"><?php echo htmlspecialchars($platform['nazwa']); ?></button>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="searchSection">
            <h2 class="searchSectionHeader">typ</h2>
            <div class="tagGroup">
                <button class="searchTag">film</button>
                <button class="searchTag active">serial</button>
            </div>
        </section>

        <button id="finalSearchBtn">Wyszukaj</button>
    </main>

    <script>
        const allActors = <?php
            $actorNames = array_map(function($a) {
                return $a['imie'] . ' ' . $a['nazwisko'];
            }, $actors);
            echo json_encode($actorNames);
        ?>;
    </script>

    <script src="js/suggestions_adv.js"></script>
    <script src="js/advanced_search.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.suggestion').forEach(item => {
            item.addEventListener('mousedown', (e) => {
                const text = e.target.innerText;
                const container = e.target.closest('.inputWithSuggestions');
                const input = container.querySelector('input');
                input.value = text;
                input.blur();
            });
        });

        document.querySelectorAll('.searchTag').forEach(tag => {
            tag.addEventListener('click', function() {
                const section = this.closest('.searchSection');
                const sectionHeader = section.querySelector('.searchSectionHeader').innerText.toLowerCase();

                if (sectionHeader === 'typ') {
                    section.querySelectorAll('.searchTag').forEach(s => s.classList.remove('active'));
                    this.classList.add('active');
                } else {
                    this.classList.toggle('active');
                }
            });
        });
    });
    </script>

    <script src="js/themeToggle.js"></script>
</body>
</html>