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


?>