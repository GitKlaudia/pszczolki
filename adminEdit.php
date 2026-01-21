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
        <a href="logoutscript.php" id="adminBtn" style="text-decoration: none;">
            <div id="adminBtnText">Wyloguj</div>
            <img id="adminBtnIcon" src="styles/adminIcon.svg">
        </a>
    </header>

    <div id="editWrapper">
        <div id="posterWrapper">
            <img id="posterImage">
            <div id="posterText">Dodaj obraz</div>
        </div>

        <div id="titleInputWrapper">
            <input id="titleInput" type="text" placeholder="Tytuł">
        </div>

        <div id="directorInputWrapper">
            <input id="directorInput" type="text" placeholder="Reżyser">
            <input id="yearInput" type="number" placeholder="Rok produkcji">
        </div>

        <div id="descInputWrapper">
            <input id="descInput" type="text" placeholder="Opis">
        </div>

        <div id="durationInputWrapper">
            <input id="durationInput" type="number" placeholder="Czas trwania">
        </div>

        <div id="castInputWrapper">
            <div id="castTitle">Obsada</div>
            <button id="castEditBtn">Edit</button>
            <button id="castAddBtn">Plus</button>
        </div>

        <div id="vodInputWrapper">
            <div id="vodTitle">Streaming - link</div>
            <button id="castEditBtn">Edit</button>
            <button id="castAddBtn">Plus</button>
        </div>

        <div id="genreInputWrapper">
            <div id="genreTitle">Gatunek</div>
            <button id="genreEditBtn">Edit</button>
            <button id="genreAddBtn">Plus</button>
        </div>

        <div id="categoryInputWrapper">
            <div id="categoryTitle">Gatunek</div>
            <button id="categoryEditBtn">Edit</button>
            <button id="categoryAddBtn">Plus</button>
        </div>
    </div>
    <div id="commentsWrapper">
        <div id="commentsTitle">Komentarze</div>
        <div id="comment">
            <img id="commentUserAvatar">
            <div id="commentUserTitle">Nazwa użytkownika</div>
            <button id="commentDeleteBtn">Delete</button>
            <div id="commentContent">Treść komentarza</div>
        </div>
        <div id="comment">
            <img id="commentUserAvatar">
            <div id="commentUserTitle">Nazwa użytkownika</div>
            <button id="commentDeleteBtn">Delete</button>
            <div id="commentContent">Treść komentarza</div>
        </div>
    </div>
</body>

</html>