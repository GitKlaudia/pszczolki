<?php
require_once 'Model.php';
class Platform extends Model
{
    public function all(): array
    {
        $res = $this->db->query("SELECT id, nazwa, ikona FROM platformy ORDER BY nazwa ASC");
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }
}
