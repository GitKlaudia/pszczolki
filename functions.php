<?php
require_once 'database.php';


function getAllMovies() {
    $conn = getConnection();
    $sql = "SELECT id, tytul, rok_produkcji, czas_trwania, opis, plakat FROM filmy";
    $result = $conn->query($sql);
    
    $filmy = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $filmy[] = $row;
        }
        $result->free_result();
    }
    $conn->close();
    return $filmy;
}

function getMovieById($id) {
    $conn = getConnection();
    $id = (int)$id; 
    $sql = "SELECT * FROM filmy WHERE id = $id";
    $result = $conn->query($sql);
    
    $film = null;
    if ($result && $result->num_rows > 0) {
        $film = $result->fetch_assoc();
        $result->free_result();
    }
    $conn->close();
    return $film;
}

function getMovieCategories($filmId) {
    $conn = getConnection();
    $filmId = (int)$filmId;
    $sql = "SELECT k.nazwa 
            FROM kategorie_tresci kt
            JOIN kategorie k ON kt.id_kategorii = k.id
            WHERE kt.typ_tresci = 'film' AND kt.id_tresci = $filmId";
    $result = $conn->query($sql);
    
    $kategorie = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $kategorie[] = $row['nazwa'];
        }
        $result->free_result();
    }
    $conn->close();
    return $kategorie;
}

function getMovieDirectors($filmId) {
    $conn = getConnection();
    $filmId = (int)$filmId;
    $sql = "SELECT r.imie, r.nazwisko, r.data_urodzenia 
            FROM produkcje_rezyserow pr
            JOIN rezyserzy r ON pr.id_rezysera = r.id
            WHERE pr.typ_tresci = 'film' AND pr.id_tresci = $filmId";
    $result = $conn->query($sql);
    
    $rezyserzy = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rezyserzy[] = $row;
        }
        $result->free_result();
    }
    $conn->close();
    return $rezyserzy;
}
function getAllDirectors() {
        $conn = getConnection();
        $sql = "SELECT id, imie, nazwisko FROM rezyserzy ORDER BY nazwisko, imie";
        $result = $conn->query($sql);

        $directors = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $directors[] = $row;
            }
            $result->free_result();
        }
        $conn->close();
        return $directors;
    }

    $allDirectors = getAllDirectors();


function getMovieRating($filmId) {
    $conn = getConnection();
    $filmId = (int)$filmId;
    $sql = "SELECT AVG(ocena) AS ocena 
            FROM oceny 
            WHERE typ_tresci = 'film' AND id_tresci = $filmId";
    $result = $conn->query($sql);
    
    $ocena = null;
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ocena = $row['ocena'] ? round($row['ocena'], 2) : null;
        $result->free_result();
    }
    $conn->close();
    return $ocena;
}

function getMoviePlatforms($filmId) {
    $conn = getConnection();
    $filmId = (int)$filmId;
    $sql = "SELECT p.nazwa, p.ikona, dp.link 
            FROM dostepnosc_na_platformach dp
            JOIN platformy p ON dp.id_platformy = p.id
            WHERE dp.typ_tresci = 'film' AND dp.id_tresci = $filmId";
    $result = $conn->query($sql);
    
    $platformy = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $platformy[] = $row;
        }
        $result->free_result();
    }
    $conn->close();
    return $platformy;
}
function getAllPlatforms() {
    $conn = getConnection();
    $sql = "SELECT DISTINCT p.nazwa FROM platformy p
            JOIN dostepnosc_na_platformach dp ON dp.id_platformy = p.id";
    $result = $conn->query($sql);

    $platforms = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $platforms[] = $row['nazwa'];
        }
        $result->free_result();
    }
    $conn->close();
    return $platforms;
}


function getMovieActors($filmId) {
    $conn = getConnection();
    $filmId = (int)$filmId;
    $sql = "SELECT a.imie, a.nazwisko, a.data_urodzenia, a.zdjecie, wa.rola
            FROM wystepy_aktorow wa
            JOIN aktorzy a ON wa.id_aktora = a.id
            WHERE wa.typ_tresci = 'film' AND wa.id_tresci = $filmId";
    $result = $conn->query($sql);
    
    $aktorzy = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $aktorzy[] = $row;
        }
        $result->free_result();
    }
    $conn->close();
    return $aktorzy;
}

function getAllActors() {
    $conn = getConnection();
    $sql = "SELECT id, imie, nazwisko FROM aktorzy ORDER BY nazwisko, imie";
    $result = $conn->query($sql);

    $actors = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $actors[] = $row;
        }
        $result->free_result();
    }
    $conn->close();
    return $actors;
}
$allActors = getAllActors();


