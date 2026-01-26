<?php
require_once '../app/Core/Database.php';
require_once '../app/Models/Movie.php';

class MovieRepository
{
    public static function findAll(): array
    {
        $db = Database::getConnection();
        $result = $db->query("SELECT * FROM filmy");

        $movies = [];
        while ($row = $result->fetch_assoc()) {
            $movies[] = self::map($row);
        }

        return $movies;
    }

    private static function map(array $row): Movie
    {
        $movie = new Movie();
        $movie->id = $row['id'];
        $movie->title = $row['tytul'];
        $movie->year = $row['rok_produkcji'];
        $movie->poster = $row['plakat'];

        return $movie;
    }
}
