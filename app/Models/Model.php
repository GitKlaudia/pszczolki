<?php
require_once __DIR__ . '/../Core/Database.php';


abstract class Model
{
    protected mysqli $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }
}