function getMovieComments($filmId) {
    $conn = getConnection();
    $filmId = (int)$filmId;
    $sql = "SELECT nazwa_uzytkownika, komentarz, polubienia 
            FROM komentarze
            WHERE typ_tresci = 'film' AND id_tresci = $filmId";
    $result = $conn->query($sql);
    
    $komentarze = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $komentarze[] = $row;
        }
        $result->free_result();
    }
    $conn->close();
    return $komentarze;
}


function getAllShows() {
    $conn = getConnection();
    $sql = "SELECT id, tytul, rok_produkcji, ilosc_sezonow, opis, plakat FROM seriale";
    $result = $conn->query($sql);
    
    $seriale = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $seriale[] = $row;
        }
        $result->free_result();
    }
    $conn->close();
    return $seriale;
}

function getShowById($id) {
    $conn = getConnection();
    $id = (int)$id;
    $sql = "SELECT * FROM seriale WHERE id = $id";
    $result = $conn->query($sql);
    
    $serial = null;
    if ($result && $result->num_rows > 0) {
        $serial = $result->fetch_assoc();
        $result->free_result();
    }
    $conn->close();
    return $serial;
}


function getShowCategories($showId) {
    $conn = getConnection();
    $showId = (int)$showId;
    $sql = "SELECT k.nazwa 
            FROM kategorie_tresci kt
            JOIN kategorie k ON kt.id_kategorii = k.id
            WHERE kt.typ_tresci = 'serial' AND kt.id_tresci = $showId";
    $result = $conn->query($sql);

    $categories = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row['nazwa'];
        }
        $result->free_result();
    }
    $conn->close();
    return $categories;
}

function getShowDirectors($showId) {
    $conn = getConnection();
    $showId = (int)$showId;
    $sql = "SELECT r.imie, r.nazwisko, r.data_urodzenia 
            FROM produkcje_rezyserow pr
            JOIN rezyserzy r ON pr.id_rezysera = r.id
            WHERE pr.typ_tresci = 'serial' AND pr.id_tresci = $showId";
    $result = $conn->query($sql);

    $directors = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $directors[] = $row;
        }
        $result->free_result();
    }
    $conn->close();
    return $directors;
}

function getShowRating($showId) {
    $conn = getConnection();
    $showId = (int)$showId;
    $sql = "SELECT AVG(ocena) AS ocena 
            FROM oceny 
            WHERE typ_tresci = 'serial' AND id_tresci = $showId";
    $result = $conn->query($sql);

    $rating = null;
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $rating = $row['ocena'] ? round($row['ocena'], 2) : null;
        $result->free_result();
    }
    $conn->close();
    return $rating;
}

function getShowPlatforms($showId) {
    $conn = getConnection();
    $showId = (int)$showId;
    $sql = "SELECT p.nazwa, p.ikona, dp.link 
            FROM dostepnosc_na_platformach dp
            JOIN platformy p ON dp.id_platformy = p.id
            WHERE dp.typ_tresci = 'serial' AND dp.id_tresci = $showId";
    $result = $conn->query($sql);

    $platforms = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $platforms[] = $row;
        }
        $result->free_result();
    }
    $conn->close();
    return $platforms;
}

function getShowActors($showId) {
    $conn = getConnection();
    $showId = (int)$showId;
    $sql = "SELECT a.imie, a.nazwisko, a.data_urodzenia, a.zdjecie, wa.rola
            FROM wystepy_aktorow wa
            JOIN aktorzy a ON wa.id_aktora = a.id
            WHERE wa.typ_tresci = 'serial' AND wa.id_tresci = $showId";
    $result = $conn->query($sql);

    $actors = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $actors[] = $row;
        }
        $result->free_result();
    }
    $conn->close();
    return $actors;
}

function getShowComments($showId) {
    $conn = getConnection();
    $showId = (int)$showId;
    $sql = "SELECT nazwa_uzytkownika, komentarz, polubienia 
            FROM komentarze
            WHERE typ_tresci = 'serial' AND id_tresci = $showId";
    $result = $conn->query($sql);

    $comments = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
        $result->free_result();
    }
    $conn->close();
    return $comments;
}

function normalize($str) {
    $str = strtolower($str);
    $polish = ['ą','ć','ę','ł','ń','ó','ś','ż','ź'];
    $replace = ['a','c','e','l','n','o','s','z','z'];
    return str_replace($polish, $replace, $str);
}

function searchMoviesByTitle($q) {
    $q = normalize($q);  
    $movies = getAllMovies(); 
    return array_filter($movies, fn($m) => str_contains(normalize($m['tytul']), $q));
}

function searchShowsByTitle($q) {
    $q = normalize($q); 
    $shows = getAllShows(); 
    return array_filter($shows, fn($s) => str_contains(normalize($s['tytul']), $q));
}


