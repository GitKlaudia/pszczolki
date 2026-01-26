<?php
require_once 'Model.php';

class Category extends Model
{
    public function all(): array
    {
        $res = $this->db->query("SELECT DISTINCT nazwa FROM kategorie ORDER BY nazwa ASC");
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }
}
