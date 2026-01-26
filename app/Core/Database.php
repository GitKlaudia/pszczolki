<?php

class Database
{
    private static ?mysqli $conn = null;

    public static function getConnection(): mysqli
    {
        if (self::$conn === null) {
            self::$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (self::$conn->connect_error) {
                die('Błąd połączenia z bazą: ' . self::$conn->connect_error);
            }

            self::$conn->set_charset('utf8mb4');
        }

        return self::$conn;
    }
}
