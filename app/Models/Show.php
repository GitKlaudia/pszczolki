<?php
require_once 'Model.php';

class Show extends Model
{
    public function all(): array
{
    $result = $this->db->query(
        "SELECT id, tytul, rok_produkcji, ilosc_sezonow, opis, plakat, alt_text FROM seriale"
    );
    return $result->fetch_all(MYSQLI_ASSOC);
}

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM seriale WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $show = $res->fetch_assoc();
        $stmt->close();
        return $show ?: null;
    }

    public function getCategories(int $id): array
    {
        $stmt = $this->db->prepare(
            "SELECT k.nazwa
             FROM kategorie_tresci kt
             JOIN kategorie k ON kt.id_kategorii = k.id
             WHERE kt.typ_tresci = 'serial' AND kt.id_tresci = ?"
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
             WHERE pr.typ_tresci = 'serial' AND pr.id_tresci = ?"
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
             WHERE wa.typ_tresci = 'serial' AND wa.id_tresci = ?"
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
             WHERE typ_tresci = 'serial' AND id_tresci = ?"
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
             WHERE dp.typ_tresci = 'serial' AND dp.id_tresci = ?"
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
            "SELECT nazwa_uzytkownika, komentarz, polubienia
             FROM komentarze
             WHERE typ_tresci = 'serial' AND id_tresci = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $comments = $res->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $comments;
    }

    public function searchByTitle(string $q): array
    {
        $q = self::normalize($q);
        $all = $this->all(); 
        return array_filter($all, fn($s) => str_contains(self::normalize($s['tytul']), $q));
    }


    public function searchAdvanced(array $categories, string $director, array $actors, array $platforms): array
    {
        $whereClauses = ["1=1"];

        if (!empty($categories)) {
            $escaped = array_map(fn($c) => "'" . $this->db->real_escape_string($c) . "'", $categories);
            $whereClauses[] = "id IN (
                SELECT id_tresci FROM kategorie_tresci kt
                JOIN kategorie k ON kt.id_kategorii = k.id
                WHERE k.nazwa IN (" . implode(",", $escaped) . ") AND kt.typ_tresci='serial'
            )";
        }

        if (!empty($director)) {
            $dir = $this->db->real_escape_string($director);
            $whereClauses[] = "id IN (
                SELECT id_tresci FROM produkcje_rezyserow pr
                JOIN rezyserzy r ON pr.id_rezysera=r.id
                WHERE CONCAT(r.imie,' ',r.nazwisko)='$dir' AND pr.typ_tresci='serial'
            )";
        }

        if (!empty($actors)) {
            $escaped = array_map(fn($a) => "'" . $this->db->real_escape_string($a) . "'", $actors);
            $whereClauses[] = "id IN (
                SELECT id_tresci FROM wystepy_aktorow wa
                JOIN aktorzy a ON wa.id_aktora=a.id
                WHERE CONCAT(a.imie,' ',a.nazwisko) IN (" . implode(",", $escaped) . ") AND wa.typ_tresci='serial'
            )";
        }

        if (!empty($platforms)) {
            $escaped = array_map(fn($p) => "'" . $this->db->real_escape_string($p) . "'", $platforms);
            $whereClauses[] = "id IN (
                SELECT id_tresci FROM dostepnosc_na_platformach dp
                JOIN platformy p ON dp.id_platformy=p.id
                WHERE p.nazwa IN (" . implode(",", $escaped) . ") AND dp.typ_tresci='serial'
            )";
        }

        $sql = "SELECT * FROM seriale WHERE " . implode(" AND ", $whereClauses);
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


}
