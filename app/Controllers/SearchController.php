<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Model.php';
require_once __DIR__ . '/../Models/Movie.php';
require_once __DIR__ . '/../Models/Show.php';

class SearchController extends Controller
{
    public function index(): void
    {
        $movieModel = new Movie();
        $showModel  = new Show();

        $query = trim($_GET['q'] ?? '');
        $type = $_GET['type'] ?? '';
        $categories = isset($_GET['categories']) ? explode(',', $_GET['categories']) : [];
        $director   = $_GET['director'] ?? '';
        $actors     = isset($_GET['actors']) ? explode(',', $_GET['actors']) : [];
        $platforms  = isset($_GET['platforms']) ? explode(',', $_GET['platforms']) : [];

        $filmy = [];
        $seriale = [];

        if ($query !== '') {
            $filmy   = $movieModel->searchByTitle($query);
            $seriale = $showModel->searchByTitle($query);
        } 
        elseif ($type !== '') {
            $hasFilters = !empty($categories) || !empty($director) || !empty($actors) || !empty($platforms);
            
            if ($type === 'film') {
                if ($hasFilters) {
                    $filmy = $movieModel->searchAdvanced($categories, $director, $actors, $platforms);
                } else {
                    $filmy = $movieModel->all();
                }
            } elseif ($type === 'serial') {
                if ($hasFilters) {
                    $seriale = $showModel->searchAdvanced($categories, $director, $actors, $platforms);
                } else {
                    $seriale = $showModel->all();
                }
            } elseif ($type === 'all') {
                if ($hasFilters) {
                    $filmy = $movieModel->searchAdvanced($categories, $director, $actors, $platforms);
                    $seriale = $showModel->searchAdvanced($categories, $director, $actors, $platforms);
                } else {
                    $filmy = $movieModel->all();
                    $seriale = $showModel->all();
                }
            }
        }

        $this->render('search', [
            'filmy'   => $filmy,
            'seriale' => $seriale,
            'query'   => $query
        ]);
    }
}