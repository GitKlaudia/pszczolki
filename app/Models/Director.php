<?php
require_once 'Model.php';

class Director extends Model
{
    public function all(): array
    {
        $res = $this->db->query("SELECT id, imie, nazwisko FROM rezyserzy ORDER BY nazwisko, imie");
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }
}
