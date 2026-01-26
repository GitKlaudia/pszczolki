<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Movie.php';
require_once __DIR__ . '/../Models/Show.php';
require_once __DIR__ . '/../Models/Director.php';
require_once __DIR__ . '/../Models/Actor.php';
require_once __DIR__ . '/../Models/Platform.php';
require_once __DIR__ . '/../Models/Category.php';

class AdvancedSearchController extends Controller
{
    public function index(): void
    {
        $movieModel = new Movie();
        $showModel  = new Show();
        $directorModel = new Director();
        $actorModel    = new Actor();
        $platformModel = new Platform();
        $categoryModel = new Category();

        $movies     = $movieModel->all();
        $shows      = $showModel->all();
        $allDirectors = $directorModel->all();
        $allActors    = $actorModel->all();
        $allPlatforms = $platformModel->all();
        $allCategories = $categoryModel->all();

        $this->render('advanced_search', [
            'movies'        => $movies,
            'shows'         => $shows,
            'directors'     => $allDirectors,
            'actors'        => $allActors,
            'platforms'     => $allPlatforms,
            'categories'    => $allCategories
        ]);
    }
}