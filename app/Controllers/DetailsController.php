<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Movie.php';
require_once __DIR__ . '/../Models/Show.php';

class DetailsController extends Controller
{
    public function index(): void
    {
        $type = $_GET['type'] ?? '';
        $id   = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if (($type !== 'film' && $type !== 'serial') || $id <= 0) {
            die('Nieprawidłowe dane');
        }

        if ($type === 'film') {
            $model      = new Movie();
            $posterDir  = 'plakaty_filmow/';
        } else {
            $model      = new Show();
            $posterDir  = 'plakaty_seriali/';
        }

        $item       = $model->find($id);
        if (!$item) die('Nie znaleziono pozycji');

        $categories = $model->getCategories($id);
        $directors  = $model->getDirectors($id);
        $rating     = $model->getRating($id);
        $platforms  = $model->getPlatforms($id);
        $actors     = $model->getActors($id);
        $comments   = $model->getComments($id);

        $this->render('details', [
            'type'       => $type,
            'item'       => $item,
            'posterDir'  => $posterDir,
            'categories' => $categories,
            'directors'  => $directors,
            'rating'     => $rating,
            'platforms'  => $platforms,
            'actors'     => $actors,
            'comments'   => $comments
        ]);
    }
}