function searchAdvancedMovies(array $categories, string $director, array $actors, array $platforms): array {
    $conn = getConnection();

    $whereClauses = ["1=1"];

    if (!empty($categories)) {
        $escaped = array_map(fn($c) => "'" . $conn->real_escape_string($c) . "'", $categories);
        $whereClauses[] = "id IN (
            SELECT id_tresci 
            FROM kategorie_tresci kt 
            JOIN kategorie k ON kt.id_kategorii = k.id 
            WHERE k.nazwa IN (" . implode(",", $escaped) . ")
            AND kt.typ_tresci = 'film'
        )";
    }

    if (!empty($director)) {
        $dir = $conn->real_escape_string($director);
        $whereClauses[] = "id IN (
            SELECT id_tresci 
            FROM produkcje_rezyserow pr 
            JOIN rezyserzy r ON pr.id_rezysera = r.id 
            WHERE CONCAT(r.imie,' ',r.nazwisko) = '$dir'
            AND pr.typ_tresci = 'film'
        )";
    }

    if (!empty($actors)) {
        $escaped = array_map(fn($a) => "'" . $conn->real_escape_string($a) . "'", $actors);
        $whereClauses[] = "id IN (
            SELECT id_tresci 
            FROM wystepy_aktorow wa 
            JOIN aktorzy a ON wa.id_aktora = a.id 
            WHERE CONCAT(a.imie,' ',a.nazwisko) IN (" . implode(",", $escaped) . ")
            AND wa.typ_tresci = 'film'
        )";
    }

    if (!empty($platforms)) {
        $escaped = array_map(fn($p) => "'" . $conn->real_escape_string($p) . "'", $platforms);
        $whereClauses[] = "id IN (
            SELECT id_tresci 
            FROM dostepnosc_na_platformach dp 
            JOIN platformy p ON dp.id_platformy = p.id 
            WHERE p.nazwa IN (" . implode(",", $escaped) . ")
            AND dp.typ_tresci = 'film'
        )";
    }

    $sql = "SELECT * FROM filmy WHERE " . implode(" AND ", $whereClauses);
    $result = $conn->query($sql);

    $movies = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $movies[] = $row;
        }
        $result->free_result();
    }

    $conn->close();
    return $movies;
}

function searchAdvancedShows(array $categories, string $director, array $actors, array $platforms): array {
    $conn = getConnection();

    $whereClauses = ["1=1"];

    if (!empty($categories)) {
        $escaped = array_map(fn($c) => "'" . $conn->real_escape_string($c) . "'", $categories);
        $whereClauses[] = "id IN (
            SELECT id_tresci 
            FROM kategorie_tresci kt 
            JOIN kategorie k ON kt.id_kategorii = k.id 
            WHERE k.nazwa IN (" . implode(",", $escaped) . ")
            AND kt.typ_tresci = 'serial'
        )";
    }

    if (!empty($director)) {
        $dir = $conn->real_escape_string($director);
        $whereClauses[] = "id IN (
            SELECT id_tresci 
            FROM produkcje_rezyserow pr 
            JOIN rezyserzy r ON pr.id_rezysera = r.id 
            WHERE CONCAT(r.imie,' ',r.nazwisko) = '$dir'
            AND pr.typ_tresci = 'serial'
        )";
    }

    if (!empty($actors)) {
        $escaped = array_map(fn($a) => "'" . $conn->real_escape_string($a) . "'", $actors);
        $whereClauses[] = "id IN (
            SELECT id_tresci 
            FROM wystepy_aktorow wa 
            JOIN aktorzy a ON wa.id_aktora = a.id 
            WHERE CONCAT(a.imie,' ',a.nazwisko) IN (" . implode(",", $escaped) . ")
            AND wa.typ_tresci = 'serial'
        )";
    }

    if (!empty($platforms)) {
        $escaped = array_map(fn($p) => "'" . $conn->real_escape_string($p) . "'", $platforms);
        $whereClauses[] = "id IN (
            SELECT id_tresci 
            FROM dostepnosc_na_platformach dp 
            JOIN platformy p ON dp.id_platformy = p.id 
            WHERE p.nazwa IN (" . implode(",", $escaped) . ")
            AND dp.typ_tresci = 'serial'
        )";
    }

    $sql = "SELECT * FROM seriale WHERE " . implode(" AND ", $whereClauses);
    $result = $conn->query($sql);

    $shows = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $shows[] = $row;
        }
        $result->free_result();
    }

    $conn->close();
    return $shows;
}

function getAllCategories(): array {
    $conn = getConnection();
    $result = $conn->query("SELECT DISTINCT nazwa FROM kategorie ORDER BY nazwa ASC");
    $categories = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row['nazwa'];
        }
        $result->free_result();
    }
    $conn->close();
    return $categories;
}


?>

