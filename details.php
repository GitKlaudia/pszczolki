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
        <div id="centerSection">
            <div id="searchBar">
                <input type="text" id="searchInput" placeholder="Wyszukaj...">
                <img id="searchIcon" src="styles/searchIcon.svg">
            </div>
        </div>
        <div id="navBar">
                <a href="search.php" class="navItem" id="navMovies">Filmy</a>
                <a href="search.php" class="navItem" id="navShows">Seriale</a>
                <a href="favourites.php" class="navItem" id="navFav">Polubione</a>
                <button id="themeToggle" title="Zmień motyw">
                <img id="themeIcon" src="styles/light.svg" alt="Motyw">
                </button>
                </div>
    </header>

    <div id="detailsWrapper">
        <img id="banner">
        
        <div id="rating">Ocena: 5/10</div>

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
                <h1 class="title-text">Tytuł</h1>
                <button id="likeBtn">♡</button>
            </div>
            <div class="info-row">
                <div id="year">Rok</div>
                <div id="duration">Czas trwania</div>
            </div>
        </div>

        <img id="moviePoster">

        <div id="description">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
            reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
            culpa qui officia deserunt mollit anim id est laborum.
            
            <div id="genres">gatunki</div>
            <div id="director">reżyseria</div>
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
                <div class="vodLink">
                    <img class="vodIcon">
                    <div class="vodLinks">link</div>
                </div>
                <div class="vodLink">
                    <img class="vodIcon">
                    <div class="vodLinks">link</div>
                </div>
                <div class="vodLink">
                    <img class="vodIcon">
                    <div class="vodLinks">link</div>
                </div>
            </div>
        </div>

       <div id="cast">
    <div id="castTitle">Obsada</div>
    
    <div class="castGallery">
        <div class="castPersonWrapper">
            <img class="castPersonImage">
            <div class="castPersonName">Aktor 1</div>
        </div>
        <div class="castPersonWrapper">
            <img class="castPersonImage">
            <div class="castPersonName">Aktor 2</div>
        </div>
         <div class="castPersonWrapper">
            <img class="castPersonImage">
            <div class="castPersonName">Aktor 3</div>
        </div>
         <div class="castPersonWrapper">
            <img class="castPersonImage">
            <div class="castPersonName">Aktor 4</div>
        </div>
         <div class="castPersonWrapper">
            <img class="castPersonImage">
            <div class="castPersonName">Aktor 5</div>
        </div>
        </div>
</div>
    </div>
</body>
<script src="themeToggle.js"></script>
</html>