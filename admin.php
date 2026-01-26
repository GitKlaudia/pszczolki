<?php
session_start();
if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/common.css" rel="stylesheet">
    <link href="styles/admin.css" rel="stylesheet">
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
        <<a href="logoutscript.php" id="adminBtn" style="text-decoration: none;">
            <div id="adminBtnText">Wyloguj</div>
            <img id="adminBtnIcon" src="styles/adminIcon.svg">
        </a>
    </header>

    <div id="moviesManagmentWrapper">
        <div id="addMovieWrapper">
            <button id="addMovieBtn">+</button>
            <div id="addMovieText">Dodaj film</div>
        </div>

        <div class="movieItem">
            <div class="moviePoster"></div>
            <div class="movieInfo">
                <div class="movieTitle">Tytuł (rok)</div>

                <div class="vodLinksWrapper">
                    <div class="vodLink">
                        <div class="vodLinkIcon"></div>
                        <div class="vodLinkTitle">link</div>
                        <div class="vodLinkActions">
                            <button class="vodLinkEditBtn"></button>
                            <button class="vodLinkDeleteBtn"></button>
                        </div>
                    </div>
                    <button class="addVodLinkBtn"></button>
                </div>
            </div>

            <div class="movieActions">
                <button class="movieEditBtn"></button>
                <button class="movieDeleteBtn"></button>
            </div>
        </div>

        <div class="movieItem">
            <div class="moviePoster"></div>
            <div class="movieInfo">
                <div class="movieTitle">Tytuł(rok)</div>

                <div class="vodLinksWrapper">
                    <div class="vodLink">
                        <div class="vodLinkIcon"></div>
                        <div class="vodLinkTitle">Netflix</div>
                        <div class="vodLinkActions">
                            <button class="vodLinkEditBtn"></button>
                            <button class="vodLinkDeleteBtn"></button>
                        </div>
                    </div>
                    <div class="vodLink">
                        <div class="vodLinkIcon"></div>
                        <div class="vodLinkTitle">HBO Max</div>
                        <div class="vodLinkActions">
                            <button class="vodLinkEditBtn"></button>
                            <button class="vodLinkDeleteBtn"></button>
                        </div>
                    </div>
                    <div class="vodLink">
                        <div class="vodLinkIcon"></div>
                        <div class="vodLinkTitle">Disney+</div>
                        <div class="vodLinkActions">
                            <button class="vodLinkEditBtn"></button>
                            <button class="vodLinkDeleteBtn"></button>
                        </div>
                    </div>
                    <div class="vodLink">
                        <div class="vodLinkIcon"></div>
                        <div class="vodLinkTitle">Amazon Prime</div>
                        <div class="vodLinkActions">
                            <button class="vodLinkEditBtn"></button>
                            <button class="vodLinkDeleteBtn"></button>
                        </div>
                    </div>
                    <div class="vodLink">
                        <div class="vodLinkIcon"></div>
                        <div class="vodLinkTitle">Apple TV</div>
                        <div class="vodLinkActions">
                            <button class="vodLinkEditBtn"></button>
                            <button class="vodLinkDeleteBtn"></button>
                        </div>
                    </div>
                    <div class="vodLink">
                        <div class="vodLinkIcon"></div>
                        <div class="vodLinkTitle">SkyShowtime</div>
                        <div class="vodLinkActions">
                            <button class="vodLinkEditBtn"></button>
                            <button class="vodLinkDeleteBtn"></button>
                        </div>
                    </div>
                    <button class="addVodLinkBtn"></button>
                </div>
            </div>

            <div class="movieActions">
                <button class="movieEditBtn"></button>
                <button class="movieDeleteBtn"></button>
            </div>
        </div>

    </div>
</body>

</html>