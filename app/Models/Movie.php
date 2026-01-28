<?php
require_once 'Model.php';

class Movie extends Model
{
   public function all(): array
{
    $result = $this->db->query(
        "SELECT id, tytul, rok_produkcji, czas_trwania, opis, plakat, alt_text FROM filmy"
    );
    return $result->fetch_all(MYSQLI_ASSOC);
}

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM filmy WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $movie = $res->fetch_assoc();
        $stmt->close();
        return $movie ?: null;
    }

    public function getCategories(int $id): array
    {
        $stmt = $this->db->prepare(
            "SELECT k.nazwa
             FROM kategorie_tresci kt
             JOIN kategorie k ON kt.id_kategorii = k.id
             WHERE kt.typ_tresci = 'film' AND kt.id_tresci = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $categories = $res->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return array_column($categories, 'nazwa');
    }

    public function getDirectors(int $id): array
    {
        $stmt = $this->db->prepare(
            "SELECT r.imie, r.nazwisko, r.data_urodzenia
             FROM produkcje_rezyserow pr
             JOIN rezyserzy r ON pr.id_rezysera = r.id
             WHERE pr.typ_tresci = 'film' AND pr.id_tresci = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $directors = $res->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $directors;
    }

    public function getActors(int $id): array
    {
        $stmt = $this->db->prepare(
            "SELECT a.imie, a.nazwisko, a.data_urodzenia, a.zdjecie, wa.rola
             FROM wystepy_aktorow wa
             JOIN aktorzy a ON wa.id_aktora = a.id
             WHERE wa.typ_tresci = 'film' AND wa.id_tresci = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $actors = $res->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $actors;
    }

    public function getRating(int $id): ?float
    {
        $stmt = $this->db->prepare(
            "SELECT AVG(ocena) AS ocena
             FROM oceny
             WHERE typ_tresci = 'film' AND id_tresci = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        $stmt->close();
        return $row['ocena'] ? round((float)$row['ocena'], 2) : null;
    }

    public function getPlatforms(int $id): array
    {
        $stmt = $this->db->prepare(
            "SELECT p.nazwa, p.ikona, dp.link
             FROM dostepnosc_na_platformach dp
             JOIN platformy p ON dp.id_platformy = p.id
             WHERE dp.typ_tresci = 'film' AND dp.id_tresci = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $platforms = $res->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $platforms;
    }

    public function getComments(int $id): array
    {
        $stmt = $this->db->prepare(
            "SELECT id, nazwa_uzytkownika, komentarz, polubienia
             FROM komentarze
             WHERE typ_tresci = 'film' AND id_tresci = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $comments = $res->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $comments;
    }

    public function addComment(int $id, string $commentText): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO komentarze (typ_tresci, id_tresci, nazwa_uzytkownika, komentarz, polubienia)
             VALUES ('film', ?, 'Anonim', ?, 0)"
        );
        $stmt->bind_param("is", $id, $commentText);
        $stmt->execute();
        $stmt->close();
    }

    public function likeComment(int $commentId): void
    {
        $stmt = $this->db->prepare(
            "UPDATE komentarze
             SET polubienia = polubienia + 1
             WHERE id = ?"
        );
        $stmt->bind_param("i", $commentId);
        $stmt->execute();
        $stmt->close();
    }

    public function unlikeComment(int $commentId): void
    {
        $stmt = $this->db->prepare(
            "UPDATE komentarze
             SET polubienia = GREATEST(polubienia - 1, 0)
             WHERE id = ?"
        );
        $stmt->bind_param("i", $commentId);
        $stmt->execute();
        $stmt->close();
    }

    public function searchByTitle(string $q): array
    {
        $q = self::normalize($q);
        $all = $this->all(); 
        return array_filter($all, fn($m) => str_contains(self::normalize($m['tytul']), $q));
    }

    public function searchAdvanced(array $categories, string $director, array $actors, array $platforms): array
    {
        $whereClauses = ["1=1"];

        if (!empty($categories)) {
            $escaped = array_map(fn($c) => "'" . $this->db->real_escape_string($c) . "'", $categories);
            $whereClauses[] = "id IN (
                SELECT id_tresci FROM kategorie_tresci kt
                JOIN kategorie k ON kt.id_kategorii = k.id
                WHERE k.nazwa IN (" . implode(",", $escaped) . ") AND kt.typ_tresci='film'
            )";
        }

        if (!empty($director)) {
            $dir = $this->db->real_escape_string($director);
            $whereClauses[] = "id IN (
                SELECT id_tresci FROM produkcje_rezyserow pr
                JOIN rezyserzy r ON pr.id_rezysera=r.id
                WHERE CONCAT(r.imie,' ',r.nazwisko)='$dir' AND pr.typ_tresci='film'
            )";
        }

        if (!empty($actors)) {
            $escaped = array_map(fn($a) => "'" . $this->db->real_escape_string($a) . "'", $actors);
            $whereClauses[] = "id IN (
                SELECT id_tresci FROM wystepy_aktorow wa
                JOIN aktorzy a ON wa.id_aktora=a.id
                WHERE CONCAT(a.imie,' ',a.nazwisko) IN (" . implode(",", $escaped) . ") AND wa.typ_tresci='film'
            )";
        }

        if (!empty($platforms)) {
            $escaped = array_map(fn($p) => "'" . $this->db->real_escape_string($p) . "'", $platforms);
            $whereClauses[] = "id IN (
                SELECT id_tresci FROM dostepnosc_na_platformach dp
                JOIN platformy p ON dp.id_platformy=p.id
                WHERE p.nazwa IN (" . implode(",", $escaped) . ") AND dp.typ_tresci='film'
            )";
        }

        $sql = "SELECT * FROM filmy WHERE " . implode(" AND ", $whereClauses);
        $res = $this->db->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    protected static function normalize(string $str): string
{
    $str = strtolower($str);
    $polish = ['ą','ć','ę','ł','ń','ó','ś','ż','ź'];
    $replace = ['a','c','e','l','n','o','s','z','z'];
    return str_replace($polish, $replace, $str);
}

public function getUserRating(int $id, string $userIdentifier): ?array
{
    $stmt = $this->db->prepare(
        "SELECT * FROM oceny 
         WHERE typ_tresci = 'film' AND id_tresci = ? AND identyfikator_uzytkownika = ?"
    );
    $stmt->bind_param("is", $id, $userIdentifier);
    $stmt->execute();
    $res = $stmt->get_result();
    $rating = $res->fetch_assoc();
    $stmt->close();
    return $rating ?: null;
}

public function addRating(int $id, string $userIdentifier, int $rating): void
{
    $stmt = $this->db->prepare(
        "INSERT INTO oceny (typ_tresci, id_tresci, identyfikator_uzytkownika, ocena) 
         VALUES ('film', ?, ?, ?)"
    );
    $stmt->bind_param("isi", $id, $userIdentifier, $rating);
    $stmt->execute();
    $stmt->close();
}

public function updateRating(int $id, string $userIdentifier, int $rating): void
{
    $stmt = $this->db->prepare(
        "UPDATE oceny 
         SET ocena = ? 
         WHERE typ_tresci = 'film' AND id_tresci = ? AND identyfikator_uzytkownika = ?"
    );
    $stmt->bind_param("iis", $rating, $id, $userIdentifier);
    $stmt->execute();
    $stmt->close();
}

public function deleteUserRating(int $id, string $userIdentifier): void
{
    $stmt = $this->db->prepare(
        "DELETE FROM oceny 
         WHERE typ_tresci = 'film' AND id_tresci = ? AND identyfikator_uzytkownika = ?"
    );
    $stmt->bind_param("is", $id, $userIdentifier);
    $stmt->execute();
    $stmt->close();
}

    
}
