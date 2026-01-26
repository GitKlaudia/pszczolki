<?php
require_once 'Model.php';

class Actor extends Model
{
    public function all(): array
    {
        $res = $this->db->query("SELECT id, imie, nazwisko, zdjecie FROM aktorzy ORDER BY nazwisko, imie");
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }
}
